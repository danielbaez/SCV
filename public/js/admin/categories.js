$(document).ready(function() {
  //***categories***
  
  var num = 0;
  var openedModalCount = 0;

  showModal('modal-category-create', 'form-category-create', [{input: 'text', name: 'name'}, {input: 'checkbox', name: 'state'}]);

  hiddenModal('modal-category-create', 'modal-category-edit');

  //create
  storeR('form-category-create', num, false);
  //update
  showModalEdit('category-edit', 'form-category-edit', 'modal-category-edit', [{input: 'text', name: 'name'}, {input: 'checkbox', name: 'state'}]);
  updateR('form-category-edit', num, false);

  //delete
  showModalDelete('category-delete', 'form-category-delete', 'modal-category-delete');
  destroyR('form-category-delete');

  $("#modal-category-edit").on("show.bs.modal", function () {
  });

  //***DataTable***

  columnsExport = [
    {column: 'id'},
    {column: 'name'},
    {column: 'state', condition: [1, 'Activo', 'Inactivo']}
  ];

  overwriteExport('categories', columnsExport);

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
        return '<button class="btn btn-md btn-primary" title="Editar" id="category-edit" data-url-edit="'+url[0]+'" data-url-update="'+url[1]+'"><i class="fa fa-edit"></i></button> <button class="btn btn-md btn-danger" title="Eliminar" id="category-delete" data-url="'+url[2]+'"><i class="fa fa-ban"></i></button>';
      }
    }
  ];

  dataTableServerSide('categories', 'lista-categorias', 'Lista de categorías', columnDefs, 'portrait', 'A4', 8, true, [ [0, 'desc'] ], true, columns, true);

  overwriteButtons();

});