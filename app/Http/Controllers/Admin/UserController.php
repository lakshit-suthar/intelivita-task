<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    |  Admin User Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles user related information functionality for the applications.
    |
     */

    /**
     * Show User List
     *
     * @return view
     */
    public function index(Request $request)
    {
         // Retrieve query parameters for sorting and searching
         $search = $request->get('search');
         $sort = $request->get('sort', 'name');
         $direction = $request->get('direction', 'asc');
 
         // Query the users, applying search and sorting
         $users = User::query()
             ->when($search, function ($query, $search) {
                 return $query->where('name', 'like', "%{$search}%")
                              ->orWhere('email', 'like', "%{$search}%");
             })
             ->orderBy($sort, $direction)
             ->paginate(10);
 
         // Return the view with the users
        return view('admin.users.index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.form', ['user' => new User()]);
    }


    /**
     * Store the resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create($request->all());

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return view
     */
    public function edit(User $user)
    {
        return view('admin.users.form', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($request->all());

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
