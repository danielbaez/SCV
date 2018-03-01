$(document).ready(function() {
  //***products***
  
  var num = 0;
  var openedModalCount = 0;

  showModal('modal-product-create', 'form-product-create', [{input: 'text', name: 'category_id'}, {input: 'text', name: 'brand_id'}, {input: 'text', name: 'presentation_id'}, {input: 'text', name: 'name'}, {input: 'text', name: 'minimum_stock'}, {input: 'text', name: 'stock'}, {input: 'text', name: 'purchase_price'}, {input: 'text', name: 'sale_price'}, {input: 'text', name: 'barcode'}, {input: 'checkbox', name: 'state'}]);

  hiddenModal('modal-product-create', 'modal-product-edit');

  //create
  storeR('form-product-create', num, false);
  //update
  showModalEdit('product-edit', 'form-product-edit', 'modal-product-edit', [{input: 'text', name: 'category_id'}, {input: 'text', name: 'brand_id'}, {input: 'text', name: 'presentation_id'}, {input: 'text', name: 'name'}, {input: 'text', name: 'minimum_stock'}, {input: 'text', name: 'stock'}, {input: 'text', name: 'purchase_price'}, {input: 'text', name: 'sale_price'}, {input: 'text', name: 'barcode'}, {input: 'checkbox', name: 'state'}]);
  updateR('form-product-edit', num, false);

  //delete
  showModalDelete('product-delete', 'form-product-delete', 'modal-product-delete');
  destroyR('form-product-delete');

  $("#modal-product-edit").on("show.bs.modal", function () {
  });

  //***DataTable***

  columnsExport = [
    {column: 'id'},
    {column: 'name'},
    {column: ['category', 'name']},
    {column: ['brand', 'name']},
    {column: ['presentation', 'name']},
    {column: 'minimum_stock'},
    {column: 'stock'},
    {column: 'purchase_price'},
    {column: 'sale_price'},
    {column: 'state', condition: [1, 'Activo', 'Inactivo']}
  ];

  overwriteExport('products', columnsExport);

  var columnDefs = [
       { className: "text-center", "targets": [0, 5, 6, 7] },
       { className: "text-center", "targets": [10], orderable: false }
    ];

  var columns = [
    {data: 'id'},
    {data: 'name'},
    {data: 'category.name'},
    {data: 'brand.name'},
    {data: 'presentation.name'},
    {data: 'minimum_stock'},
    {data: 'stock'},
    {data: 'purchase_price'},
    {data: 'sale_price'},
    {data: 'state', visible: true, render: function ( data, type, full, meta ) {
        return data == 1 ? "<span class='badge alert-success'>Activo</span>" : "<span class='badge alert-danger'>Inactivo</span>";
      }
    },
    {data: 'action', visible: true, render: function ( data, type, full, meta ) {
        var url = data.split(',');
        return '<button class="btn btn-md btn-primary" title="Editar" id="product-edit" data-url-edit="'+url[0]+'" data-url-update="'+url[1]+'"><i class="fa fa-edit"></i></button> <button class="btn btn-md btn-danger" title="Eliminar" id="product-delete" data-url="'+url[2]+'"><i class="fa fa-ban"></i></button>';
      }
    }
  ];

  dataTableServerSide('products', 'lista-productos', 'Lista de productos', columnDefs, 'landscape', 'A4', 8, true, [ [0, 'desc'] ], true, columns, true);

  overwriteButtons();

});