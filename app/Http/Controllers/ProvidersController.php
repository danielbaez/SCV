<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provider;
use App\Http\Requests\ProviderRequest;

class ProvidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.providers.index', compact(''));
    }

    public function ajaxProviders(Request $request)
    {
        if($request->get('action') == 'ajax')
        {
            $providers = Provider::select('id', 'business_name', 'name', 'lastname', 'document', 'address', 'phone', 'state');
        }
        else if($request->get('action') == 'export')
        {
            return ['data' => 
                    Provider::select('id', 'business_name', 'name', 'lastname', 'document', 'address', 'phone', 'state')
                    ->orderBy('id', 'desc')->get()
                   ];
        }

        return datatables()
                ->eloquent($providers)
                ->filterColumn('state', function($query, $keyword) { 
                    $query->whereRaw("IF(state = 1, 'Activo', 'Inactivo') like ?", ["%{$keyword}%"]); 
                })
                ->addColumn('action', function ($providers) {
                    return route('admin.providers.edit', $providers->id).','.route('admin.providers.update', $providers->id).','.route('admin.providers.destroy', $providers->id);
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
    public function store(ProviderRequest $request)
    {
        $provider = Provider::create([
            'business_name' => $request->get('business_name'),
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'document' => $request->get('document'),
            'address' => $request->get('address'),
            'phone' => $request->get('phone'),
            'state' => $request->get('state')
        ]);

        $provider->save();

        $request->session()->flash('flash', 'Se ha creado el proveedor correctamente');

        return response()->json(['state' => true, 'url' => route('admin.providers.index')]);
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
        return Provider::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProviderRequest $request, Provider $provider)
    {
        $provider->business_name = $request->get('business_name');
        $provider->name = $request->get('name');
        $provider->lastname = $request->get('lastname');
        $provider->document = $request->get('document');
        $provider->address = $request->get('address');
        $provider->phone = $request->get('phone');
        $provider->state = $request->get('state');

        $provider->save();

        $request->session()->flash('flash', 'Se ha actualizado el proveedor correctamente');

        return response()->json(['state' => true, 'url' => route('admin.providers.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Provider $provider)
    {
        $provider->state = 0;
        $provider->save();
        
        $request->session()->flash('flash', 'Se ha desactivado el proveedor correctamente');

        return response()->json(['state' => true, 'url' => route('admin.providers.index')]);
    }
}
