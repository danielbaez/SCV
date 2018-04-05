<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use App\Purchase_detail;
use App\Product;
use App\Provider;
use App\Voucher;
use App\Configuration;
use App\Inventory;
use App\Http\Requests\PurchaseRequest;
//use Carbon\Carbon;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.purchases.index', compact(''));
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
                    $query->whereRaw("IF(state = 1, 'Aceptado', 'Anulado') like ?", ["%{$keyword}%"]); 
                })
                ->addColumn('action', function ($purchases) {
                    return route('admin.purchases.show', $purchases->id).','.route('admin.purchases.destroy', $purchases->id);
                })
                /*->editColumn('date', function($purchases) {
                    return Carbon::parse($purchases->date)->format('d/m/Y');
                })*/
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
        $configuration = Configuration::first();
        return view('admin.purchases.create', compact('providers', 'vouchers', 'configuration'));
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
            'date' => implode("-", array_reverse(explode("/", $request->get('date')))),
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
            $product->purchase_price = $purchase_price[$key];
            $product->stock += $quantity[$key];
            $product->save();

            Inventory::create([
                'product_id' => $product->id,
                'table_id' => $purchase->id,
                'initial_balance' => $product->stock - $quantity[$key],
                'input' => $quantity[$key],
                'output' => 0,
                'balance' => $product->stock
            ]);
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
        $currency = Configuration::first()->currency;
        $detail = Purchase::with('provider')->with(array('purchase_detail'=>function($query) {
                        $query->with(array('product' => function($query) {
                            $query->with('category')->with('brand')->with('presentation');
                        }));
                    }))->where('purchases.id', $id)->get();
        $detail[0]->currency = $currency;
        return $detail;
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
    public function destroy(Request $request, Purchase $purchase)
    {
        if($purchase->state == 1)
        {
            $purchase->state = 0;
            $purchase->save();

            $purchase_detail = Purchase_detail::where('purchase_id', $purchase->id)->get();

            foreach ($purchase_detail as $key => $value) {
                $product = Product::find($value->product_id);
                $product->stock -= $value->quantity;
                $product->save();

                $inventory_for_delete = Inventory::where('product_id', $value->product_id)->where('table_id', $purchase->id)->where('input', $value->quantity)->get();

                Inventory::find($inventory_for_delete[0]->id)->delete();

                $inventory_update = Inventory::where('product_id', $value->product_id)->where('input', '>', 0)->where('id', '>', $inventory_for_delete[0]->id)->get();

                foreach ($inventory_update as $key => $inventory)
                {
                    $upd = Inventory::find($inventory->id);
                    $upd->initial_balance = $upd->initial_balance - $inventory_for_delete[0]->input;
                    $upd->balance = $upd->initial_balance + $upd->input;
                    $upd->save();
                }

            }        
            
            $request->session()->flash('flash', 'Se ha anulado la compra correctamente');

            return response()->json(['state' => true, 'url' => route('admin.purchases.index')]);
        }
    }
}
