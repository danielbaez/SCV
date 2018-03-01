<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Presentation;
use App\Http\Requests\PresentationRequest;

class PresentationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.presentations.index', compact(''));
    }

    public function ajaxPresentations(Request $request)
    {
        if($request->get('action') == 'ajax')
        {
            $presentations = Presentation::select('id', 'name', 'state');
        }
        else if($request->get('action') == 'export')
        {
            return ['data' => 
                    Presentation::select('id', 'name', 'state')
                    ->orderBy('id', 'desc')->get()
                   ];
        }

        return datatables()
                ->eloquent($presentations)
                ->filterColumn('state', function($query, $keyword) { 
                    $query->whereRaw("IF(state = 1, 'Activo', 'Inactivo') like ?", ["%{$keyword}%"]); 
                })
                ->addColumn('action', function ($presentations) {
                    return route('admin.presentations.edit', $presentations->id).','.route('admin.presentations.update', $presentations->id).','.route('admin.presentations.destroy', $presentations->id);
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
    public function store(PresentationRequest $request)
    {               
        //dd($request->all());
        $presentation = Presentation::create([
            'name' => $request->get('name'),
            'state' => $request->get('state')
        ]);

        $request->session()->flash('flash', 'Se ha creado la presentación correctamente');

        return response()->json(['state' => true, 'url' => route('admin.presentations.index')]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Presentation::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PresentationRequest $request, Presentation $presentation)
    {
        $presentation->name = $request->get('name');
        $presentation->state = $request->get('state');

        $presentation->save();

        $request->session()->flash('flash', 'Se ha actualizado la presentación correctamente');

        return response()->json(['state' => true, 'url' => route('admin.presentations.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Presentation $presentation)
    {
        $presentation->state = 0;
        $presentation->save();
        
        $request->session()->flash('flash', 'Se ha desactivado la presentación correctamente');

        return response()->json(['state' => true, 'url' => route('admin.presentations.index')]);
    }
}
