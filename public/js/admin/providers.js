$(document).ready(function() {
  //***providers***
  
  var num = 0;
  var openedModalCount = 0;

  showModal('modal-provider-create', 'form-provider-create', [{input: 'text', name: 'business_name'}, {input: 'text', name: 'name'}, {input: 'text', name: 'lastname'}, {input: 'text', name: 'document'}, {input: 'text', name: 'address'}, {input: 'text', name: 'phone'}, {input: 'checkbox', name: 'state'}]);

  hiddenModal('modal-provider-create', 'modal-provider-edit');

  //create
  storeR('form-provider-create', num, false);
  //update
  showModalEdit('provider-edit', 'form-provider-edit', 'modal-provider-edit', [{input: 'text', name: 'business_name'}, {input: 'text', name: 'name'}, {input: 'text', name: 'lastname'}, {input: 'text', name: 'document'}, {input: 'text', name: 'address'}, {input: 'text', name: 'phone'}, {input: 'checkbox', name: 'state'}]);
  updateR('form-provider-edit', num, false);

  //delete
  showModalDelete('provider-delete', 'form-provider-delete', 'modal-provider-delete');
  destroyR('form-provider-delete');

  $("#modal-provider-edit").on("show.bs.modal", function () {
  });

  //***DataTable***

  columnsExport = [
    {column: 'id'},
    {column: 'business_name'},
    {column: 'name'},
    {column: 'lastname'},
    {column: 'document'},
    {column: 'address'},
    {column: 'phone'},
    {column: 'state', condition: [1, 'Activo', 'Inactivo']}
  ];

  overwriteExport('providers', columnsExport);

  var columnDefs = [
       { className: "text-center", "targets": [0, 4, 6, 7] },
       { className: "text-center", "targets": [8], orderable: false }
    ];

  var columns = [
    {data: 'id'},
    {data: 'business_name'},
    {data: 'name'},
    {data: 'lastname'},
    {data: 'document'},
    {data: 'address'},
    {data: 'phone'},
    {data: 'state', visible: true, render: function ( data, type, full, meta ) {
        return data == 1 ? "<span class='badge alert-success'>Activo</span>" : "<span class='badge alert-danger'>Inactivo</span>";
      }
    },
    {data: 'action', visible: true, render: function ( data, type, full, meta ) {
        var url = data.split(',');
        return '<button class="btn btn-md btn-primary" title="Editar" id="provider-edit" data-url-edit="'+url[0]+'" data-url-update="'+url[1]+'"><i class="fa fa-edit"></i></button> <button class="btn btn-md btn-danger" title="Eliminar" id="provider-delete" data-url="'+url[2]+'"><i class="fa fa-ban"></i></button>';
      }
    }
  ];

  dataTableServerSide('providers', 'lista-proveedores', 'Lista de proveedores', columnDefs, 'landscape', 'A4', 8, true, [ [0, 'desc'] ], true, columns, true);

  overwriteButtons();

});