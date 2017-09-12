<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Role;
use Session;

class ClientController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:superadministrator');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clients = Client::paginate(10);
        return view('manage.clients.index')->withClients($clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $admins = Role::find(2)->users()->orderby('id', 'desc')->get();
        return view('manage.clients.create')->withAdmins($admins);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'admin_id' => 'required|integer'
        ]);

        $client = new Client();
        $client->name = $request->name;
        $client->admin_id = $request->admin_id;
        $client->save();

        Session::flash('success', "Successfully created the client {$client->name}.");
        return redirect()->route('clients.show', $client->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        return view('manage.clients.show')->withClient($client);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);
        $admins = Role::find(2)->users()->orderby('id', 'desc')->get();
        return view('manage.clients.edit')
            ->withClient($client)
            ->withAdmins($admins);
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
            'admin_id' => 'required|integer'
        ]);

        $client = Client::find($id);
        $client->name = $request->name;
        $client->admin_id = $request->admin_id;
        $client->save();

        Session::flash('success', "Successfully edited the client {$client->name}.");
        return redirect()->route('clients.show', $client->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        $name = $client->name;
        $client->delete();
        
        Session::flash('success', "Successfully deleted the client {$name}.");
        return redirect()->route('clients.index');
    }
}
