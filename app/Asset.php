<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * Class Asset
 * @package App
 * @author Pepijn
 */
class Asset extends Model
{
    /**
     * @param $id
     * @return mixed
     */
    public function getName($id)
    {
        $asset = Asset::find($id)->first();
        return $asset;
    }

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'category_id', 'x_coordinate', 'y_coordinate', 'threshold', 'threshold_correction',
    ];

    public function category()
    {
        return $this->belongsTo("App\Category", "category_id", "id");
    }

    public function depths()
    {
        return $this->hasMany('App\Depth', 'asset_id', 'id');
    }

    public function floatScenarios()
    {
        return $this->belongsToMany('App\FloatScenario', 'depths', 'asset_id', 'float_scenario_id');
    }

    /**
     * Set the breachlocation
     * @param $value
     */
    public function setBreachLocationAttribute($value)
    {
        $this->attributes['breach_location'] = $value;
    }

    /**
     * Set the loadlevel
     * @param $value
     */
    public function setLoadLevelAttribute($value)
    {
        $this->attributes['load_level'] = $value;
    }

    /**
     * Calculate the real threshold
     * Find the category threshold and add the correction to it.
     * @return mixed
     */
    public function getThresholdRealAttribute()
    {
        //define
        $categoryThreshold = $this->category()->first()->threshold;
        $assetThresholdCorrection = $this->threshold_correction;

        //calculate
        return $categoryThreshold + $assetThresholdCorrection;
    }

    /**
     * @param $breachLocation
     * @param int $loadLevel
     * @return int|null
     */
    public function computeState($breachLocation, $loadLevel = 2)
    {
        //Get the water depths and floatscenario from the current asset, breachloation and loadlevel
        $floatScenarios = DB::table('assets')
            ->where('assets.id', $this->id)
            ->join('depths', 'assets.id', '=', 'depths.asset_id')
            ->join('float_scenarios', 'depths.float_scenario_id', '=', 'float_scenarios.id')
            ->where('float_scenarios.breach_location_id', $breachLocation)
            ->where('float_scenarios.load_level_id', $loadLevel)
            ->join('breach_locations', 'float_scenarios.breach_location_id', '=', 'breach_locations.id')
            ->first();

        //check if there are results
        if ($floatScenarios) {
            //define waterdepth and real threshold
            $waterDepth = $floatScenarios->water_depth;
            $thresholdReal = $this->threshold_real;

            //calculate the state
            if (($thresholdReal + 0.2) < $waterDepth) {
                return 2; //red
            } elseif ($waterDepth < ($thresholdReal - 0.2)) {
                return 0; //green
            }
            return 1; //orange
        }

        //cant find anything or breachlocation / loadlevel isn't set
        return null;
    }
}
