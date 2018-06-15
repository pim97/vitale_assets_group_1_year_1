<?php

namespace App\Http\Resources;

use DB;
use Illuminate\Http\Resources\Json\JsonResource;

class AssetResource extends JsonResource
{
    private $array = [];

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        //get current selected breachlocation by cookie 'breachlocation'
        $currentBreachLocation = $_COOKIE['breachlocation'] ? (int)$_COOKIE['breachlocation'] : 1;

        //setup geojson
        $this->array = [
            "type" => "Feature",
            "properties" => [
                "Asset" => trim($this->name),
                'id' => $this->id,
                'name' => trim($this->name),
                'description' => $this->description,
                'category' => [
                    'id' => $this->category_id,
                    'sub' => $this->category,
                ],
                'threshold' => [
                    'threshold_category' => $this->category->threshold,
                    'threshold_correction' => $this->threshold_correction,
                    'threshold_real' => $this->threshold_real,
                ],
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'links' => [
                    'self' => route('assets.show', ['assets' => $this->id]),
                ],
                'state' => $this->computeState($currentBreachLocation, 2), //get state from Asset model
            ],
            'geometry' => [
                'type' => 'Point',
                'coordinates' => [$this->x_coordinate, $this->y_coordinate]
            ],
        ];

        //return results
        return $this->array;
    }
}
