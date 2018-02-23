<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rol;
use DB;
use App\Http\Requests\CreateUserRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::all();
        //return User::with('rol')->get();

        return view('admin.users.index', compact('roles'));
    }

    public function ajaxUsers(Request $request)
    {
        if($request->get('action') == 'ajax')
        {
            $users = User::with('rol');    
        }
        else if($request->get('action') == 'export')
        {
            //return ['data' => ['id' => 1, 'name' => 'dede', 'lastname' => 'dede', 'email' => 'deef', 'document' => 'fefe', 'rol_id' => 'fefe', 'state' => 1, 'rol' => ['name' => 'fefe']]];

            //return array('data' => array(array(1, 'dede', 'dede', 'deef', 'fefe', 'rdede', 1, [1, 'fefe'])));

            return ['data' => 
                    User::select('id', 'name', 'lastname', 'email', 'document', 'address', 'birth_date', 'phone', 'rol_id', 'state', 'photo')
                    ->with(array('rol'=>function($query) {
                        $query->select('id', 'name');
                    }))
                    ->orderBy('id', 'desc')->get()
                    ];
        }
        /*return datatables()->eloquent($users)->toJson();*/

        return datatables()
                ->eloquent($users)
                ->filterColumn('state', function($query, $keyword) { 
                    $query->whereRaw("IF(state = 1, 'Activo', 'Inactivo') like ?", ["%{$keyword}%"]); 
                })
                /*->addColumn('action', function ($users) {
                    return '<a href="'.$users->id.'" class="btn btn-md btn-primary" title="Editar"><i class="fa fa-edit"></i></a> <a href="'.$users->id.'" class="btn btn-md btn-danger" title="Eliminar"><i class="fa fa-ban"></i></a>';
                })*/
                ->addColumn('action', function ($users) {
                    return route('admin.users.edit', $users->id);
                })
                ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {            	
    	//dd($request->all());
        $user = User::create([
        	'name' => $request->get('name'),
        	'lastname' => $request->get('lastname'),
        	'email' => $request->get('email'),
        	'password' => bcrypt($request->get('password')),
        	'state' => $request->get('state'),
        	'rol_id' => $request->get('rol_id'),
        	'document' => $request->get('document'),
        	'birth_date' => $request->get('birth_date'),
        	'address' => $request->get('address'),
        	'phone' => $request->get('phone')
        ]);

        if($request->hasFile('photo'))
        {
            $imageName = $user->id.'_'.$request->file('photo')->getClientOriginalName();

            $request->file('photo')->move(base_path() . '/public/images/usuarios/', $imageName);

            //$request->file('photo')->move(base_path() . '/../public_html/images/usuarios/', $imageName); 

            $user->photo = $imageName;
            $user->save();
        }

        $request->session()->flash('flash', 'Se ha creado el usuario correctamente');

        return response()->json(['state' => true, 'url' => route('admin.users.index')]);

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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateUserRequest $request, User $user)
    {
        $user->name = $request->get('name');
        $user->lastname = $request->get('lastname');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->state = $request->get('state');
        $user->rol_id = $request->get('rol_id');
        $user->document = $request->get('document');
        $user->birth_date = $request->get('birth_date');
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');

        if($request->hasFile('photo'))
        {
            //\File::delete(base_path() . '/../public_html/images/usuarios/'. $user->photo);
            \File::delete(base_path() . '/public/images/usuarios/'. $user->photo);
            $imageName = $user->id.'_'.$request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(base_path() . '/public/images/usuarios/', $imageName);
            //$request->file('photo')->move(base_path() . '/../public_html/images/usuarios/', $imageName);
            $user->photo = $imageName;
        }
        $user->save();

        $request->session()->flash('flash', 'Se ha actualizado el usuario correctamente');

        return response()->json(['state' => true, 'url' => route('admin.users.index')]);
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
    }
}
