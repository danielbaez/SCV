$(document).ready(function() {
  //***vouchers***
  
  var num = 0;
  var openedModalCount = 0;

  showModal('modal-voucher-create', 'form-voucher-create', [{input: 'text', name: 'name'}, {input: 'text', name: 'serie'}, {input: 'text', name: 'from'}, {input: 'text', name: 'to'}, {input: 'checkbox', name: 'state'}]);

  hiddenModal('modal-voucher-create', 'modal-voucher-edit');

  //***DataTable***
  dataTableSimple('vouchers', 'reporte-comprobantes', 'Lista de comprobantes', [6], [0, 1, 2, 3, 4, 5], 'portrait', 'A4', 8, true, [[0, 'desc']], true);

  //create
  storeR('form-voucher-create', num, false);
  //update
  showModalEdit('voucher-edit', 'form-voucher-edit', 'modal-voucher-edit', [{input: 'text', name: 'name'}, {input: 'text', name: 'serie'}, {input: 'text', name: 'from'}, {input: 'text', name: 'to'}, {input: 'checkbox', name: 'state'}]);
  updateR('form-voucher-edit', num, false);
  //delete
  showModalDelete('voucher-delete', 'form-voucher-delete', 'modal-voucher-delete');
  destroyR('form-voucher-delete');

});