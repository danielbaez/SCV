$(document).ready(function() {
  //***configurations***
  
  var num = 0;
  var openedModalCount = 0;

  hiddenModal('modal-configuration-create', 'modal-configuration-edit');

  //***DataTable***
  dataTableSimple('configurations', 'configuracion', 'Configuración', [0, 1, 2, 3, 4, 5, 6, 7, 8], [], [0, 1, 2, 3, 4, 5, 6], 'landscape', 'A4', 8, false, false, false, true);

  //update
  showModalEdit('configuration-edit', 'form-configuration-edit', 'modal-configuration-edit', [{input: 'text', name: 'company'}, {input: 'text', name: 'document'}, {input: 'text', name: 'address'}, {input: 'text', name: 'phone'}, {input: 'text', name: 'tax'}, {input: 'text', name: 'tax_percentage'}, {input: 'text', name: 'currency'}]);
  updateR('form-configuration-edit', num, true);

});