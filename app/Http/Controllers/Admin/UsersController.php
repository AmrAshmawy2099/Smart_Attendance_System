<?php

namespace App\Http\Controllers\Admin;
use Gate;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Records;
use Auth;
use DB;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = user::paginate(10);
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Gate::denies('Manage-users')){
            return redirect(route('admin.users.index'));
        }
        $roles = Role::all();
        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function records(User $user)
    {
        if($user == Auth::user()){
            return view('admin.users.records')->with(
            'records' , Records::where('user_code',$user->code)->latest()->paginate(10)
        );}
        else {
            return redirect(route('home'));
        }

    }

    public function deleteAllRecords()
    {
        Records::truncate();
        return view('admin.users.records')->with(
            'records', Records::where('user_code',1)->paginate(10)
        );

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request,array(
            'email'=>'required|unique:users,email,'.$user->id,
            'code'=>'required|unique:users,code,'.$user->id,
            'name'=>'required | min:3',

        ));
        $user->roles()->sync($request->roles);
        $user->name=$request->name;
        $user->code=$request->code;
        $user->email=$request->email;
        $user->save();

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */


    public function destroy(User $user)
    {
        if(Gate::denies('delete-users')){
            return redirect(route('admin.users.index'));
        }
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
