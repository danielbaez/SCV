<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Http\Requests\BrandRequest;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.brands.index', compact(''));
    }

    public function ajaxBrands(Request $request)
    {
        if($request->get('action') == 'ajax')
        {
            $brands = Brand::select('id', 'name', 'state');
        }
        else if($request->get('action') == 'export')
        {
            return ['data' => 
                    Brand::select('id', 'name', 'state')
                    ->orderBy('id', 'desc')->get()
                   ];
        }

        return datatables()
                ->eloquent($brands)
                ->filterColumn('state', function($query, $keyword) { 
                    $query->whereRaw("IF(state = 1, 'Activo', 'Inactivo') like ?", ["%{$keyword}%"]); 
                })
                ->addColumn('action', function ($brands) {
                    return route('admin.brands.edit', $brands->id).','.route('admin.brands.update', $brands->id).','.route('admin.brands.destroy', $brands->id);
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
    public function store(BrandRequest $request)
    {               
        //dd($request->all());
        $brand = Brand::create([
            'name' => $request->get('name'),
            'state' => $request->get('state')
        ]);

        $request->session()->flash('flash', 'Se ha creado la marca correctamente');

        return response()->json(['state' => true, 'url' => route('admin.brands.index')]);

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
        return Brand::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        $brand->name = $request->get('name');
        $brand->state = $request->get('state');

        $brand->save();

        $request->session()->flash('flash', 'Se ha actualizado la marca correctamente');

        return response()->json(['state' => true, 'url' => route('admin.brands.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Brand $brand)
    {
        $brand->state = 0;
        $brand->save();
        
        $request->session()->flash('flash', 'Se ha desactivado la marca correctamente');

        return response()->json(['state' => true, 'url' => route('admin.brands.index')]);
    }
}
