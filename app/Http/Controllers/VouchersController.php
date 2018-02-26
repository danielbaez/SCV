<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Voucher;
use App\Http\Requests\VoucherRequest;

class VouchersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Voucher::all();
        $types = [
            ['id' => 'Ticket', 'name' => 'Ticket'],
            ['id' => 'Boleta', 'name' => 'Boleta'],
            ['id' => 'Factura', 'name' => 'Factura']
        ];
        return view('admin.vouchers.index', compact('vouchers', 'types'));
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
    public function store(VoucherRequest $request)
    {               
        //dd($request->all());
        $voucher = Voucher::create([
            'name' => $request->get('name'),
            'serie' => $request->get('serie'),
            'from' => $request->get('from'),
            'to' => $request->get('to'),
            'state' => $request->get('state')
        ]);

        $request->session()->flash('flash', 'Se ha creado el comprobante correctamente');

        return response()->json(['state' => true, 'url' => route('admin.vouchers.index')]);

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
        return Voucher::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VoucherRequest $request, Voucher $voucher)
    {
        $voucher->name = $request->get('name');
        $voucher->serie = $request->get('serie');
        $voucher->from = $request->get('from');
        $voucher->to = $request->get('to');
        $voucher->state = $request->get('state');

        $voucher->save();

        $request->session()->flash('flash', 'Se ha actualizado el comprobante correctamente');

        return response()->json(['state' => true, 'url' => route('admin.vouchers.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Voucher $voucher)
    {
        $voucher->state = 0;
        $voucher->save();
        
        $request->session()->flash('flash', 'Se ha desactivado el comprobante correctamente');

        return response()->json(['state' => true, 'url' => route('admin.vouchers.index')]);
    }
}
