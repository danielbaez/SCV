@extends('admin.layout')

@push('styles')
	<link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/datatables-export-buttons/buttons.dataTables.min.css') }}">
@endpush

@section('header')
	<h1>
		USUARIOS <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal-user-create">
		<i class="fa fa-plus"></i> CREAR</button>
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

	@include('admin.users.create')
	@include('admin.users.edit')
	@include('admin.users.delete')

    <div class="col-xs-12">
    	<div class="box box-primary">
            <div class="box-body">
            	<div class="table-responsive">
	            	<table class="table table-bordered table-hover table-width-100" id="users" data-url="{{ route('admin.users.ajaxUsers') }}" data-url-image="{{asset('images/usuarios')}}">
				  		<thead>
				  			<th class="r">ID</th>
				  			<th class="r">Nombre</th>
				  			<th class="r">Apellido</th>
				  			<th class="r">Email</th>
				  			<th class="r">Documento</th>
				  			<th class="r hide_column">Dirección</th>
				  			<th class="r hide_column">Fecha Nac.</th>
				  			<th class="r hide_column">Celular</th>
				  			<th class="r">Rol</th>
				  			<th class="r">Estado</th>
				  			<th class="">Foto</th>
				  			<th class="hide_column">RolObject</th>
				  			<th class="">Acciones</th>
				  		</thead>
				  	</table>
				</div>
            </div>
    	</div>
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
	<script src="{{ asset('js/admin/script.js') }}"></script>
	<script src="{{ asset('js/admin/users.js') }}"></script>
@endpush