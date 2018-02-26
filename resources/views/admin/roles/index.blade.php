@extends('admin.layout')

@push('styles')
	<link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/datatables-export-buttons/buttons.dataTables.min.css') }}">
@endpush

@section('header')
	<h1>
		ROLES <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal-rol-create">
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

	@include('admin.roles.create')
	@include('admin.roles.edit')
	@include('admin.roles.delete')

    <div class="col-xs-12">
    	<div class="box box-primary">
            <div class="box-body">
            	<div class="table-responsive">
	            	<table class="table table-bordered table-hover table-width-75" id="roles">
				  		<thead>
				  			<th>ID</th>
				  			<th>Rol</th>
				  			<th>Estado</th>
				  			<th>Acciones</th>
				  		</thead>
				  		<tbody>
				  			@foreach($roles as $rol)
				  				<tr>
				  					<td>{{ $rol->id }}</td>
				  					<td>{{ $rol->name }}</td>
				  					<td class="text-center">
				  						{!! $rol->state == 1 ? "<span class='badge alert-success'>Activo</span>" : "<span class='badge alert-danger'>Inactivo</span>" !!}
				  					</td>
				  					<td class="text-center">
				  						<button class="btn btn-md btn-primary" title="Editar" id="rol-edit" data-url-edit="{{ route('admin.roles.edit', $rol->id) }}" data-url-update="{{ route('admin.roles.update', $rol->id) }}"><i class="fa fa-edit"></i></button>
				  						<button class="btn btn-md btn-danger" title="Eliminar" id="rol-delete" data-url="{{ route('admin.roles.destroy', $rol->id) }}"><i class="fa fa-ban"></i></button>
				  					</td>
				  				</tr>
				  			@endforeach
				  		</tbody>
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
	<script src="{{ asset('js/admin/roles.js') }}"></script>
@endpush