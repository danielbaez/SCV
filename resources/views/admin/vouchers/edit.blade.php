<div class="modal fade" id="modal-voucher-edit">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header modal-header-form">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  	<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Editar Comprobante</h4>
			</div>
			<form method="POST" action="" id="form-voucher-edit" autocomplete="off">
				{{ method_field('PUT') }}
				<input type="hidden" name="action" value="update">
				<div class="modal-body">
					<div class="row">				            
		              	<div class="col-xs-6">
		              		<div class="form-group">
			                  <label for="rol">*Tipo</label>
		                         <select name="name" class="form-control" id="name">
		                         	<option value="">Seleccione un tipo de comprobante</option>
                                    @foreach($types as $type)
                                    	<option value="{{ $type['id'] }}">{{ $type['name'] }}</option>
                                    @endforeach
                                </select>
			                </div>
			                <div class="form-group">
			                  <label for="name">*Nro Incial</label>
			                  <input name="from" type="text" class="form-control" id="from" placeholder="Número inicial">
			                </div>
		              	</div>
		              	<div class="col-xs-6">
		              		<div class="form-group">
			                  <label for="name">*Nro Serie</label>
			                  <input name="serie" type="text" class="form-control" id="serie" placeholder="Número de serie">
			                </div>
			                <div class="form-group">
			                  <label for="name">*Nro Final</label>
			                  <input name="to" type="text" class="form-control" id="to" placeholder="Número final">
			                </div>
			                <div class="form-group">
			                  <label for="state">*Estado</label>
			                  <br>
			                  <label class="radio-inline"><input name="state" type="radio" value="1" checked>Activo</label>
							  <label class="radio-inline"><input name="state" type="radio" value="0">Inactivo</label>
			                </div>
		              	</div>
		              </div>
				</div>
				<div class="modal-footer modal-footer-form">
					<button type="button" class="btn btn-outline" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-outline">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>