$(document).ready(function() {
  //***purchases***
  
  var num = 0;
  var openedModalCount = 0;

  showModal('modal-purchase-create', 'form-purchase-create', [{input: 'text', name: 'business_name'}, {input: 'text', name: 'name'}, {input: 'text', name: 'lastname'}, {input: 'text', name: 'document'}, {input: 'text', name: 'address'}, {input: 'text', name: 'phone'}, {input: 'checkbox', name: 'state'}]);

  hiddenModal('modal-purchase-create', 'modal-purchase-edit');

  //create
  storeR('form-purchase-create', num, false);
  //update
  showModalEdit('purchase-edit', 'form-purchase-edit', 'modal-purchase-edit', [{input: 'text', name: 'business_name'}, {input: 'text', name: 'name'}, {input: 'text', name: 'lastname'}, {input: 'text', name: 'document'}, {input: 'text', name: 'address'}, {input: 'text', name: 'phone'}, {input: 'checkbox', name: 'state'}]);
  updateR('form-purchase-edit', num, false);

  //delete
  showModalDelete('purchase-delete', 'form-purchase-delete', 'modal-purchase-delete');
  destroyR('form-purchase-delete');

  $("#modal-purchase-edit").on("show.bs.modal", function () {
  });

  //***DataTable***

  columnsExport = [
    {column: 'id'},
    {column: ['provider','business_name']},
    {column: 'voucher'},
    {column: 'voucher_serie'},
    {column: 'voucher_number'},
    {column: 'total'},
    {column: 'date'},
    {column: 'state', condition: [1, 'Activo', 'Inactivo']}
  ];

  overwriteExport('purchases', columnsExport);

  var columnDefs = [
       { className: "text-center", "targets": [0, 3, 4, 5, 6, 7] },
       { className: "text-center", "targets": [8], orderable: false }
    ];

  var columns = [
    {data: 'id'},
    {data: 'provider.business_name'},
    {data: 'voucher'},
    {data: 'voucher_serie'},
    {data: 'voucher_number'},
    {data: 'total'},
    {data: 'date'},
    {data: 'state', visible: true, render: function ( data, type, full, meta ) {
        return data == 1 ? "<span class='badge alert-success'>Activo</span>" : "<span class='badge alert-danger'>Inactivo</span>";
      }
    },
    {data: 'action', visible: true, render: function ( data, type, full, meta ) {
        var url = data.split(',');
        return '<button class="btn btn-md btn-primary" title="Editar" id="purchase-edit" data-url-edit="'+url[0]+'" data-url-update="'+url[1]+'"><i class="fa fa-edit"></i></button> <button class="btn btn-md btn-danger" title="Eliminar" id="purchase-delete" data-url="'+url[2]+'"><i class="fa fa-ban"></i></button>';
      }
    }
  ];

  dataTableServerSide('purchases', 'lista-compras', 'Lista de compras', columnDefs, 'landscape', 'A4', 8, true, [ [0, 'desc'] ], true, columns, true);

  overwriteButtons();


  $('#form-purchase-create').on('click', function() {
    $('#header-purchases-index').hide();
    $('#header-purchases-create').show();
    $('#div-purchase-index').hide();
    $('#div-purchase-create').show();
  });


  var optionsAutocompleteCompra = {

    url: function() {
      return $('#autocomplete-producto-compra').attr('data-url');
    },

    /*xmlElementName: 'name',
    xmlElementCode: 'id',*/

    getValue: function(element) {
      //return element.value;
      return element.name;
      //AE3EFE
    },

    ajaxSettings: {
      dataType: "json",
      method: "GET",
      data: {
        dataType: "json"
      },
      cache: false
    },

    preparePostData: function(data) {
      data.action = 'product-search';
      data.query = $("#autocomplete-producto-compra").val();
      return data;
    },

    list: {
      maxNumberOfElements: 10,

      /*match: {
      enabled: true
    }, */

      onClickEvent: function() {
        var value = $("#autocomplete-producto-compra").getSelectedItemData();
        console.log(value);
        addProductoInTableCompra('product-detail', value.id, '#autocomplete-producto-compra');
      } ,

      onKeyEnterEvent: function() {
        var value = $("#autocomplete-producto-compra").getSelectedItemData();
        console.log(value);
        addProductoInTableCompra('product-detail', value.id, '#autocomplete-producto-compra');
      } ,

      onHideListEvent: function(data){
        //console.log(data)
      }
    },

    //requestDelay: 500
  };

  $("#autocomplete-producto-compra").easyAutocomplete(optionsAutocompleteCompra);
  $('div.easy-autocomplete').removeAttr('style');

  function addProductoInTableCompra(action, id_producto, id) {
    $.ajax({
        data: {id_product: id_producto, action: action},
        type: "GET",
        dataType: "json",
        url: $(id).attr('data-url')
    })
    .done(function(data){
      $(id).val('').focus();
      console.log(data);
      var response = data[0];

      if(!$('tr[data-'+response.id+'="' + response.id + '"]').length){
        var html = '<tr data-'+response.id+'='+response.id+'>';
          html += '<td>'+response.id+'</td>';
          html += '<td>'+response.name+'</td>';
          html += '<td>'+response.category.name+'</td>';
          html += '<td>'+response.brand.name+'</td>';
          html += '<td>'+response.presentation.name+'</td>';
          html += '<td class="text-center"><input type="number" name="quantity" style="width: 35%; min-width: 60px;"></td>';
          html += '<td class="text-center">'+response.sale_price+'</td>';
          html += '<td class="text-center"><i style="color:red" class="product-delete fa fa-times fa-2x" aria-hidden="true"></i></td>';
        html += '</tr>';
        $('#tbody-products').append(html);
      }

      /*$('#autocomplete-producto').val('');
      if(!$('tr[data-'+response.id+'="' + response.id + '"]').length){     
        var totall = $('#div-importe-final').html();        
        totall = parseFloat(totall) + parseFloat(response.precio_compra);
        $('#div-importe-final').html(totall.toFixed(2));
        $('input[name="total"]').val(totall);

        var id_perfil = $('.span-id-perfil').html();

        if(parseInt(id_perfil) == 1){
        
          var html = '<tr data-'+response.id+'='+response.id+'><td style="text-align:center"><i style="color:red" class="delete-product fa fa-times fa-2x" aria-hidden="true"></i></td><td>'+response.categoria+' | '+response.marca+' | '+response.nombre+'</td><td style="text-align:center"><input type="hidden" name="id_producto[]" value='+response.id+'>'; 
          html +='<input style="margin: 0 auto;" type="number" value="1" name="cantidad[]" class="form-control cantidad-'+response.id+'" data-id="'+response.id+'" id="calcular-importe" min="1"></td>';
          html += '<td><div class="inner-addon left-addon"><span class="text">S/</span><input class="form-control precio-compra-'+response.id+'" style="margin: 0 auto;" type="text" name="precio_compra[]" value="'+response.precio_compra+'" id="calcular-importe-2" data-id="'+response.id+'"></div></td>';

          html += '<td style="text-align:right" id="importe-'+response.id+'">'+response.precio_compra+'</td></tr>';
          $('#tbody-producto-compra').append(html);

        }else{
          var html = '<tr data-'+response.id+'='+response.id+'><td style="text-align:center"><i style="color:red" class="delete-product fa fa-times fa-2x" aria-hidden="true"></i></td><td>'+response.categoria+' | '+response.marca+' | '+response.nombre+'</td><td style="text-align:center"><input type="hidden" name="id_producto[]" value='+response.id+'>'; 
          html +='<input style="margin: 0 auto;" type="number" value="1" name="cantidad[]" class="form-control cantidad-'+response.id+'" data-id="'+response.id+'" id="calcular-importe" min="1"></td>';
          html += '<td><div style="display:none" class="inner-addon left-addon"><span class="text">S/</span><input class="form-control precio-compra-'+response.id+'" style="margin: 0 auto;" type="text" name="precio_compra[]" value="'+response.precio_compra+'" id="calcular-importe-2" data-id="'+response.id+'"></div></td>';

          html += '<td style="text-align:right; display:none" id="importe-'+response.id+'">'+response.precio_compra+'</td></tr>';
          $('#tbody-producto-compra').append(html);
        }          
        calcularImp();
      }*/
    });
  }

  $("body").on("click", ".product-delete", function () {
    $(this).parent().parent().remove();
    /*var importe = $(this).parent().parent().find("td[id^='importe-']").html();
    var total = $('#div-importe-final').html();
    total = total - importe;
    $('#div-importe-final').html(total.toFixed(2));
    $('input[name="total"]').val(total.toFixed(2));
    $(this).parent().parent().remove();
    calcularImp();
    if($("input[name='monto_recibido']").val() != ''){
      var t = $("input[name='monto_recibido']");
      t.trigger('keyup');
    }*/
  });

});