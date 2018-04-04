@extends('admin.layout')

@push('styles')
	<link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/datatables-export-buttons/buttons.dataTables.min.css') }}">
@endpush

@section('header')
	<h1>
		CONFIGURACIÓN
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

	@include('admin.configurations.edit')

    <div class="col-xs-12">
    	<div class="box box-primary">
            <div class="box-body">
            	<div class="table-responsive">
	            	<table class="table table-bordered table-hover table-width-100" id="configurations">
				  		<thead>
				  			<th>Empresa</th>
				  			<th>Nro Documento</th>
				  			<th>Dirección</th>
				  			<th>Teléfono</th>
				  			<th>Impuesto</th>
				  			<th>Porcentaje</th>
				  			<th>Moneda</th>
				  			<th>Logo</th>
				  			<th>Acción</th>
				  		</thead>
				  		<tbody>
			  				<tr>
			  					<td>{{ $configuration->company }}</td>
			  					<td>{{ $configuration->document }}</td>
			  					<td>{{ $configuration->address }}</td>
			  					<td>{{ $configuration->phone }}</td>
			  					<td>{{ $configuration->tax }}</td>
			  					<td>{{ $configuration->tax_percentage }}</td>
			  					<td>{{ $configuration->currency }}</td>
			  					<td>
			  						@if($configuration->logo)
			  							<img style="width: 150px; margin: auto" class="img-responsive" src="{{asset('images/'.$configuration->logo)}}">
			  						@endif
			  					</td>
			  					</td>
			  					<td class="text-center">
			  						<button class="btn btn-md btn-primary" title="Editar" id="configuration-edit" data-url-edit="{{ route('admin.configurations.edit', $configuration->id) }}" data-url-update="{{ route('admin.configurations.update', $configuration->id) }}"><i class="fa fa-edit"></i></button>
			  					</td>
			  				</tr>
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
	<script src="{{ asset('js/admin/script.js') }}"></script>
	<script src="{{ asset('js/admin/configurations.js') }}"></script>
@endpush