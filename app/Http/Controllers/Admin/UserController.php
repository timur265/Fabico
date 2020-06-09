<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('admin.pages.users.index', compact(
            'users'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.pages.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);
        $role_id = $request->get('role_id');
        $user = User::create($request->all());
        $user->uploadImage($request->file('image'));
        $user->roles()->attach($role_id);
        $user->password = Hash::make($request->get('password'));
        $user->save();
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.pages.users.edit', compact(
            'user', 'roles'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::findOrFail($id);
        $roleId = $request->get('role_id');
        $password = $request->get('password');
        $user->update($request->all());
        $user->uploadImage($request->file('image'));
        $user->password = Hash::make($password);
        $user->save();
        $user->roles()->dettach();
        $user->roles()->attach($roleId);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index');
    }

    public function passwordChange(Request $request, $id)
    {
        if(Auth::user())
        {
            $request->validate([
                'oldPassword' => 'required',
                'newPassword' => 'required',
                'confPassword' => "required"
            ]);
            $user = User::findOrFail($id);
            if(Hash::check($request->get('oldPassword'), $user->password))
            {
                if($request->get('newPassword') == $request->get('confPassword'))
                {
                    $user->change($request->get('newPassword'));

                    return redirect()->back()->with('password_success', 'Пароль успешно изменен.');
                }else
                {
                    return redirect()->back()->with('password_confirmation_error', 'Новый пароль не совпадает с подтверждением.');
                }
            }else
            {
                return redirect()->back()->with('password_error', 'Пароль не совпадает с существующим.');
            }
        }

        return redirect()->back();
    }
}
