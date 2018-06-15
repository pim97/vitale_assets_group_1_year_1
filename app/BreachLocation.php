<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BreachLocation extends Model
{

    protected $table = 'breach_locations';

    protected $fillable = [
        "id", "code", "name", "xcoord", "ycoord", "dykering", "longname", "vnk2"
    ];

    public function floatScenarios()
    {
        return $this->hasMany('App\FloatScenario', 'breach_location_id', 'id');
    }
}
