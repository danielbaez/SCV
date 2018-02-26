<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Voucher;
use App\Configuration;
use App\Http\Requests\ConfigurationRequest;

class ConfigurationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configuration = Configuration::first();
        return view('admin.configurations.index', compact('configuration'));
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
        return Configuration::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConfigurationRequest $request, Configuration $configuration)
    {
        $configuration->company = $request->get('company');
        $configuration->document = $request->get('document');
        $configuration->address = $request->get('address');
        $configuration->phone = $request->get('phone');
        $configuration->logo = $request->get('logo');

        $configuration->save();

        $request->session()->flash('flash', 'Se ha actualizado la configuración correctamente');

        return response()->json(['state' => true, 'url' => route('admin.configurations.index')]);
    }

}
