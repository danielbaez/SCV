<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Http\Requests\CustomerRequest;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.customers.index', compact(''));
    }

    public function ajaxCustomers(Request $request)
    {
        if($request->get('action') == 'ajax')
        {
            $customers = Customer::select('id', 'name', 'lastname', 'document', 'address', 'phone', 'state');
        }
        else if($request->get('action') == 'export')
        {
            return ['data' => 
                    Customer::select('id', 'name', 'lastname', 'document', 'address', 'phone', 'state')
                    ->orderBy('id', 'desc')->get()
                   ];
        }

        return datatables()
                ->eloquent($customers)
                ->filterColumn('state', function($query, $keyword) { 
                    $query->whereRaw("IF(state = 1, 'Activo', 'Inactivo') like ?", ["%{$keyword}%"]); 
                })
                ->addColumn('action', function ($customers) {
                    return route('admin.customers.edit', $customers->id).','.route('admin.customers.update', $customers->id).','.route('admin.customers.destroy', $customers->id);
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
    public function store(CustomerRequest $request)
    {
        $customer = customer::create([
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'document' => $request->get('document'),
            'address' => $request->get('address'),
            'phone' => $request->get('phone'),
            'state' => $request->get('state')
        ]);

        $customer->save();

        $request->session()->flash('flash', 'Se ha creado el cliente correctamente');

        return response()->json(['state' => true, 'url' => route('admin.customers.index')]);
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
        return Customer::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $customer->name = $request->get('name');
        $customer->lastname = $request->get('lastname');
        $customer->document = $request->get('document');
        $customer->address = $request->get('address');
        $customer->phone = $request->get('phone');
        $customer->state = $request->get('state');

        $customer->save();

        $request->session()->flash('flash', 'Se ha actualizado el cliente correctamente');

        return response()->json(['state' => true, 'url' => route('admin.customers.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Customer $customer)
    {
        $customer->state = 0;
        $customer->save();
        
        $request->session()->flash('flash', 'Se ha desactivado el cliente correctamente');

        return response()->json(['state' => true, 'url' => route('admin.customers.index')]);
    }

    public function saleAutocomplete(Request $request)
    {
        $action = $request->get('action');
        if($action == 'customer-search')
        {
            $search = $request->get('query');
            $customers = Customer::where(function($query) use ($search) {
                            $query->whereRaw("CONCAT(name, ' ', lastname) LIKE '%{$search}%'");
                            //$query->orWhere('lastname', 'LIKE', "%{$search}%");
                            $query->orWhere('document', 'LIKE', "%{$search}%");
                        })->selectRaw('id, CONCAT(name, " ", lastname, " ", document) as text')->get();    
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
        return ['items' => $customers];
    }
}
