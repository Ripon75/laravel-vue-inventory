<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.user.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required'],
            'email'    => ['required', 'email', "unique:users,email"],
            'password' => ['required', 'confirmed']
        ]);

        $name            = $request->input('name', null);
        $email           = $request->input('email', null);
        $password        = $request->input('password', null);
        $passwordConfirm = $request->input('password_confirmation', null);

        $userObj = new User();

        $userObj->name     = $name;
        $userObj->email    = $email;
        $userObj->password = Hash::make($password);
        $userObj->save();

        flash('User created successfully')->success();
        return redirect()->route('users.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.user.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'     => ['required'],
            'email'    => ['required', 'email', "unique:users,email,$id"],
            'password' => ['nullable', 'confirmed']
        ]);

        $name            = $request->input('name', null);
        $email           = $request->input('email', null);
        $password        = $request->input('password', null);
        $passwordConfirm = $request->input('password_confirmation', null);

        $user = User::find($id);

        $user->name     = $name;
        $user->email    = $email;
        if (!empty($password)) {
            $user->password = Hash::make($password);
        }
        $user->save();

        flash('User updated successfully')->success();
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        flash('User deleted successfully')->success();
        return redirect()->route('users.index');
    }

    function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
