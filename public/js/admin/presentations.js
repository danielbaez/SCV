$(document).ready(function() {
  //***presentations***
  
  var num = 0;
  var openedModalCount = 0;

  showModal('modal-presentation-create', 'form-presentation-create', [{input: 'text', name: 'name'}, {input: 'checkbox', name: 'state'}]);

  hiddenModal('modal-presentation-create', 'modal-presentation-edit');

  //create
  storeR('form-presentation-create', num, false);
  //update
  showModalEdit('presentation-edit', 'form-presentation-edit', 'modal-presentation-edit', [{input: 'text', name: 'name'}, {input: 'checkbox', name: 'state'}]);
  updateR('form-presentation-edit', num, false);

  //delete
  showModalDelete('presentation-delete', 'form-presentation-delete', 'modal-presentation-delete');
  destroyR('form-presentation-delete');

  $("#modal-presentation-edit").on("show.bs.modal", function () {
  });

  //***DataTable***

  columnsExport = [
    {column: 'id'},
    {column: 'name'},
    {column: 'state', condition: [1, 'Activo', 'Inactivo']}
  ];

  overwriteExport('presentations', columnsExport);

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
        return '<button class="btn btn-md btn-primary" title="Editar" id="presentation-edit" data-url-edit="'+url[0]+'" data-url-update="'+url[1]+'"><i class="fa fa-edit"></i></button> <button class="btn btn-md btn-danger" title="Eliminar" id="presentation-delete" data-url="'+url[2]+'"><i class="fa fa-ban"></i></button>';
      }
    }
  ];

  dataTableServerSide('presentations', 'lista-presentaciones', 'Lista de presentaciones', columnDefs, 'portrait', 'A4', 8, true, [ [0, 'desc'] ], true, columns, true);

  overwriteButtons();

});