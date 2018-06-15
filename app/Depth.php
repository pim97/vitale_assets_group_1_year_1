<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Depth extends Model
{
    protected $table = 'depths';

    protected $fillable = [
        "id", "asset_id", "water_depth"
    ];

    public function asset()
    {
        return $this->belongsTo('App\Asset', 'asset_id', 'id');
    }

    public function floatScenarios()
    {
        return $this->belongsTo('App\FloatScenario', 'float_scenario_id', 'id');
    }
}
