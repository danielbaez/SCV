<div class="col-xs-12"  style="display: none" id="div-purchase-create">
	<form>
		<div class="box box-primary">
			<div class="box-body">
				<div class="row">
					<div class="col-xs-3">
						<div class="form-group">
				            <label for="voucher">*Comprobante</label>
			                <select name="voucher" class="form-control" id="voucher">
			                 	<option value="">Seleccione un comp</option>
			                    @foreach($vouchers as $voucher)
			                    	<option value="{{ $voucher->id }}">{{ $voucher->name }}</option>
			                    @endforeach
			                </select>
			            </div>
					</div>
					<div class="col-xs-3">
						<div class="form-group">
				            <label for="provider_id">*Proveedor</label>
			                <select name="provider_id" class="form-control" id="provider_id">
			                 	<option value="">Seleccione un proveedor</option>
			                    @foreach($providers as $provider)
			                    	<option value="{{ $provider->id }}">{{ $provider->business_name }}</option>
			                    @endforeach
			                </select>
			            </div>
					</div>
					<div class="col-xs-2">
						<div class="form-group">
				            <label for="voucher_serie">*Serie</label>
			                <input name="voucher_serie" type="text" class="form-control" id="voucher_serie" placeholder="Nro de serie">
			            </div>
					</div>
					<div class="col-xs-2">
						<div class="form-group">
				            <label for="voucher_number">*Nro Comprobante</label>
			                <input name="voucher_number" type="text" class="form-control" id="voucher_number" placeholder="Nro de comprobante">
			            </div>
					</div>
					<div class="col-xs-2">
						<div class="form-group">
				            <label for="date">*Fecha</label>
			                <input name="date" type="date" class="form-control" id="date">
			            </div>
					</div>
				</div>
			</div>
		</div>
		<div class="box box-primary">
			<div class="box-body">
				<div class="row">
					<div class="col-xs-3">
						<div class="form-group">
				            <label for="barcode">*Código</label>
			                <input name="barcode" type="text" class="form-control" id="barcode" placeholder="Busca por código">
			            </div>
					</div>
					<div class="col-xs-5">
						<div class="form-group">
				            <label for="product">*Producto</label>
			                <input name="product" type="text" class="form-control" id="autocomplete-producto-compra" placeholder="Busca por nombre de producto" data-url="{{ route('admin.products.purchase.autocomplete') }}">
			            </div>
					</div>
					<div class="col-xs-4 text-center">
						<div style="padding: 10px; background: green; color: white">
							<span style="font-size: 25px">S/ 0.00</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="box box-primary">
			<div class="box-body">
				<div class="table-responsive">
	            	<table class="table table-bordered table-hover">
				  		<thead>
				  			<th class="text-center">ID</th>
				  			<th class="text-center">Producto</th>
				  			<th class="text-center">Categoría</th>
				  			<th class="text-center">Marca</th>
				  			<th class="text-center">Presentación</th>
				  			<th class="text-center">Cantidad</th>
				  			<th class="text-center">Precio Venta</th>
				  			<th class="text-cente">Eliminar</th>
				  		</thead>
				  		<tbody id="tbody-products">
				  			
				  		</tbody>
				  	</table>
				</div>
			</div>
		</div>
	</form>
</div>