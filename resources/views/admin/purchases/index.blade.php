@extends('admin.layout')

@push('styles')
	<link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/datatables-export-buttons/buttons.dataTables.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/easy-autocomplete.min.css') }}">
@endpush

@section('header')
	<h1 id="header-purchases-index">
		{{-- COMPRAS <button type="button" class="btn btn-success pull-right" id="form-purchase-create">
		<i class="fa fa-plus"></i> CREAR</button> --}}
		COMPRAS <a href="{{ route('admin.purchases.create') }}" class="btn btn-success pull-right" id="form-purchase-create">
		<i class="fa fa-plus"></i> CREAR</a>
	</h1>
	<h1 id="header-purchases-create" style="display: none">
		AGREGAR COMPRA</button>
	</h1>
@endsection
@section('content')

<div class="row">

	<div class="modal modal-info fade" id="modal-export">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Procesando registros a descargar ...</h4>
				</div>
				<div class="modal-body">
					<div class="overlay">
						<i class="fa fa-refresh fa-spin"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	
	{{-- @include('admin.purchases.edit')
	@include('admin.purchases.delete')--}}

    <div class="col-xs-12" id="div-purchase-index">
    	<div class="box box-primary">
            <div class="box-body">
            	<div class="table-responsive">
	            	<table class="table table-bordered table-hover table-width-100" id="purchases" data-url="{{ route('admin.purchases.ajaxPurchases') }}" data-url-image="{{asset('images/usuarios')}}">
				  		<thead>
				  			<th class="r">ID</th>
				  			<th class="r">Proveedor</th>
				  			<th class="r">Comprobante</th>
				  			<th class="r">Nro Serie</th>
				  			<th class="r">nro Comprobante</th>
				  			<th class="r">Total</th>
				  			<th class="r">Fecha</th>
				  			<th class="r">Estado</th>
				  			<th class="">Acciones</th>
				  		</thead>
				  	</table>
				</div>
            </div>
    	</div>
    </div>

    {{-- @include('admin.purchases.create') --}}

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