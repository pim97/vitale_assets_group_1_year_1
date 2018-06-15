<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scenario;
use Yajra\DataTables\Facades\DataTables;

class ScenariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scenarios = Scenario::all();
        return view('scenario.index')->with('scenarios', $scenarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('scenario.create');
    }

    /**
     * @param $id
     * @return $this \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $scenarios = Scenario::find($id);
        return view('scenario.delete')->with('scenario', $scenarios);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => [
                'required',
                'min:3',
                'max:255',
            ],
            'description' => [
                'required',
                'min:3',
                'max:255',
            ],
        ]);

        $scenario = new Scenario;
        $scenario->name = $request->input('name');
        $scenario->description = $request->input('description');
        $scenario->save();

        return redirect('/scenarios')->with('message', 'Scenario ' . $scenario->name . ' is aangemaakt');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $scenarios = Scenario::find($id);
        return view('scenario.show')->with('scenario', $scenarios);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $scenarios = Scenario::find($id);
        return view("scenario.edit")->with('scenario', $scenarios);
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
        $this->validate($request, [
            'name' => [
                'required',
                'min:3',
                'max:255',
            ],
            'description' => [
                'required',
                'min:3',
                'max:255',
            ],
        ]);

        $scenario = Scenario::find($id);
        $scenario->name = $request->input('name');
        $scenario->description = $request->input('description');
        $scenario->save();

        return redirect('/scenarios')->with('message', 'Scenario ' . $scenario->name . ' is gewijzigd');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $scenario = Scenario::find($id);
        $scenario->delete();

        return redirect('/scenarios')->with('message', 'Scenario ' . $scenario->name . ' is verwijderd');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function getDataTable()
    {
        return DataTables::eloquent(Scenario::query())->make(true);
    }
}
