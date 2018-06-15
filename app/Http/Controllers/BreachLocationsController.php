<?php

namespace App\Http\Controllers;

use App\BreachLocation;
use Illuminate\Validation\Rule;

/**
 * Class BreachLocationsController
 * @package App\Http\Controllers
 * @author Ronnie
 */
class BreachLocationsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $breaches = BreachLocation::orderBy('id', 'asc')->get();
        return view("breaches.index", compact("breaches"));
    }

    /**
     * @param $id
     * @return $this
     */
    public function show($id)
    {
        $breach = BreachLocation::find($id);
        return view("breaches.show")->with('breach', $breach);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view("breaches.create");
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        $this->validate(request(), [
            'code' => 'required|min:3|max:255|unique:breach_locations',
            'name' => 'required|min:3|max:255',
            'longname' => 'required|min:3|max:255',
            'x_coordinate' => 'required|numeric',
            'y_coordinate' => 'required|numeric',
            'dykering' => 'required|integer',
            'vnk2' => 'required|integer',
        ]);

        BreachLocation::create([
            'code' => request('code'),
            'name' => request('name'),
            'longname' => request('longname'),
            'xcoord' => request('x_coordinate'),
            'ycoord' => request('y_coordinate'),
            'dykering' => request('dykering'),
            'vnk2' => request('vnk2'),
        ]);

        session()->flash('message', 'Breslocatie "' . request('name') . '" is aangemaakt.');
        return redirect('/breaches');
    }

    /**
     * @param $id
     * @return $this
     */
    public function edit($id)
    {
        $breach = BreachLocation::find($id);
        return view("breaches.edit")->with('breach', $breach);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id)
    {
        $this->validate(request(), [
            'code' => [
                'required',
                Rule::unique('breach_locations')->ignore($id),
                'min:3',
                'max:255',
            ],
            'name' => 'required|min:3|max:255',
            'longname' => 'required|min:3|max:255',
            'x_coordinate' => 'required|numeric',
            'y_coordinate' => 'required|numeric',
            'dykering' => 'required|integer',
            'vnk2' => 'required|integer',
        ]);

        BreachLocation::where('id', $id)->update([
            'code' => request('code'),
            'name' => request('name'),
            'longname' => request('longname'),
            'xcoord' => request('x_coordinate'),
            'ycoord' => request('y_coordinate'),
            'dykering' => request('dykering'),
            'vnk2' => request('vnk2'),
        ]);

        session()->flash('message', 'Breslocatie "' . request('name') . '" is gewijzigd.');
        return redirect('/breaches');
    }

    /**
     * @param $id
     * @return $this
     */
    public function delete($id)
    {
        $breach = BreachLocation::find($id);
        return view("breaches.delete")->with('breach', $breach);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $breach = BreachLocation::find($id);
        BreachLocation::where('id', $id)->delete();

        session()->flash('message', 'Breslocatie "' . $breach->name . '" is verwijderd.');
        return redirect('/breaches');
    }
}
