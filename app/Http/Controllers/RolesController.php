<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;
use App\Http\Requests\RolRequest;

class RolesController extends Controller
{
    public function index()
    {
    	$roles = Rol::all();
    	return view('admin.roles.index', compact('roles'));
    }

    public function store(RolRequest $request)
    {            	
    	//dd($request->all());
        $user = Rol::create([
        	'name' => $request->get('name'),
        	'state' => $request->get('state')
        ]);

        $request->session()->flash('flash', 'Se ha creado el rol correctamente');

        return response()->json(['state' => true, 'url' => route('admin.roles.index')]);

    }

    public function edit($id)
    {
        return Rol::find($id);
    }

    public function update(RolRequest $request, Rol $rol)
    {
        $rol->name = $request->get('name');
        $rol->state = $request->get('state');

        $rol->save();

        $request->session()->flash('flash', 'Se ha actualizado el rol correctamente');

        return response()->json(['state' => true, 'url' => route('admin.roles.index')]);
    }

    public function destroy(Request $request, Rol $rol)
    {
        $rol->state = 0;
        $rol->save();
        
        $request->session()->flash('flash', 'Se ha desactivado el rol correctamente');

        return response()->json(['state' => true, 'url' => route('admin.roles.index')]);
    }
}
