$(document).ready(function() {
  //***brands***
  
  var num = 0;
  var openedModalCount = 0;

  showModal('modal-brand-create', 'form-brand-create', [{input: 'text', name: 'name'}, {input: 'checkbox', name: 'state'}]);

  hiddenModal('modal-brand-create', 'modal-brand-edit');

  //create
  storeR('form-brand-create', num, false);
  //update
  showModalEdit('brand-edit', 'form-brand-edit', 'modal-brand-edit', [{input: 'text', name: 'name'}, {input: 'checkbox', name: 'state'}]);
  updateR('form-brand-edit', num, false);

  //delete
  showModalDelete('brand-delete', 'form-brand-delete', 'modal-brand-delete');
  destroyR('form-brand-delete');

  $("#modal-brand-edit").on("show.bs.modal", function () {
  });

  //***DataTable***

  columnsExport = [
    {column: 'id'},
    {column: 'name'},
    {column: 'state', condition: [1, 'Activo', 'Inactivo']}
  ];

  overwriteExport('brands', columnsExport);

  var columnDefs = [
       { className: "text-center", "targets": [2] },
       { className: "text-center", "targets": [3], orderable: false }
    ];

  var columns = [
    {data: 'id'},
    {data: 'name'},
    {data: 'state', visible: true, render: function ( data, type, full, meta ) {
        return data == 1 ? "<span class='badge alert-success'>Activo</span>" : "<span class='badge alert-danger'>Inactivo</span>";
      }
    },
    {data: 'action', visible: true, render: function ( data, type, full, meta ) {
        var url = data.split(',');
        return '<button class="btn btn-md btn-primary" title="Editar" id="brand-edit" data-url-edit="'+url[0]+'" data-url-update="'+url[1]+'"><i class="fa fa-edit"></i></button> <button class="btn btn-md btn-danger" title="Eliminar" id="brand-delete" data-url="'+url[2]+'"><i class="fa fa-ban"></i></button>';
      }
    }
  ];

  dataTableServerSide('brands', 'lista-marcas', 'Lista de marcas', columnDefs, 'portrait', 'A4', 8, true, [ [0, 'desc'] ], true, columns, true);

  overwriteButtons();

});