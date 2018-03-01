<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\CategoryRequest;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index', compact(''));
    }

    public function ajaxCategories(Request $request)
    {
        if($request->get('action') == 'ajax')
        {
            $categories = Category::select('id', 'name', 'state');
        }
        else if($request->get('action') == 'export')
        {
            return ['data' => 
                    Category::select('id', 'name', 'state')
                    ->orderBy('id', 'desc')->get()
                   ];
        }

        return datatables()
                ->eloquent($categories)
                ->filterColumn('state', function($query, $keyword) { 
                    $query->whereRaw("IF(state = 1, 'Activo', 'Inactivo') like ?", ["%{$keyword}%"]); 
                })
                ->addColumn('action', function ($categories) {
                    return route('admin.categories.edit', $categories->id).','.route('admin.categories.update', $categories->id).','.route('admin.categories.destroy', $categories->id);
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
    public function store(CategoryRequest $request)
    {               
        //dd($request->all());
        $user = Category::create([
            'name' => $request->get('name'),
            'state' => $request->get('state')
        ]);

        $request->session()->flash('flash', 'Se ha creado la categoría correctamente');

        return response()->json(['state' => true, 'url' => route('admin.categories.index')]);

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
        return Category::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->name = $request->get('name');
        $category->state = $request->get('state');

        $category->save();

        $request->session()->flash('flash', 'Se ha actualizado la categoría correctamente');

        return response()->json(['state' => true, 'url' => route('admin.categories.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        $category->state = 0;
        $category->save();
        
        $request->session()->flash('flash', 'Se ha desactivado la categoría correctamente');

        return response()->json(['state' => true, 'url' => route('admin.categories.index')]);
    }
}
