<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetPic extends Model
{
    protected $fillable = [
        'asset_id', 'image',
    ];
}
