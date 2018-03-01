$(document).ready(function() {
  //***customers***
  
  var num = 0;
  var openedModalCount = 0;

  showModal('modal-customer-create', 'form-customer-create', [{input: 'text', name: 'name'}, {input: 'text', name: 'lastname'}, {input: 'text', name: 'document'}, {input: 'text', name: 'address'}, {input: 'text', name: 'phone'}, {input: 'checkbox', name: 'state'}]);

  hiddenModal('modal-customer-create', 'modal-customer-edit');

  //create
  storeR('form-customer-create', num, false);
  //update
  showModalEdit('customer-edit', 'form-customer-edit', 'modal-customer-edit', [{input: 'text', name: 'name'}, {input: 'text', name: 'lastname'}, {input: 'text', name: 'document'}, {input: 'text', name: 'address'}, {input: 'text', name: 'phone'}, {input: 'checkbox', name: 'state'}]);
  updateR('form-customer-edit', num, false);

  //delete
  showModalDelete('customer-delete', 'form-customer-delete', 'modal-customer-delete');
  destroyR('form-customer-delete');

  $("#modal-customer-edit").on("show.bs.modal", function () {
  });

  //***DataTable***

  columnsExport = [
    {column: 'id'},
    {column: 'name'},
    {column: 'lastname'},
    {column: 'document'},
    {column: 'address'},
    {column: 'phone'},
    {column: 'state', condition: [1, 'Activo', 'Inactivo']}
  ];

  overwriteExport('customers', columnsExport);

  var columnDefs = [
       { className: "text-center", "targets": [0, 3, 5, 6] },
       { className: "text-center", "targets": [7], orderable: false }
    ];

  var columns = [
    {data: 'id'},
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
        return '<button class="btn btn-md btn-primary" title="Editar" id="customer-edit" data-url-edit="'+url[0]+'" data-url-update="'+url[1]+'"><i class="fa fa-edit"></i></button> <button class="btn btn-md btn-danger" title="Eliminar" id="customer-delete" data-url="'+url[2]+'"><i class="fa fa-ban"></i></button>';
      }
    }
  ];

  dataTableServerSide('customers', 'lista-clientes', 'Lista de clientes', columnDefs, 'landscape', 'A4', 8, true, [ [0, 'desc'] ], true, columns, true);

  overwriteButtons();

});