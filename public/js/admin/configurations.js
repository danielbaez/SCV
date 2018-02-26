$(document).ready(function() {
  //***configurations***
  
  var num = 0;
  var openedModalCount = 0;

  hiddenModal('modal-configuration-create', 'modal-configuration-edit');

  //***DataTable***
  dataTableSimple('configurations', 'configuracion', 'Configuración', [5, 6], [0, 1, 2, 3, 4], 'portrait', 'A4', 8, false);

  //update
  showModalEdit('configuration-edit', 'form-configuration-edit', 'modal-configuration-edit', [{input: 'text', name: 'company'}, {input: 'text', name: 'document'}, {input: 'text', name: 'address'}, {input: 'text', name: 'phone'}]);
  updateR('form-configuration-edit', num, true);

});