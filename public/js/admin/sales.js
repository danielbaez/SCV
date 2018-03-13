$(document).ready(function() {
  //***sales***
  
  var num = 0;
  var openedModalCount = 0;

  //delete
  showModalDelete('sale-delete', 'form-sale-delete', 'modal-sale-delete');
  destroyR('form-sale-delete');

  //***DataTable***

  columnsExport = [
    {column: 'id'},
    {column: ['customer','name'], join: ['customer','lastname']},
    {column: 'voucher'},
    {column: 'voucher_serie'},
    {column: 'voucher_number'},
    {column: 'total'},
    {column: 'date'},
    {column: 'state', condition: [1, 'Aceptado', 'Anulado']}
  ];

  overwriteExport('sales', columnsExport);

  var columnDefs = [
       { className: "text-center", "targets": [0, 3, 4, 5, 6, 7] },
       { className: "text-center", "targets": [8], orderable: false }
    ];

  var columns = [
    {data: 'id'},
    {data: 'customer.name', visible: true, render: function ( data, type, full, meta ) {
        return full.customer.name+' '+full.customer.lastname;
      }
    },
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
          return '<button class="btn btn-md btn-primary" title="Editar" id="sale-detail" data-url="'+url[0]+'"><i class="fa fa-eye"></i></button> <button class="btn btn-md btn-danger" title="Eliminar" id="sale-delete" data-url="'+url[1]+'"><i class="fa fa-ban"></i></button>';  
        }else {
          return '<button class="btn btn-md btn-primary" title="Detalle" id="sale-detail" data-url="'+url[0]+'"><i class="fa fa-eye"></i></button>';
        }
        
      }
    }
  ];

  dataTableServerSide('sales', 'lista-ventas', 'Lista de ventas', columnDefs, 'landscape', 'A4', 8, true, [ [0, 'desc'] ], true, columns, true);

  overwriteButtons();


  /*$('#form-sale-create').on('click', function() {
    $('#header-sales-index').hide();
    $('#header-sales-create').show();
    $('#div-sale-index').hide();
    $('#div-sale-create').show();
  });*/

  var customer_autocomplete = $('.customer-autocomplete');

  $('.customer-autocomplete').select2({
    ajax: {
      url: customer_autocomplete.data('url'),
      dataType: 'json',
      cache: false,
      delay: 500,
      data: function (params) {
        var query = {
          query: params.term,
          action: 'customer-search'
        }

        // Query parameters will be ?search=[term]&type=public
        return query;
      },
      processResults: function (data) {
        // Tranforms the top-level key of the response object from 'items' to 'results'
        return {
          results: data.items
        };
      },
    },
    "language": {
      "noResults": function(){
        return "No se encuentra datos";
      }
    }
  });

  var id = '#autocomplete-product-sale';
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
          html += '<td class="text-center" id="stock-'+response.id+'">'+response.stock+'</td>';
          html += '<td class="text-center" id="quantity-'+response.id+'"><input type="text" class="form-control allownumericwithoutdecimal" name="quantity[]" value="1" style="width: 30%; min-width: 60px; margin: auto"></td>';
          html += '<td class="text-center" id="sale_price-'+response.id+'">'+response.sale_price+'</td>';
          
          html += '<input type="hidden" class="form-control" name="sale_price[]" value="'+response.sale_price+'" style="width: 40%; min-width: 60px; margin: auto"></td>';

          html += '<td class="text-center" id="amount-'+response.id+'">'+(response.sale_price)+'</td>';
          html += '<td class="text-center"><i style="color:red" class="product-delete fa fa-times fa-2x" aria-hidden="true"></i></td>';
        html += '</tr>';
        $('#tbody-products').append(html);
        addPrice(response.sale_price);
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
    $('.div-save-sale').show();
    var price = parseFloat(price);
    var total = $('#total').html();
    total = parseFloat(total);
    var f = (total+price).toFixed(2);
    $('#total').html(f);

    var imp = parseFloat($('#percentage').data('percentage'));
    //var subtotal = f - (f*imp/100);
    var subtotal = f/(1+(imp/100));
    //var impuesto_v = f*imp/100;
    var impuesto_v = f - subtotal;
    $('#subtotal').html(subtotal.toFixed(2));
    $('#percentage').html(impuesto_v.toFixed(2));
  }

  function removePrice(price) {
    var price = parseFloat(price);
    var total = $('#total').html();
    total = parseFloat(total);
    var f = (total-price).toFixed(2);
    $('#total').html(f);

    var imp = parseFloat($('#percentage').data('percentage'));
    //var subtotal = f - (f*imp/100);
    var subtotal = f/(1+(imp/100));
    //var impuesto_v = f*imp/100;
    var impuesto_v = f - subtotal;
    $('#subtotal').html(subtotal.toFixed(2));
    $('#percentage').html(impuesto_v.toFixed(2));

    if($('#tbody-products tr').length == 0) {
      $('.div-save-sale').hide();
    }

  }

  $('body').on("keyup", '.allownumericwithdecimal', function (event) {
    $(this).val($(this).val().replace(/[^0-9\.]/g,''));
    if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }

    var total = 0;
    $("td[id^='sale_price-']").each(function() {
      var quantity = $(this).parent().find("td input[name^='quantity']").val();
      var sale_price = parseFloat($(this).html());
      total += quantity*sale_price;
    });
    $('#total').html(total.toFixed(2));
  });

  $('body').on("keyup", '.allownumericwithoutdecimal', function (event) {    
    $(this).val($(this).val().replace(/[^\d].+/, ""));
    if ((event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }

    var id = $(this).parent().parent().data('id');

    if($(this).val() === '0') {
      $(this).val(1)
    }

    
    if(parseInt($('#stock-'+id).html()) < $(this).val()) {
      $(this).val(1);
      alert('La cantidad ingresada no puede ser mayor que el stock actual');
    }

    var total = 0;
    $("td[id^='sale_price-']").each(function() {
      var quantity = $(this).parent().find("td input[name^='quantity']").val();
      var sale_price = parseFloat($(this).html());
      total += quantity*sale_price;
    });
    $('#total').html(total.toFixed(2));

    
    var q = $('#quantity-'+id).find("input[name^='quantity']").val();
    var p = $('#sale_price-'+id).html();
    $('#amount-'+id).html((q*p).toFixed(2));

    var imp = parseFloat($('#percentage').data('percentage'));
    //var subtotal = total.toFixed(2) - (total.toFixed(2)*imp/100);
    //var impuesto_v = total.toFixed(2)*imp/100;
    var subtotal = total.toFixed(2)/(1+(imp/100));
    var impuesto_v = total.toFixed(2) - subtotal;
    $('#subtotal').html(subtotal.toFixed(2));
    $('#percentage').html(impuesto_v.toFixed(2));

  });

  $("body").on("click", ".product-delete", function () {    
    var sale_price = $(this).parent().parent().find("td[id^='sale_price-']").html();
    var quantity = $(this).parent().parent().find("td[id^='quantity-']").find('input[name^="quantity"]').val();
    $(this).parent().parent().remove();
    removePrice(sale_price*quantity);
  });

  $(document).on("keypress", "form", function(event) { 
    return event.keyCode != 13;
  });

  $("#form-sale-store").submit(function(e){
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
            if(key == 'customer_id' && $('.select2').next().is('span.help-block')) {
              $('.select2').next().find('strong').html(value);
            }
            else if($this.find('#'+key).next().is('span.help-block')) {
              $this.find('#'+key).next().find('strong').html(value);
            }
            else {
              if(key == 'customer_id') {
                $('.select2').after('<span class="help-block"><strong>'+value+'</strong></span>');
                $('.select2 span.select2-selection').css({'border-color':'#dd4b39'});
              }else {
                $this.find('#'+key).after('<span class="help-block"><strong>'+value+'</strong></span>');
              }
              
            }
          });

          $('.has-error.num-'+(num-1)).each(function(i, obj) {
              $(obj).removeClass('num-'+(num-1));
              $(obj).removeClass('has-error');
              if($(obj).has('span.select2').length) {
                $(obj).find('span.help-block').remove();
                $(obj).find('span.select2-selection').css({'border-color':'#d2d6de'});
              }else {
                $(obj).find('span').remove();
              }
          });
        }
      }
    };

    obj.data = $(this).serialize();
    $.ajax(obj);
  });

  $("body").on("click", "#sale-detail", function () {
    var url = $(this).data('url');
    $.ajax({
       type: 'GET',
       url: url,
       data: {},
       success: function(data) {
        console.log(data)
        var response = data[0];
        var detail = response.sale_detail;
        var html_detail;
        for(var i=0; i<detail.length; i++) {
          html_detail += '<tr>';
            html_detail += '<td class="text-center">'+detail[i].product_id+'</td>';
            html_detail += '<td class="text-center">'+detail[i].product.name+'</td>';
            html_detail += '<td class="text-center">'+detail[i].product.category.name+'</td>';
            html_detail += '<td class="text-center">'+detail[i].product.brand.name+'</td>';
            html_detail += '<td class="text-center">'+detail[i].product.presentation.name+'</td>';
            html_detail += '<td class="text-center">'+detail[i].quantity+'</td>';
            html_detail += '<td class="text-center">S/ '+detail[i].price+'</td>';
            html_detail += '<td class="text-center">S/ '+(detail[i].quantity*detail[i].price)+'</td>';
          html_detail += '</tr>';
        }
        html_detail += '<tr>';
          html_detail += '<td colspan="6"></td>';
          html_detail += '<td style="font-weight:bold" class="text-center">Total:</td>';
          html_detail += '<td class="text-center">S/ '+response.total+'</td>';
        html_detail += '</tr>';

        var html_provider;
        html_provider += '<tr>';
          html_provider += '<td class="text-center">'+response.provider_id+'</td>';
          html_provider += '<td class="text-center">'+response.provider.business_name+'</td>';
          html_provider += '<td class="text-center">'+response.provider.document+'</td>';
          html_provider += '<td class="text-center">'+response.provider.address+'</td>';
        html_provider += '</tr>';
        
        $('#tbody-sale-provider').html(html_provider);
        $('#tbody-sale-detail').html(html_detail);
        $('#modal-sale-detail').modal('show');
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

  $('body').on('change', '#voucher', function() {
    var $this = $(this);
    if($this.val() != '') {
      $.ajax({
        data: {id: $this.val()},
        type: "GET",
        dataType: "json",
        url: $this.attr('data-url')
      })
      .done(function(data){
        $('#voucher_serie').val(data.serie);
        if(data.now == 0){
          $('#voucher_number').val(data.from);  
        }
        else{
          $('#voucher_number').val(prependZeros(parseInt(data.now) + 1, data.from.length+1));
        }
      });

      var aaa = setInterval(function(){
        if($this.val() != '') {
          $.ajax({
            data: {id: $this.val()},
            type: "GET",
            dataType: "json",
            url: $this.attr('data-url')
          })
          .done(function(data){
            $('#voucher_serie').val(data.serie);
            if(data.now == 0){
              $('#voucher_number').val(data.from);  
            }
            else{
              $('#voucher_number').val(prependZeros(parseInt(data.now) + 1, data.from.length+1));
            }
          });
        }else {
          clearInterval(aaa);
        }
      }, 6000);
    }else {
      $('#voucher_serie').val('');
      $('#voucher_number').val('');
    }
  });

  function prependZeros(num, len){
    var str = ("" + num);
    return (Array(Math.max(len-str.length, 0)).join("0") + str);
  }

});