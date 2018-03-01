<div class="modal fade" id="modal-provider-edit">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header modal-header-form">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  	<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Editar Proveedor</h4>
			</div>
			<form method="POST" id="form-provider-edit" action="" autocomplete="off">
				{{ method_field('PUT') }}
				<input type="hidden" name="action" value="update">
				<div class="modal-body">
					<div class="row">				            
		              	<div class="col-xs-6">		              		
			                <div class="form-group">
			                  <label for="business_name">*Razón Social</label>
			                  <input name="business_name" type="text" class="form-control" id="business_name" placeholder="Razón Social">
			                </div>
			                <div class="form-group">
			                  <label for="lastname">*Apellido</label>
			                  <input name="lastname" type="text" class="form-control" id="lastname" placeholder="Apellido">
			                </div>
			                <div class="form-group">
			                  <label for="address">*Dirección</label>
			                  <input name="address" type="text" class="form-control" id="address" placeholder="Dirección">
			                </div>		                
		              	</div>
		              	<div class="col-xs-6">
			                <div class="form-group">
			                  <label for="name">*Nombre</label>
			                  <input name="name" type="text" class="form-control" id="name" placeholder="Nombre">
			                </div>
			                <div class="form-group">
			                  <label for="document">*Nro de documento</label>
			                  <input name="document" type="text" class="form-control" id="document" placeholder="Nro de documento">
			                </div>
			                <div class="form-group">
			                  <label for="phone">Teléfono</label>
			                  <input name="phone" type="text" class="form-control" id="phone" placeholder="Teléfono">
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