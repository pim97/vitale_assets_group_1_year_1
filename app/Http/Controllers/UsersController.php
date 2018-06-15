<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\User;
use App\Role;
use Hash;

/**
 * Class UsersController
 * @package App\Http\Controllers
 * @author Rachelle de Zwart
 */
class UsersController extends Controller
{
    /**
     * Get all the users to the users.index page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * show the relevant user by id
     * return a show view with the given data
     * @param $id user id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('users.show', compact('user'));
    }

    /**
     * return the users create view with all the users from the database
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $users = User::all();
        $roles = Role::all();

        return view('users.create', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    /**
     * validate the data from the from, save it to the database and redirect the user back
     * to the users.index with a success flash message
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|unique:users|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ]);

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
        ]);

        $user->roles()->attach(request('role'));

        session()->flash('message', 'Gebruiker met de naam "' . request('name') . '" is aangemaakt.');
        return redirect('/users');
    }

    /**
     * Find the relevant user by id with all the users in the database
     * return a edit view with the data
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();

        return view('users.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * validate the form data, get the relevant user by id and update it
     * redirect user back to the users.index with a success flash message
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id)
    {
        $this->validate(request(), [
            'name' => [
                'required',
                Rule::unique('users')->ignore($id),
                'min:3',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],
            'role' => 'required',
            'password' => 'required'
        ]);

        $user = User::find($id);

        $new_password = request('password');
        if (Hash::needsRehash($new_password)) {
            $new_password = Hash::make(request('password'));
        }

        $user->update([
            'name' => request('name'),
            'email' => request('email'),
            'role' => request('role'),
            'password' => $new_password,
        ]);

        
        $user->roles()->detach();
        $user->roles()->attach(request('role'));

        session()->flash('message', 'Gebruiker met de naam "' . request('name') . '" is gewijzigd.');
        return redirect('/users');
    }

    /**
     * return the delete users view with the relevant user
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete(user $user)
    {
        return view('users.delete', compact('user'));
    }


    /**
     * Checks if user exists if so it gets deleted and
     * the user will be redirected back to the user.index
     * with a success flash message
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $userName = $user->name;
        
        $user->delete();

        $user->roles()->detach();

        session()->flash('message', 'Gebruiker met de naam "' . $userName . '" is verwijdert.');
        return redirect('/users');
    }
}
