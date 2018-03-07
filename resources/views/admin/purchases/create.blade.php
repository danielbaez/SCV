@extends('admin.layout')

@push('styles')
	<link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/datatables-export-buttons/buttons.dataTables.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/easy-autocomplete.min.css') }}">
@endpush

@section('header')
	<h1 id="header-purchases-create">
		AGREGAR COMPRA</button>
	</h1>
@endsection
@section('content')

<div class="row">

    <div class="col-xs-12" id="div-purchase-create">
		<form id="form-purchase-store" action="{{ route('admin.purchases.store') }}">
			<input type="hidden" name="action" value="store">
			<div class="box box-primary">
				<div class="box-body">
					<div class="row">
						<div class="col-xs-3">
							<div class="form-group">
					            <label for="voucher">*Comprobante</label>
				                <select name="voucher" class="form-control" id="voucher">
				                 	<option value="">Seleccione un comp</option>
				                    {{-- @foreach($vouchers as $voucher)
				                    	<option value="{{ $voucher->id }}">{{ $voucher->name }}</option>
				                    @endforeach --}}
				                    <option value="Boleta">Boleta</option>
				                    <option value="Factura">Factura</option>
				                </select>
				            </div>
						</div>
						<div class="col-xs-3">
							<div class="form-group">
					            <label for="provider_id">*Proveedor</label>
				                <select name="provider_id" class="form-control" id="provider_id">
				                 	<option value="">Seleccione un proveedor</option>
				                    @foreach($providers as $provider)
				                    	<option value="{{ $provider->id }}">{{ $provider->business_name }}</option>
				                    @endforeach
				                </select>
				            </div>
						</div>
						<div class="col-xs-2">
							<div class="form-group">
					            <label for="voucher_serie">*Serie</label>
				                <input name="voucher_serie" type="text" class="form-control" id="voucher_serie" placeholder="Nro de serie">
				            </div>
						</div>
						<div class="col-xs-2">
							<div class="form-group">
					            <label for="voucher_number">*Nro de Venta</label>
				                <input name="voucher_number" type="text" class="form-control" id="voucher_number" placeholder="Nro de comprobante">
				            </div>
						</div>
						<div class="col-xs-2">
							<div class="form-group">
					            <label for="date">*Fecha</label>
				                <input name="date" type="date" class="form-control" id="date">
				            </div>
						</div>
					</div>
				</div>
			</div>
			<div class="box box-primary">
				<div class="box-body">
					<div class="row">
						<div class="col-xs-3">
							<div class="form-group">
					            <label for="barcode">*Código</label>
				                <input type="text" class="form-control" id="barcode" placeholder="Busca por código">
				            </div>
						</div>
						<div class="col-xs-5">
							<div class="form-group">
					            <label for="product">*Producto</label>
				                <input type="text" class="form-control" id="autocomplete-product-purchase" placeholder="Busca por nombre de producto" data-url="{{ route('admin.products.purchase.autocomplete') }}">
				            </div>
						</div>
						<div class="col-xs-4 text-center">
							<div style="padding: 10px; background: #1d81d7; color: white">
								<span style="font-size: 30px; font-weight: bold">S/ <span id="total">0.00</span></span>
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
					  			<th class="text-center">Cantidad</th>
					  			<th class="text-center">Precio</th>
					  			<th class="text-cente">Eliminar</th>
					  		</thead>
					  		<tbody id="tbody-products">
					  			
					  		</tbody>
					  	</table>
					</div>
				</div>
			</div>

			<div class="row div-save-purchase" style="display: none">
				<div class="col-xs-12 text-center">
					<button type="submit" class="btn btn-success">GUARDAR COMPRA</button>
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
	<script src="{{ asset('js/jquery.easy-autocomplete.min.js') }}"></script>
	<script src="{{ asset('js/admin/script.js') }}"></script>
	<script src="{{ asset('js/admin/purchases.js') }}"></script>
@endpush