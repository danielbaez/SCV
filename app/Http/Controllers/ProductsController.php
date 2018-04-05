<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Brand;
use App\Presentation;
use App\Http\Requests\ProductRequest;
use App\Configuration;
use App\Inventory;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $presentations = Presentation::all();

        return view('admin.products.index', compact('categories', 'brands', 'presentations'));
    }

    public function ajaxProducts(Request $request)
    {
        if($request->get('action') == 'ajax')
        {
            $products = Product::with('category')->with('brand')->with('presentation');
            //dd($products);
        }
        else if($request->get('action') == 'export')
        {
            /*return ['data' => 
                    Product::select('id', 'category_id', 'brand_id', 'presentation_id', 'name', 'minimum_stock', 'stock', 'sale_price', 'state')
                    ->with(array('category'=>function($query) {
                        $query->select('id', 'name');
                    }))
                    ->with(array('brand'=>function($query) {
                        $query->select('id', 'name');
                    }))
                    ->with(array('presentation'=>function($query) {
                        $query->select('id', 'name');
                    }))
                    ->orderBy('id', 'desc')->get()
                    ];*/

            return ['data' => 
                    Product::select('id', 'category_id', 'brand_id', 'presentation_id', 'name', 'minimum_stock', 'stock', 'purchase_price', 'sale_price', 'state')
                    ->with('category')
                    ->with('brand')
                    ->with('presentation')
                    ->orderBy('id', 'desc')->get()
                    ];
        }

        return datatables()
                ->eloquent($products)
                ->filterColumn('state', function($query, $keyword) { 
                    $query->whereRaw("IF(state = 1, 'Activo', 'Inactivo') like ?", ["%{$keyword}%"]); 
                })
                ->addColumn('action', function ($products) {
                    return route('admin.products.edit', $products->id).','.route('admin.products.update', $products->id).','.route('admin.products.destroy', $products->id);
                })
                ->addColumn('currency', function ($products) {
                    return Configuration::first()->currency;
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
    public function store(ProductRequest $request)
    {
        $product = Product::create([
            'category_id' => $request->get('category_id'),
            'brand_id' => $request->get('brand_id'),
            'presentation_id' => $request->get('presentation_id'),
            'name' => $request->get('name'),
            'minimum_stock' => $request->get('minimum_stock'),
            'stock' => $request->get('stock'),
            'purchase_price' => $request->get('purchase_price'),
            'sale_price' => $request->get('sale_price'),
            'barcode' => $request->get('barcode'),
            'state' => $request->get('state')
        ]);

        Inventory::create([
            'product_id' => $product->id,
            'table_id' => $product->id,
            'initial_balance' => $product->stock,
            'input' => 0,
            'output' => 0,
            'balance' => $product->stock
        ]);

        $request->session()->flash('flash', 'Se ha creado el producto correctamente');

        return response()->json(['state' => true, 'url' => route('admin.products.index')]);
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
        return Product::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->category_id = $request->get('category_id');
        $product->brand_id = $request->get('brand_id');
        $product->presentation_id = $request->get('presentation_id');
        $product->name = $request->get('name');
        $product->minimum_stock = $request->get('minimum_stock');
        $product->stock = $request->get('stock');
        $product->purchase_price = $request->get('purchase_price');
        $product->sale_price = $request->get('sale_price');
        $product->barcode = $request->get('barcode');
        $product->state = $request->get('state');

        $product->save();

        $request->session()->flash('flash', 'Se ha actualizado el producto correctamente');

        return response()->json(['state' => true, 'url' => route('admin.products.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        $product->state = 0;
        $product->save();
        
        $request->session()->flash('flash', 'Se ha desactivado el producto correctamente');

        return response()->json(['state' => true, 'url' => route('admin.products.index')]);
    }

    public function purchaseAutocomplete(Request $request)
    {
        $action = $request->get('action');
        if($action == 'product-search')
        {
            $search = $request->get('query');
            //$products = Product::where('name', 'LIKE', "%{$search}%")->select('id', 'name')->get();    

            $products = Product::with('category')
                        ->with('brand')
                        ->with('presentation')
                        ->whereHas('category', function ($query) use ($search) {
                            $query->where('name', 'LIKE', "%{$search}%");
                        })
                        ->orWhereHas('brand', function ($query) use ($search) {
                            $query->where('name', 'LIKE', "%{$search}%");
                        })
                        ->orWhereHas('presentation', function ($query) use ($search) {
                            $query->where('name', 'LIKE', "%{$search}%");
                        })
                        ->orWhere('.name', 'LIKE', "%{$search}%")
                        ->get();
        }
        elseif($action == 'barcode')
        {
            $search = $request->get('query');
            $products = Product::where('barcode', $search)->select('id', 'name')->get(); 
        }
        elseif($action == 'product-detail')
        {
            $search = $request->get('id_product');
            $products = Product::with('category')->with('brand')->with('presentation')->where('products.id', $search)->get();
            $products = $products->toJson();    
        }
        return $products;
    }

    public function saleAutocomplete(Request $request)
    {
        $action = $request->get('action');
        if($action == 'product-search')
        {
            $search = $request->get('query');
            //$products = Product::where('name', 'LIKE', "%{$search}%")->select('id', 'name')->get();    

            $products = Product::with('category')
                        ->with('brand')
                        ->with('presentation')
                        ->whereHas('category', function ($query) use ($search) {
                            $query->where('name', 'LIKE', "%{$search}%");
                        })
                        ->orWhereHas('brand', function ($query) use ($search) {
                            $query->where('name', 'LIKE', "%{$search}%");
                        })
                        ->orWhereHas('presentation', function ($query) use ($search) {
                            $query->where('name', 'LIKE', "%{$search}%");
                        })
                        ->orWhere('.name', 'LIKE', "%{$search}%")
                        ->get();
        }
        elseif($action == 'barcode')
        {
            $search = $request->get('query');
            $products = Product::where('barcode', $search)->select('id', 'name')->get(); 
        }
        elseif($action == 'product-detail')
        {
            $search = $request->get('id_product');
            $products = Product::with('category')->with('brand')->with('presentation')->where('products.id', $search)->get();
            $products = $products->toJson();    
        }
        return $products;
    }
}
