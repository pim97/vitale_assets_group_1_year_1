<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FloatScenario extends Model
{
    protected $table = 'float_scenarios';

    protected $primaryKey = 'id';

    protected $fillable = [
        "id", "breach_location_id", "load_level_id"
    ];

    public function depths()
    {
        return $this->hasMany('App\Depth', 'depth_id', 'id');
    }

    public function breachLocation()
    {
        return $this->belongsTo('App\BreachLocation', 'breach_location_id');
    }

    public function loadLevel()
    {
        return $this->belongsTo('App\LoadLevel', 'load_level_id');
    }

    public function assets()
    {
        return $this->belongsToMany('App\Asset', 'depths', 'float_scenario_id', 'asset_id');
    }
}
