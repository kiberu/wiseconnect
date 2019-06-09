<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage-users');
        $this->middleware('permission:read-users', ['only' => ['index']]);
        $this->middleware('permission:delete-users', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $type = '' )
    {
        $users = User::all()->sortByDesc('created_at');

        if ($type == 'loan_officer' ) {
            $users = $users = User::role('loan_officer')->get()->sortByDesc('created_at');
        }
        return view('site/users/index')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        if (Auth::user()->hasRole('branch_manager') ) {
            foreach ($roles as $key => $role) {
                if ($role->name != 'loan_officer' ) {
                    unset($roles[$key]);
                }
            }
        }
        return view('site.users.create')->with(['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required',
            ]
        );


        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->assignRole($request['role']);
        $user->save();

        $users = User::all()->sortByDesc('created_at');
        Session::flash('success', 'User successfully added');
        return view('site/users/index')->withUsers($users);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->edit($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('site.users.edit')->with(['user'=>$user, 'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\User         $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate(
            $request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'role' => 'required',
            ]
        );

        if ($request->password ) {
            $this->validate(
                $request, [
                'password' => 'required|string|min:6|confirmed',
                ]
            );
            $request->password ? $user->password = Hash::make($request->password) : "";
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;

        if (! $user->hasRole($request->role) ) {
            $user->syncRoles([$request->role]);
        }
        $user->save();
        return redirect()->route('users.edit', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
      if ( $user->delete() ) {
        Session::flash('success', 'User successfully deleted');
        return redirect()->route('users.index');

      }

      if ( ! $user->delete() ) {
        Session::flash('error', 'User Not deleted');
        return redirect()->route('users.index');
      }



    }
}
