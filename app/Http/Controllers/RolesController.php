<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;
use App\Role;

/**
 * Class RolesController
 * @package App\Http\Controllers
 * @author Rachelle de Zwart
 */
class RolesController extends Controller
{
    /**
     * Get all the roles to the roles.index page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }
    
    /**
     * show the relevant role by id
     * return a show view with the given data
     * @param $id role id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $role = Role::find($id);

        return view('roles.show', compact('role'));
    }

    /**
     * return the roles create view with all the roles from the database
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::all();

        return view('roles.create', compact('roles'));
    }

    /**
     * validate the data from the from, save it to the database and redirect the roles back
     * to the roles.index with a success flash message
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        $this->validate(request(), [
            'name' => [
                'required',
                'unique:roles,name',
                'min:3',
                'max:255',
            ],
            'description' => [
                'required',
                'min:3',
                'max:255',
            ],
        ]);

        $role = Role::create([
            'name' => request('name'),
            'description' => request('description'),
        ]);

        session()->flash('message', 'Rol met de naam "' . request('name') . '" is aangemaakt.');
        return redirect('/roles');
    }

    /**
     * Find the relevant role by id with all the roles in the database
     * return a edit view with the data
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $role = Role::find($id);

        return view('roles.edit', [
            'role' => $role,
        ]);
    }

    /**
     * validate the form data, get the relevant role by id and update it
     * redirect role back to the roles.index with a success flash message
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id)
    {
        
        $this->validate(request(), [
            'name' => [
                'required',
                Rule::unique('roles')->ignore($id),
                'min:3',
                'max:255',
            ],
            'description' => [
                'required',
                'min:3',
                'max:500',
            ],
        ]);

        $role = Role::find($id);

        $role->update([
            'name' => request('name'),
            'description' => request('description'),
        ]);

        session()->flash('message', 'Rol met de naam "' . request('name') . '" is gewijzigd.');
        return redirect('/roles');
    }

    /**
     * return the delete roles view with the relevant role
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete(role $role)
    {
        return view('roles.delete', compact('role'));
    }


    /**
     * Checks if role exists if so it gets deleted and
     * the role will be redirected back to the role.index
     * with a success flash message
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $roleName = $role ->name;

        $role->delete();
        $role->users()->detach();
        session()->flash('message', 'Rol met de naam "' . $roleName . '" is verwijdert.');
        return redirect('/roles');
    }
}
