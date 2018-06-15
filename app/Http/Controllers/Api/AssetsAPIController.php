<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Asset;
use App\Http\Resources\AssetResource;
use App\Http\Resources\AssetsResource;

class AssetsAPIController extends Controller
{
    /**
     * @return AssetsResource
     */
    public function index()
    {
        //remove data wrap
        AssetsResource::withoutWrapping();
        $assets = Asset::all();
        return new AssetsResource($assets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param Asset $asset
     * @return AssetResource
     */
    public function show(Asset $asset)
    {
        //remove data wrap
        AssetsResource::withoutWrapping();
        return new AssetResource($asset);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
