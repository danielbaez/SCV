<div class="modal fade" id="modal-configuration-edit">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header modal-header-form">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  	<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Editar Configuración</h4>
			</div>
			<form method="POST" action="" id="form-configuration-edit" enctype="multipart/form-data" autocomplete="off">
				{{ method_field('PUT') }}
				<input type="hidden" name="action" value="update">
				<div class="modal-body">
					<div class="row">				            
		              	<div class="col-xs-6">
			                <div class="form-group">
			                  <label for="name">*Empresa</label>
			                  <input name="company" type="text" class="form-control" id="company" placeholder="Empresa">
			                </div>
			                <div class="form-group">
			                  <label for="name">*Dirección</label>
			                  <input name="address" type="text" class="form-control" id="address" placeholder="Direccción">
			                </div>
		              	</div>
		              	<div class="col-xs-6">
		              		<div class="form-group">
			                  <label for="name">*Nro Documento</label>
			                  <input name="document" type="text" class="form-control" id="document" placeholder="Número de documento">
			                </div>
			                <div class="form-group">
			                  <label for="name">*Teléfono</label>
			                  <input name="phone" type="text" class="form-control" id="phone" placeholder="Direccción">
			                </div>
			                <div class="form-group">
			                  <label for="exampleInputFile">Logo</label>
			                  <input name="logo" type="file" class="form-control" id="logo">
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