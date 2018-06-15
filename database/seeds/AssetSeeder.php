<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Category;

/**
 * Class AssetSeeder
 * @author Daan de Waard <dwaard@hz.nl>
 */
class AssetSeeder extends Seeder
{

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function run()
    {
        $files = $this->getGeoJSONFiles();
        foreach ($files as $file) {
            $this->processFile(Storage::get($file));
        }
    }

    /**
     * @return array
     * @return $matchingFiles
     */
    protected function getGeoJSONFiles()
    {
        $files = Storage::files("import");
        // filter the ones that match the *.geojson
        $matchingFiles = preg_grep('^(.*\.((geojson)$))^', $files);
        return $matchingFiles;
    }

    /**
     * @param $content
     * @return void
     */
    protected function processFile($content)
    {
        $raw = json_decode($content);
        $name = $raw->name;
        $this->command->info("Importing $name");
        $this->createAsset($raw);
    }

    /**
     * @param $rawJson
     */
    protected function createAsset($rawJson)
    {
        foreach ($rawJson->features as $feature) {
            //find category and return id
            $categoryId = $this->findCategory($feature->properties);
            //create asset
            $assetId = $this->insertAssetIntoDatabase($feature, $categoryId);
            //command into the CLI
            $this->command->info("Asset: " . $feature->properties->Asset . " is aangemaakt.");
            //Loop trough all the breachlocations and waterdepths
            $this->createDepthsAndFloatScenarios($feature, $assetId);
        }
    }

    /**
     * @param $properties
     * @return bool
     */
    protected function findCategory($properties)
    {
        $id = null;
        //everything else
        if (property_exists($properties, "Type")) {
            $id = $properties->Type;
            //rioolgemalen
            if ($properties->Type == ' ') {
                $id = $properties->ckering31n;
            }
            //mobieletelecom
        } elseif (property_exists($properties, "TOEPASSING")) {
            $id = $properties->TOEPASSING;
            //vastetelecom
        } elseif (property_exists($properties, "type")) {
            $id = $properties->type;
        }

        //check if id is an integer or string
        if (is_numeric($id)) {
            //find category by id
            $category = Category::find($id);
        } else {
            //find category by name
            $category = Category::where('name', '=', $id)->first();
        }
        //check if there are results from the database
        if ($category) {
            return $category->id;
        }

        //otherwise return false
        return false;
    }

    /**
     * @param $feature
     * @param $assetId
     */
    protected function createDepthsAndFloatScenarios($feature, $assetId)
    {
        foreach ($feature->properties as $property => $waterDepth) {
            //Look up the breach location in the database and check if it asserts with the code in the geojson file
            if ($breachLocation = DB::table('breach_locations')->where('code', '=', $property)->first()) {
                //Check if waterdepth is a intger and if so change it to a float
                $waterDepth = $this->checkIfInteger($waterDepth);
                //Check if water depth is a float
                if (is_float($waterDepth)) {
                    //create floatscenario with breachloation and loadlevel
                    $floatScenarioId = $this->insertFloatScenarioIntoDatabase($breachLocation->id, 2);
                    //create 1 or more water depths for a single asset
                    $this->insertDepthIntoDatabase($assetId, $floatScenarioId, $waterDepth);
                }
            }
        }
    }

    /**
     * @param $feature
     * @param $categoryId
     * @return int
     */
    protected function insertAssetIntoDatabase($feature, $categoryId)
    {
        $assetId = DB::table('assets')->insertGetId([
            'name' => $feature->properties->Asset,
            'category_id' => $categoryId,
            'x_coordinate' => $x = $feature->geometry->coordinates[0],
            'y_coordinate' => $y = $feature->geometry->coordinates[1],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return $assetId;
    }

    /**
     * This method creates a new water depth into the database
     *
     * @param $assetId integer the corresponding asset id from the database
     * @param $floatScenarioId
     * @param $waterDepth float water depth of an asset from a breachlocation
     * @return int $depthId the autocrement id of the database from the depths databasetable
     */
    protected function insertDepthIntoDatabase($assetId, $floatScenarioId, $waterDepth)
    {
        $depthId = DB::table('depths')->insertGetId([
            'asset_id' => $assetId,
            'float_scenario_id' => $floatScenarioId,
            'water_depth' => $waterDepth,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return $depthId;
    }

    /**
     * This method creates a new float_scenario into the database.
     *
     * @param $breachLocationId integer id of the breachlocation item in the database
     * @param $loadLevel integer by default 2 TP Maatgevend scenario
     * @return int $floatScenarioId
     */
    protected function insertFloatScenarioIntoDatabase($breachLocationId, $loadLevel)
    {
        $floatScenarioId = DB::table('float_scenarios')->insertGetId([
            'breach_location_id' => $breachLocationId,
            'load_level_id' => $loadLevel,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return $floatScenarioId;
    }

    /**
     * This function checks if the given value is an int and if so changes it to a float.
     * and returns the new value.
     *
     * @param $waterDepth
     * @return string
     */
    protected function checkIfInteger($waterDepth)
    {
        //Checks if the given variable is an integer.
        if (is_int($waterDepth)) {
            //If so make it a float and return it.
            $waterDepth = sprintf("%.2f", $waterDepth);
        }
        //return the value.
        return (float)$waterDepth;
    }
}
