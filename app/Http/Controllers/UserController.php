<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Group;
use App\Client;
use App\Role;
use App\Permission;
use Auth;
use Hash;
use Session;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:superadministrator|administrator');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::where('clients.admin_id', Auth::user()->id)
            ->join('clients', 'users.client_id', '=', 'clients.id')
            ->select('users.*')
            ->paginate(10);
        return view('manage.users.index')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $groups = Group::where('owner_client_id', Auth::user()->id)->get();
        return view('manage.users.create')->withGroups($groups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|max:255',
            'password' => 'required|max:255|same:password_confirmation',
            'group' => 'integer',
            'email' => 'required|email|unique:users,email',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if($request->group == 0){
            $user->group_id = null;
        }else{
            $user->group_id = $request->group;   
        }
        
        $client = Client::where('admin_id', Auth::user()->id)->first();
        $user->client_id = $client->id;
        
        $user->save();
        
        $user_role = Role::find(3);
        $user->attachRole($user_role);

        Session::flash('success', "Successfully created the user {$user->email}.");
        return redirect()->route('users.show', $user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::find($id);
        return view('manage.users.show')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        $groups = Group::where('owner_client_id', Auth::user()->id)->get();
        if(Auth::user()->hasRole('superadministrator')){
            $roles = Role::all();
            $permissions = Permission::all();
        }else{
            $roles = null;
            $permissions = null;
        }
        return view('manage.users.edit')
            ->withUser($user)
            ->withGroups($groups)
            ->withRoles($roles)
            ->withPermissions($permissions);
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
        $this->validate($request, [
            'name' => 'required|max:255',
            'group' => 'integer',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        if($request->group == 0){
            $user->group_id = null;
        }else{
            $user->group_id = $request->group;
        }
        
        $user->save();
        
        if(Auth::user()->hasRole('superadministrator')){
            $user->syncRoles($request->roles);
            $user->syncPermissions($request->permissions);
        }
        
        Session::flash('success', "Successfully edited the user {$user->email}.");
        return redirect()->route('users.show', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::find($id);
        $email = $user->email;
        $user->delete();
        
        Session::flash('success', "Successfully deleted the user {$email}.");
        return redirect()->route('users.index');
    }
}
