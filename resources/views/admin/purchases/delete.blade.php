<div class="modal modal-danger fade" id="modal-purchase-delete">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header modal-header-form">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  	<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Anular Compra</h4>
			</div>
			<form method="POST" action="" id="form-purchase-delete">
				{{ method_field('DELETE') }}
				<div class="modal-body">
					<div class="row">				            
		              	<div class="col-xs-12">
		              		¿Está seguro que quiere anular esta compra?
		              	</div>			            
					</div>
				</div>
				<div class="modal-footer modal-footer-form">
					<button type="button" class="btn btn-outline" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-outline">Aceptar</button>
				</div>
			</form>
		</div>
	</div>
</div>