<div class="modal fade" id="modal-product-create">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header modal-header-form">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  	<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Crear Producto</h4>
			</div>
			<form method="POST" action="{{ route('admin.products.store') }}" id="form-product-create" autocomplete="off">
				<input type="hidden" name="action" value="store">
				<div class="modal-body">
					<div class="row">				            
		              	<div class="col-xs-6">
		              		<div class="form-group">
			                  <label for="rol">*Categoría</label>
		                         <select name="category_id" class="form-control" id="category_id">
		                         	<option value="">Seleccione una categoría</option>
                                    @foreach($categories as $category)
                                    	<option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
			                </div>
			                <div class="form-group">
			                  <label for="presentation">*Presentación</label>
		                         <select name="presentation_id" class="form-control" id="presentation_id">
		                         	<option value="">Seleccione una presentación</option>
                                    @foreach($presentations as $presentation)
                                    	<option value="{{ $presentation->id }}">{{ $presentation->name }}</option>
                                    @endforeach
                                </select>
			                </div>		              		
			                <div class="form-group">
			                  <label for="minimum_stock">*Stock Mínimo</label>
			                  <input name="minimum_stock" type="text" class="form-control" id="minimum_stock" placeholder="Stock mínimo">
			                </div>
			                <div class="form-group">
			                  <label for="purchase_price">*Precio de compra</label>
			                  <input name="purchase_price" type="text" class="form-control" id="purchase_price" placeholder="Precio de compra">
			                </div>
			                <div class="form-group">
			                  <label for="barcode">Código de barra</label>
			                  <input name="barcode" type="text" class="form-control" id="barcode" placeholder="Código de barra">
			                </div>			                
		              	</div>
		              	<div class="col-xs-6">
		              		<div class="form-group">
			                  <label for="brand">*Marca</label>
		                         <select name="brand_id" class="form-control" id="brand_id">
		                         	<option value="">Seleccione una marca</option>
                                    @foreach($brands as $brand)
                                    	<option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
			                </div>
			                <div class="form-group">
			                  <label for="name">*Nombre</label>
			                  <input name="name" type="text" class="form-control" id="name" placeholder="Nombre">
			                </div>
			                <div class="form-group">
			                  <label for="stock">*Stock</label>
			                  <input name="stock" type="text" class="form-control" id="stock" placeholder="Stock">
			                </div>
			                <div class="form-group">
			                  <label for="sale_price">*Precio de venta</label>
			                  <input name="sale_price" type="text" class="form-control" id="sale_price" placeholder="Precio de venta">
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