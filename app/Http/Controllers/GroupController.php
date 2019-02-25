<?php

namespace App\Http\Controllers;

use App\Models\Clients\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $groups = Group::all()->sortByDesc('created_at');
      return view('site/groups/index')->withGroups($groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('site.groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate( $request, [
        'name' => 'required|string|unique:groups|max:255',
        'landmark' => 'required|string|max:255',
      ]);


      $group = new Group;
      $group->name = $request->name;
      $group->landmark = $request->landmark;
      $group->save();

      return redirect()->route('groups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        return view('site/groups/show')->withGroup($group);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
      return view('site.groups.edit')->with(['group'=>$group]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
      $this->validate( $request, [
        'name' => 'required|string|unique:groups|max:255',
        'landmark' => 'required|string|max:255',
      ]);

      $group->name = $request->name;
      $group->landmark = $request->landmark;
      $group->save();

      return redirect()->route('groups.edit',$group);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //
    }
}
