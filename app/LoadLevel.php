<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoadLevel extends Model
{
    protected $table = 'load_levels';

    protected $fillable = [
        "id", "code", "name", "description"
    ];

    public function floatScenarios()
    {
        return $this->hasMany('App\FloatScenario', 'load_level_id', 'id');
    }
}
