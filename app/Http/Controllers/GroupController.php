<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use Auth;
use Session;

class GroupController extends Controller
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
        if(Auth::user()->hasRole('superadministrator')){
            $groups = Group::paginate(10);
        }else{
            $groups = Group::where('owner_client_id', Auth::user()->id)->paginate(10);
        }
        return view('manage.groups.index')->withGroups($groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('manage.groups.create');
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
            'description' => 'required|max:2000'
        ]);

        $group = new Group();
        $group->name = $request->name;
        $group->description = $request->description;
        $group->owner_client_id = Auth::user()->id;
        $group->save();

        Session::flash('success', "Successfully created the group {$group->name}.");
        return redirect()->route('groups.show', $group->id);
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
        $group = Group::find($id);
        return view('manage.groups.show')->withGroup($group);
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
        $group = Group::find($id);
        return view('manage.groups.edit')->withGroup($group);
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
            'description' => 'required|max:2000'
        ]);

        $group = Find($id);
        $group->name = $request->name;
        $group->description = $request->description;
        $group->save();

        Session::flash('success', "Successfully edited the group {$group->name}.");
        return redirect()->route('groups.show', $group->id);
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
        $group = Group::find($id);
        $group->delete();
        
        return redirect()->route('groups.index');
    }
}
