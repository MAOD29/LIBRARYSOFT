<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request; 
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\CreateUserRequest;
class UsersController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles:admin',['except' => ['edit','update','show']]);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users= User::with(['roles'])->get();
        return view ('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         $roles = Role::pluck('display_name','id');
         return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        //
        $user= User::create( $request->all());
        $user->roles()->attach($request->roles);
        return redirect()->route('usuarios.index')->with('info','Usuario creado');
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
        $user =User::findOrFail($id);
        return view ('users.show',compact('user'));
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
         $user = User::findOrFail($id);

         $this->authorize('edit',$user);

        $roles = Role::pluck('display_name','id');
        return view('users.edit',compact('user','roles'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        //
        $user = User::findOrFail($id);
        $this->authorize('update',$user);
        $user->update($request->only('name','email','password'));
        $user->roles()->sync($request->roles);
        return back()->with('info','Usuario actualizado');
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
        $user = User::findOrFail($id);
        $user->delete();
         return back()->with('info','Usuario eliminado');
    }
}
