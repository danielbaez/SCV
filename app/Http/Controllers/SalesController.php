<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\Sale_detail;
use App\Product;
use App\Customer;
use App\Voucher;
use App\Http\Requests\SaleRequest;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.sales.index', compact(''));
    }

    public function ajaxSales(Request $request)
    {
        if($request->get('action') == 'ajax')
        {
            $sales = Sale::select('id', 'customer_id', 'voucher', 'voucher_serie', 'voucher_number', 'total', 'date', 'state')->with('customer');
        }
        else if($request->get('action') == 'export')
        {
            return ['data' => 
                    Sale::select('id', 'customer_id', 'voucher', 'voucher_serie', 'voucher_number', 'total', 'date', 'state')
                    ->with(array('customer'=>function($query) {
                        $query->select('id', 'name', 'lastname');
                    }))
                    ->orderBy('id', 'desc')->get()
                    ];
        }

        return datatables()
                ->eloquent($sales)
                ->filterColumn('state', function($query, $keyword) { 
                    $query->whereRaw("IF(state = 1, 'Aceptado', 'Anulado') like ?", ["%{$keyword}%"]); 
                })
                ->addColumn('action', function ($sales) {
                    return route('admin.sales.show', $sales->id).','.route('admin.sales.destroy', $sales->id);
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
        $customers = Customer::all();
        $vouchers = Voucher::all();
        return view('admin.sales.create', compact('customers', 'vouchers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleRequest $request)
    {
        //dd($request->all());
        $product_id = $request->get('product_id');
        $quantity = $request->get('quantity');
        $sale_price = $request->get('sale_price');
        $total = 0;

        foreach ($product_id as $key => $value) {
            $total+= $quantity[$key] * $sale_price[$key];
        }

        $sale = Sale::create([
            'user_id' => auth()->user()->id,
            'customer_id' => $request->get('customer_id'),
            'voucher' => $request->get('voucher'),
            'voucher_serie' => $request->get('voucher_serie'),
            'voucher_number' => $request->get('voucher_number'),
            'total' => $total,
            'date' => $request->get('date'),
            'state' => 1
        ]);

        $sale->save();

        foreach ($product_id as $key => $value) {
            Sale_detail::create([
                'sale_id' => $sale->id,
                'product_id' => $value,
                'quantity' => $quantity[$key],
                'price' => $sale_price[$key]
            ]);
            $product = Product::find($value);
            $product->stock -= $quantity[$key];
            $product->save();
        }

        $request->session()->flash('flash', 'Se ha creado la venta correctamente');

        return response()->json(['state' => true, 'url' => route('admin.sales.index')]);
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