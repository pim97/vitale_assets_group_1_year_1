<?php

use Illuminate\Database\Seeder;
use App\Category;

/**
 * Class CategorySeeder
 */
class CategorySeeder extends Seeder
{
    /**
     * @var string
     */
    protected $path = "import/drempelwaardes.csv";

    /**
     * this method starts the seeder and loops through the csv file
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function run()
    {
        //Split each line of the csv file
        $contents = collect(explode("\n", Storage::get($this->path)));
        //ignore the first row of the csv file
        $firstRow = true;
        //loop through the content
        foreach ($contents as $row) {
            //split up each row by the ; sign
            $row = explode(";", $row);
            if ($firstRow) {
                $firstRow = false;
            } else {
                //loop through each row items
                for ($i = 0; $i < count($row); $i++) {
                    //if and row item is a double update it to the last category
                    if ((double)$row[$i] > 0) {
                        //pick last category
                        $lastCategory = $row[$i - 1];
                        //update category with the threshold
                        $this->updateCategory($lastCategory, $row[$i]);
                    } else {
                        //otherwise add a category to the databaes
                        //check if category is not a main category and not a double
                        if ($i > 0 && (double)$row[$i] == 0) {
                            //pick last added category
                            $parentId = $row[$i - 1];
                            //create subcategory
                            $this->createCategory($row[$i], null, $parentId);
                        } else {
                            //create main categories
                            $this->createCategory($row[$i], null, null);
                        }
                    }
                }
            }
        }
    }

    /**
     * this method creates an category
     * @param $name
     * @param null $threshold
     * @param null $parentId
     */
    protected function createCategory($name, $threshold = null, $parentId = null)
    {
        //check if the category name is unique in the database.
        if (!Category::where('name', '=', $name)->exists()) {
            //if there is a parent id given find it in the database.
            if ($parentId) {
                $category = $this->findCategory($parentId);
                $parentId = $category->id;
            }
            //create category
            Category::firstOrCreate([
                'name' => $name,
                'description' => null,
                'threshold' => $threshold,
                'parent_id' => $parentId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * this method updates an existing category
     * @param $id
     * @param $threshold
     */
    protected function updateCategory($id, $threshold = null)
    {
        if ($category = $this->findCategory($id)) {
            $category->update([
                'threshold' => (double)$threshold,
                'updated_at' => now(),
            ]);
        } else {
            $this->command->info("Cant't find category.");
        }
    }

    /**
     * this method tries to find an category
     * @param $id
     * @return mixed
     */
    protected function findCategory($id)
    {
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
            return $category;
        }
        //otherwise return false
        return false;
    }
}
