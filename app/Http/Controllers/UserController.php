<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->get('search');

        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('users.index', ['users' => $users]);    
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);
        return view('users.show', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('viewAny', $user);

        $user->delete();
        return redirect()->route('foods.index');
    }

    public function showRegistrationForm()
    {
        $roles = Role::whereNotIn('name', ['admin', 'user'])->get(); 
        return view('auth.register', compact('roles')); 
    }
}
