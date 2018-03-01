<div class="modal fade" id="modal-brand-create">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header modal-header-form">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  	<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Crear Marca</h4>
			</div>
			<form method="POST" action="{{ route('admin.brands.store') }}" id="form-brand-create" autocomplete="off">
				<input type="hidden" name="action" value="store">
				<div class="modal-body">
					<div class="row">				            
		              	<div class="col-xs-6">
		              		<div class="form-group">
			                  <label for="name">*Nombre</label>
			                  <input name="name" type="text" class="form-control" id="name" placeholder="Nombre">
			                </div>
		              	</div>
		              	<div class="col-xs-6">
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