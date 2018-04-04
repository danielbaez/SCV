$(document).ready(function() {
  //***roles***
  
  var num = 0;
  var openedModalCount = 0;

  showModal('modal-rol-create', 'form-rol-create', [{input: 'text', name: 'name'}, {input: 'checkbox', name: 'state'}]);

  hiddenModal('modal-rol-create', 'modal-rol-edit');

  //***DataTable***
  dataTableSimple('roles', 'reporte-roles', 'Lista de roles', [3], [], [0, 1, 2], 'portrait', 'A4', 8, true, [[0, 'desc']], true, true);

  //create
  storeR('form-rol-create', num, false);
  //update
  showModalEdit('rol-edit', 'form-rol-edit', 'modal-rol-edit', [{input: 'text', name: 'name'}, {input: 'checkbox', name: 'state'}]);
  updateR('form-rol-edit', num, false);
  //delete
  showModalDelete('rol-delete', 'form-rol-delete', 'modal-rol-delete');
  destroyR('form-rol-delete');

});