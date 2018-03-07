<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use App\Purchase_detail;
use App\Product;
use App\Provider;
use App\Voucher;
use App\Http\Requests\PurchaseRequest;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::all();
        $vouchers = Voucher::all();
        return view('admin.purchases.index', compact('providers', 'vouchers'));
    }

    public function ajaxPurchases(Request $request)
    {
        if($request->get('action') == 'ajax')
        {
            $purchases = Purchase::select('id', 'provider_id', 'voucher', 'voucher_serie', 'voucher_number', 'total', 'date', 'state')->with('provider');
        }
        else if($request->get('action') == 'export')
        {
            return ['data' => 
                    Purchase::select('id', 'provider_id', 'voucher', 'voucher_serie', 'voucher_number', 'total', 'date', 'state')
                    ->with(array('provider'=>function($query) {
                        $query->select('id', 'business_name');
                    }))
                    ->orderBy('id', 'desc')->get()
                    ];
        }

        return datatables()
                ->eloquent($purchases)
                ->filterColumn('state', function($query, $keyword) { 
                    $query->whereRaw("IF(state = 1, 'Activo', 'Inactivo') like ?", ["%{$keyword}%"]); 
                })
                ->addColumn('action', function ($purchases) {
                    return route('admin.purchases.edit', $purchases->id).','.route('admin.purchases.update', $purchases->id).','.route('admin.purchases.destroy', $purchases->id);
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
        $providers = Provider::all();
        $vouchers = Voucher::all();
        return view('admin.purchases.create', compact('providers', 'vouchers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseRequest $request)
    {
        //dd($request->all());

        $product_id = $request->get('product_id');
        $quantity = $request->get('quantity');
        $purchase_price = $request->get('purchase_price');
        $total = 0;

        foreach ($product_id as $key => $value) {
            $total+= $quantity[$key] * $purchase_price[$key];
        }

        $purchase = Purchase::create([
            'user_id' => auth()->user()->id,
            'provider_id' => $request->get('provider_id'),
            'voucher' => $request->get('voucher'),
            'voucher_serie' => $request->get('voucher_serie'),
            'voucher_number' => $request->get('voucher_number'),
            'total' => $total,
            'date' => $request->get('date'),
            'state' => 1
        ]);

        $purchase->save();

        foreach ($product_id as $key => $value) {
            Purchase_detail::create([
                'purchase_id' => $purchase->id,
                'product_id' => $value,
                'quantity' => $quantity[$key],
                'price' => $purchase_price[$key]
            ]);
            $product = Product::find($value);
            $product->sale_price = $purchase_price[$key];
            $product->stock += $quantity[$key];
            $product->save();
        }

        $request->session()->flash('flash', 'Se ha creado la compra correctamente');

        return response()->json(['state' => true, 'url' => route('admin.purchases.index')]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
