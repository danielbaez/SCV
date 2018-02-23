<div class="modal fade" id="modal-user-edit">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header modal-header-form">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  	<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Editar usuario</h4>
			</div>
			<form method="POST" id="form-user-edit" action="" enctype="multipart/form-data" autocomplete="off">
				{{ method_field('PUT') }}
				<input type="hidden" name="action" value="update">
				<div class="modal-body">
					<div class="row">				            
		              	<div class="col-xs-6">
		              		<div class="form-group">
			                  <label for="name">*Nombre</label>
			                  <input name="name" type="text" class="form-control" id="name" placeholder="Nombre">
			                </div>
			                <div class="form-group">
			                  <label for="lastname">*Apellido</label>
			                  <input name="lastname" type="text" class="form-control" id="lastname" placeholder="Apellido">
			                </div>
			                <div class="form-group">
			                  <label for="email">*Email</label>
			                  <input name="email" type="email" class="form-control" id="email" placeholder="Email">
			                </div>
			                <div class="form-group">
			                  <label for="password">Contraseña</label>
			                  <input name="password" type="password" class="form-control" id="password" placeholder="Contraseña">
			                </div>
			                <div class="form-group">
			                  <label for="state">*Estado</label>
			                  <br>
			                  <label class="radio-inline"><input name="state" type="radio" value="1" checked>Activo</label>
							  <label class="radio-inline"><input name="state" type="radio" value="0">Inactivo</label>
			                </div>
			                <div class="form-group">
			                  <label for="rol">*Rol</label>
		                         <select name="rol_id" class="form-control" id="rol_id">
		                         	<option value="">Seleccione un rol</option>
                                    @foreach($roles as $rol)
                                    	<option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                    @endforeach
                                </select>
			                </div>
		              	</div>
		              	<div class="col-xs-6">
		              		
			                <div class="form-group">
			                  <label for="document">*Documento</label>
			                  <input name="document" type="text" class="form-control" id="document" placeholder="Documento" maxlength="8">
			                </div>
			                <div class="form-group">
			                  <label for="birth_date">*Fecha Nac.</label>
			                  <input name="birth_date" type="date" class="form-control" id="birth_date" placeholder="Documento">
			                </div>
			                <div class="form-group">
			                  <label for="address">*Dirección</label>
			                  <input name="address" type="text" class="form-control" id="address" placeholder="Dirección">
			                </div>
			                <div class="form-group">
			                  <label for="phone">*Celular</label>
			                  <input name="phone" type="text" class="form-control" id="phone" placeholder="Celular" maxlength="9">
			                </div>
			                <div class="form-group">
			                  <label for="exampleInputFile">Foto</label>
			                  <input name="photo" type="file" class="form-control" id="photo">
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