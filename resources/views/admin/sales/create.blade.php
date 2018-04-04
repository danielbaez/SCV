@extends('admin.layout')

@push('styles')
	<link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/datatables-export-buttons/buttons.dataTables.min.css') }}">
	<link rel="stylesheet" href="{{ asset('adminlte/bower_components/select2/dist/css/select2.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/easy-autocomplete.min.css') }}">
@endpush

@section('header')
	<h1 id="header-sales-create">
		AGREGAR VENTA</button>
	</h1>
@endsection
@section('content')

<div class="row">

    <div class="col-xs-12" id="div-sale-create">
		<form id="form-sale-store" action="{{ route('admin.sales.store') }}">
			<input type="hidden" name="action" value="store">
			<div class="box box-primary">
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12 col-md-4">
				            <div class="form-group">
				                <label for="customer_id">*Cliente</label>
				                <select name="customer_id" class="form-control customer-autocomplete" id="customer_id" data-url="{{ route('admin.customers.sale.autocomplete') }}" style="width: 100%;">
				                  <option selected="selected" value="">Busca por nombre o documento</option>
				                </select>
				            </div>
						</div>
						<div class="col-xs-12 col-md-4">
							<div class="form-group">
					            <label for="voucher">*Comprobante</label>
				                <select name="voucher" class="form-control" id="voucher" data-url="{{ route('admin.vouchers.information') }}">
				                 	<option value="">Seleccione un comprobante</option>
				                    @foreach($vouchers as $voucher)
				                    	<option value="{{ $voucher->id }}">{{ $voucher->name }}</option>
				                    @endforeach
				                </select>
				            </div>
						</div>
						<div class="col-xs-12 col-md-2">
							<div class="form-group">
					            <label for="voucher_serie">*Serie</label>
				                <input readonly name="voucher_serie" type="text" class="form-control" id="voucher_serie" placeholder="Nro de serie">
				            </div>
						</div>
						<div class="col-xs-12 col-md-2">
							<div class="form-group">
					            <label for="voucher_number">*Nro de Venta</label>
				                <input readonly name="voucher_number" type="text" class="form-control" id="voucher_number" placeholder="Nro de comprobante">
				            </div>
						</div>
					</div>
				</div>
			</div>
			<div class="box box-primary">
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12 col-md-3">
							<div class="form-group">
					            <label for="barcode">*Código</label>
				                <input type="text" class="form-control" id="search-barcode" placeholder="Busca por código de producto" data-url="{{ route('admin.products.sale.autocomplete') }}">
				            </div>
						</div>
						<div class="col-xs-12 col-md-5">
							<div class="form-group">
					            <label for="product">*Producto</label>
				                <input type="text" class="form-control" id="autocomplete-product-sale" placeholder="Busca por nombre, categoría, marca o presentación de producto" data-url="{{ route('admin.products.sale.autocomplete') }}">
				            </div>
						</div>
						<div class="col-xs-12 col-md-4 text-center">
							<div style="padding: 10px; background: #1d81d7; color: white">
								<span style="font-size: 30px; font-weight: bold">{{ $configuration->currency }}<span id="total">0.00</span></span>
							</div>
							<div class="row" style="margin: 0; border: 1px solid #1d81d7;">
								<div class="col-xs-6" style="border-right: 1px solid #1d81d7;">
									<p style="font-weight: bold">{{ $configuration->tax.' '.$configuration->tax_percentage.'%' }}</p>
									<p style="margin-bottom: 4px">{{ $configuration->currency }}<span id="percentage" data-percentage="{{ $configuration->tax_percentage }}">0.00</span></p>
								</div>
								<div class="col-xs-6">
									<p style="font-weight: bold">Subtotal</p>
									<p style="margin-bottom: 4px">{{ $configuration->currency }}<span id="subtotal">0.00</span></p>
								</div>								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box box-primary">
				<div class="box-body">
					<div class="table-responsive">
		            	<table class="table table-bordered table-hover">
					  		<thead>
					  			<th class="text-center">ID</th>
					  			<th class="text-center">Producto</th>
					  			<th class="text-center">Categoría</th>
					  			<th class="text-center">Marca</th>
					  			<th class="text-center">Presentación</th>
					  			<th class="text-center">Stock</th>
					  			<th class="text-center">Cantidad</th>
					  			<th class="text-center">Precio</th>
					  			<th class="text-center">Importe</th>
					  			<th class="text-cente">Eliminar</th>
					  		</thead>
					  		<tbody id="tbody-products">
					  			
					  		</tbody>
					  	</table>
					</div>
				</div>
			</div>

			<div class="row div-save-sale" style="display: none">
				<div class="col-xs-12 text-center">
					<button type="submit" class="btn btn-success">GUARDAR VENTA</button>
				</div>
			</div>
		</form>
	</div>

</div>

@endsection

@push('scripts')
	<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

	<script src="{{ asset('js/datatables-export-buttons/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('js/datatables-export-buttons/buttons.bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/datatables-export-buttons/jszip.min.js') }}"></script>
	<script src="{{ asset('js/datatables-export-buttons/pdfmake.min.js') }}"></script>
	<script src="{{ asset('js/datatables-export-buttons/vfs_fonts.js') }}"></script>
	<script src="{{ asset('js/datatables-export-buttons/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('js/datatables-export-buttons/buttons.print.min.js') }}"></script>
	<script src="{{ asset('js/datatables-export-buttons/buttons.colVis.min.js') }}"></script>
	<script src="{{ asset('adminlte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
	<script src="{{ asset('js/jquery.easy-autocomplete.min.js') }}"></script>
	<script src="{{ asset('js/admin/script.js') }}"></script>
	<script src="{{ asset('js/admin/sales.js') }}"></script>
@endpush