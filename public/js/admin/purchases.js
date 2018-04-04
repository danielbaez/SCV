$(document).ready(function() {
  //***purchases***
  
  var num = 0;
  var openedModalCount = 0;

  //delete
  showModalDelete('purchase-delete', 'form-purchase-delete', 'modal-purchase-delete');
  destroyR('form-purchase-delete');

  //***DataTable***

  columnsExport = [
    {column: 'id'},
    {column: ['provider','business_name']},
    {column: 'voucher'},
    {column: 'voucher_serie'},
    {column: 'voucher_number'},
    {column: 'total'},
    {column: 'date'},
    {column: 'state', condition: [1, 'Aceptado', 'Anulado']}
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
        return data == 1 ? "<span class='badge alert-success'>Aceptado</span>" : "<span class='badge alert-danger'>Anulado</span>";
      }
    },
    {data: 'action', visible: true, render: function ( data, type, full, meta ) {
        var url = data.split(',');
        if(full.state == 1) {
          return '<button class="btn btn-md btn-primary" title="Editar" id="purchase-detail" data-url="'+url[0]+'"><i class="fa fa-eye"></i></button> <button class="btn btn-md btn-danger" title="Eliminar" id="purchase-delete" data-url="'+url[1]+'"><i class="fa fa-ban"></i></button>';  
        }else {
          return '<button class="btn btn-md btn-primary" title="Detalle" id="purchase-detail" data-url="'+url[0]+'"><i class="fa fa-eye"></i></button>';
        }
        
      }
    }
  ];

  dataTableServerSide('purchases', 'lista-compras', 'Lista de compras', columnDefs, 'landscape', 'A4', 8, true, [ [0, 'desc'] ], true, columns, true);

  overwriteButtons();


  /*$('#form-purchase-create').on('click', function() {
    $('#header-purchases-index').hide();
    $('#header-purchases-create').show();
    $('#div-purchase-index').hide();
    $('#div-purchase-create').show();
  });*/

  var id = '#autocomplete-product-purchase';
  var search = $(id);

  var options = {

    url: function() {
      return search.attr('data-url');
    },

    getValue: function(element) {
      return element.category.name+' | '+element.brand.name+' | '+element.presentation.name+' | '+element.name;
    },

    ajaxSettings: {
      dataType: "json",
      method: "GET",
      data: {
        //dataType: "json"
      },
      cache: false
    },

    preparePostData: function(data) {
      data.action = 'product-search';
      data.query = search.val();
      return data;
    },

    list: {
      maxNumberOfElements: 10,

      /*match: {
      enabled: true
    }, */

      onClickEvent: function() {
        var value = search.getSelectedItemData();
        console.log(value);
        addProduct('product-detail', value.id, id);
      } ,

      onKeyEnterEvent: function() {
        var value = search.getSelectedItemData();
        console.log(value);
        addProduct('product-detail', value.id, id);
      } ,

      onHideListEvent: function(data){
        //console.log(data)
      }
    },

    //requestDelay: 500
  };

  search.easyAutocomplete(options);
  $('div.easy-autocomplete').removeAttr('style');

  function addProduct(action, id_producto, id) {
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
        var html = '<tr data-id='+response.id+' data-'+response.id+'='+response.id+'>';
          html += '<td class="text-center">'+response.id+'</td>';
          html += '<td class="text-center">'+response.name+'</td>';
          html += '<td class="text-center">'+response.category.name+'</td>';
          html += '<td class="text-center">'+response.brand.name+'</td>';
          html += '<td class="text-center">'+response.presentation.name+'</td>';
          html += '<input type="hidden" name="product_id[]" value="'+response.id+'">';
          html += '<td class="text-center" id="quantity-'+response.id+'"><input type="text" class="form-control allownumericwithoutdecimal" name="quantity[]" value="1" style="width: 30%; min-width: 60px; margin: auto"></td>';
          html += '<td class="text-center" id="purchase_price-'+response.id+'"><input type="text" class="form-control allownumericwithdecimal" name="purchase_price[]" value="'+response.purchase_price+'" style="width: 40%; min-width: 60px; margin: auto"></td>';
          html += '<td class="text-center" id="amount-'+response.id+'">'+(response.purchase_price)+'</td>';
          html += '<td class="text-center"><i style="color:red" class="product-delete fa fa-times fa-2x" aria-hidden="true"></i></td>';
        html += '</tr>';
        $('#tbody-products').append(html);
        addPrice(response.purchase_price);
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

  function addPrice(price) {
    $('.div-save-purchase').show();
    var price = parseFloat(price);
    var total = $('#total').html();
    total = parseFloat(total);
    var f = (total+price).toFixed(2);
    $('#total').html(f);
  }

  function removePrice(price) {
    var price = parseFloat(price);
    var total = $('#total').html();
    total = parseFloat(total);
    var f = (total-price).toFixed(2);
    $('#total').html(f);

    if($('#tbody-products tr').length == 0) {
      $('.div-save-purchase').hide();
    }

  }

  $('body').on("keyup", '.allownumericwithdecimal', function (event) {
    $(this).val($(this).val().replace(/[^0-9\.]/g,''));
    if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }

    var total = 0;
    $("td[id^='purchase_price-']").each(function() {
      var quantity = $(this).parent().find("td input[name^='quantity']").val();
      var purchase_price = parseFloat($(this).find('input[name^="purchase_price"]').val());
      total += quantity*purchase_price;
    });
    $('#total').html(total.toFixed(2));

    var id = $(this).parent().parent().data('id');
    var q = $('#quantity-'+id).find("input[name^='quantity']").val();
    var p = $('#purchase_price-'+id).find('input[name^="purchase_price"]').val();
    $('#amount-'+id).html((q*p).toFixed(2));
  });

  $('body').on("keyup", '.allownumericwithoutdecimal', function (event) {    
    $(this).val($(this).val().replace(/[^\d].+/, ""));
    if ((event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }

    if($(this).val() === '0') {
      $(this).val(1)
    }

    var total = 0;
    $("td[id^='purchase_price-']").each(function() {
      var quantity = $(this).parent().find("td input[name^='quantity']").val();
      var purchase_price = parseFloat($(this).find('input[name^="purchase_price"]').val());
      total += quantity*purchase_price;
    });
    $('#total').html(total.toFixed(2));

    var id = $(this).parent().parent().data('id');
    var q = $('#quantity-'+id).find("input[name^='quantity']").val();
    var p = $('#purchase_price-'+id).find('input[name^="purchase_price"]').val();
    $('#amount-'+id).html((q*p).toFixed(2));
  });

  $("body").on("click", ".product-delete", function () {    
    var purchase_price = $(this).parent().parent().find("td[id^='purchase_price-']").find('input[name^="purchase_price"]').val();
    var quantity = $(this).parent().parent().find("td[id^='quantity-']").find('input[name^="quantity"]').val();
    $(this).parent().parent().remove();
    removePrice(purchase_price*quantity);
  });

  $(document).on("keypress", "form", function(event) { 
    return event.keyCode != 13;
  });

  $("#form-purchase-store").submit(function(e){
    e.preventDefault(e);

    var $this = $(this);
    $this.find(":submit").prop('disabled', true);

    var obj = {
       type: 'POST',
       url: $this.attr('action'),
       success: function(data){
        console.log(data)
        if(data.state) {
          window.location = data.url;
        }
       },
       error: function (request, status, error) {
        $this.find(":submit").prop('disabled', false);
        if('errors' in request.responseJSON) {
          num++;
          var errors = request.responseJSON.errors;
          
          $.each(errors, function(key, value) {
            $this.find('#'+key).parent('div').removeClass('num-'+(num-1));
            $this.find('#'+key).parent('div').addClass('has-error num-'+num);
            if($this.find('#'+key).next().is('span.help-block')) {
                $this.find('#'+key).next().find('strong').html(value);
            }
            else {
              $this.find('#'+key).after('<span class="help-block"><strong>'+value+'</strong></span>')
            }
          });

          $('.has-error.num-'+(num-1)).each(function(i, obj) {
              $(obj).removeClass('num-'+(num-1));
              $(obj).removeClass('has-error');
              $(obj).find('span').remove();
          });
        }
      }
    };

    obj.data = $(this).serialize();
    $.ajax(obj);
  });

  $("body").on("click", "#purchase-detail", function () {
    var url = $(this).data('url');
    $.ajax({
       type: 'GET',
       url: url,
       data: {},
       success: function(data) {
        console.log(data)
        var response = data[0];
        var detail = response.purchase_detail;
        var html_detail;
        for(var i=0; i<detail.length; i++) {
          html_detail += '<tr>';
            html_detail += '<td class="text-center">'+detail[i].product_id+'</td>';
            html_detail += '<td class="text-center">'+detail[i].product.name+'</td>';
            html_detail += '<td class="text-center">'+detail[i].product.category.name+'</td>';
            html_detail += '<td class="text-center">'+detail[i].product.brand.name+'</td>';
            html_detail += '<td class="text-center">'+detail[i].product.presentation.name+'</td>';
            html_detail += '<td class="text-center">'+detail[i].quantity+'</td>';
            html_detail += '<td class="text-center">'+response.currency+detail[i].price+'</td>';
            html_detail += '<td class="text-center">'+response.currency+(detail[i].quantity*detail[i].price)+'</td>';
          html_detail += '</tr>';
        }
        html_detail += '<tr>';
          html_detail += '<td colspan="6"></td>';
          html_detail += '<td style="font-weight:bold" class="text-center">Total:</td>';
          html_detail += '<td class="text-center">'+response.currency+response.total+'</td>';
        html_detail += '</tr>';

        var html_provider;
        html_provider += '<tr>';
          html_provider += '<td class="text-center">'+response.provider_id+'</td>';
          html_provider += '<td class="text-center">'+response.provider.business_name+'</td>';
          html_provider += '<td class="text-center">'+response.provider.document+'</td>';
          html_provider += '<td class="text-center">'+response.provider.address+'</td>';
          html_provider += '<td class="text-center">'+response.provider.phone+'</td>';
        html_provider += '</tr>';
        
        $('#tbody-purchase-provider').html(html_provider);
        $('#tbody-purchase-detail').html(html_detail);
        $('#modal-purchase-detail').modal('show');
       }
     });
  });

  $('body').on("keypress", '#search-barcode', function (event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    var $this = $(this);
    var id = '#search-barcode';
    if(keycode == '13' && $this.val() != ''){
      $.ajax({
        data: {query: $this.val(), action: 'barcode'},
        type: "GET",
        dataType: "json",
        url: $(id).attr('data-url')
      })
      .done(function(data){
        if(data.length) {
          addProduct('product-detail', data[0].id, id);
        }else {
          $this.val('').focus();
        }
      });
    }
  });

  $('#date').datepicker({
    format:'dd/mm/yyyy',
    autoclose: true
  }).datepicker("setDate",'now');

});