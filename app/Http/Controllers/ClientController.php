<?php

namespace App\Http\Controllers;

use App\Models\Clients\Client;
use App\Models\Clients\Group;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Group $group )
    {

      return view('site.groups.clients.create')->with(['group' => $group]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Group $group)
    {
      $this->validate( $request, [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'gender' => 'required|string|max:255',
        'date_of_birth' => 'date|required|string|max:255',

        'next_of_kin' => 'required|string|max:255',
        'phone_number' => 'required|min:10',
        'residential_address' => 'required|string|max:255',
      ]);


      $client = new Client;
      $client->first_name = $request->first_name;
      $client->last_name = $request->last_name;
      $client->sex = $request->gender;
      $client->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));

      $client->next_of_kin = $request->next_of_kin;
      $client->phone_number = $request->phone_number;
      $client->residential_address = $request->residential_address;
      $client->save();

      $client->groups()->attach([$group->id]);

      return redirect()->route('groups.show', $group);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group, Client $client)
    {
        return view('site/groups/clients/show')->with(['group' => $group, 'client' => $client]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group, Client $client)
    {

      return view('site.groups.clients.edit')->with(['client' => $client, 'group' => $group]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group, Client $client)
    {
      $this->validate( $request, [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'gender' => 'required|string|max:255',
        'date_of_birth' => 'date|required|string|max:255',

        'next_of_kin' => 'required|string|max:255',
        'phone_number' => 'required|min:10',
        'residential_address' => 'required|string|max:255',
      ]);

      $client->first_name = $request->first_name;
      $client->last_name = $request->last_name;
      $client->sex = $request->gender;
      $client->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
      $client->next_of_kin = $request->next_of_kin;
      $client->phone_number = $request->phone_number;
      $client->residential_address = $request->residential_address;
      $client->update();

      $client->groups()->sync([$group->id]);

      return redirect()->route('clients.show', [$group, $client]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
