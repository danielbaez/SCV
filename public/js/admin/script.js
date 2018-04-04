
$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

//***DataTable***
function dataTableSimple(tableId, fileName, titleFile, hiddenColumnOrder, hiddenColumn, columnsExport, orientationPdf, pageSize, pageLength, search, order, pagination, customizePdf) {

  $('#'+tableId).DataTable({
    order: order,
    "columnDefs": [
      {"targets": hiddenColumnOrder, orderable: false},
      {"targets": hiddenColumn, orderable: false, visible: false},
    ],
    dom: 'Bfrtip',
    buttons: [
      {extend: 'copyHtml5', className: 'hidden'},
      {extend: 'excelHtml5', title: titleFile, filename: fileName, exportOptions: {columns: columnsExport}},
      {extend: 'csvHtml5', filename: fileName, exportOptions: {columns: columnsExport}},
      //'print',
      {extend: 'pdfHtml5', orientation: orientationPdf, pageSize: pageSize, title: titleFile, filename: fileName, exportOptions: {columns: columnsExport},
        customize: customizePdf ? function (doc, customize) {
          //doc.content[1].table.widths = '40%';
          doc.content[1].table.widths = 
          Array(doc.content[1].table.body[0].length + 1).join('*').split('');
        } : false
      }
    ],
    "pageLength": pageLength,
    "searching": search,
    "paging": pagination,
    "language": {
        "lengthMenu": "Mostrar _MENU_ registros por página",
        "zeroRecords": "No se encontraron registros",
        //"info": "Página _PAGE_ de _PAGES_",
        "info": "",
        //"infoEmpty": "No hay registros disponibles",
        "infoEmpty": "",
        //"infoFiltered": "(filtrado de _MAX_ total registros)",
        "infoFiltered": "",
        "loadingRecords": "Cargando...",
        "search": "Buscar:",
        "processing": "Procesando...",
        "paginate": {
          "first":      "Primero",
          "last":       "último",
          "next":       "Siguiente",
          "previous":   "Anterior"
        },
    }        
  });  
}

//create
function storeR(formId, num, hasFile) {
  $("#"+formId).submit(function(e){
    e.preventDefault(e);

    var $this = $(this);
    $this.find(":submit").prop('disabled', true);

    var obj = {
       type: 'POST',
       url: $this.attr('action'),
       data: $(this).serialize(),
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

    if(hasFile) {
      obj.data = new FormData(this);
      obj.contentType = false;
      obj.cache = false;
      obj.processData = false;
    }else {
      obj.data = $(this).serialize();
    }

    $.ajax(obj);
  });  
}

function showModalEdit(id, formId, modalId, fields) {
  $("body").on("click", "#"+id, function () {
    var urlUpdate = $(this).data('url-update');
    $.ajax({
       type: 'GET',
       url: $(this).data('url-edit'),
       data: {},
       success: function(data) {
        console.log(data)
        var formRolEdit = $('#'+formId);
        
        $.each(fields, function( index, value ) {
          if(value.input == 'text') {
            formRolEdit.find('#'+value.name).val(data[value.name]);
          }else if(value.input == 'checkbox') {
            formRolEdit.find("input[name='"+value.name+"'][value='"+data.state+"']").prop("checked", true);
          }else if(value.input == 'date') {
            $('.birth_date').datepicker({
                format:'dd/mm/yyyy',
            }).datepicker("setDate", moment(data[value.name]).format('DD/MM/YYYY'));
          }
        });

        formRolEdit.attr('action', urlUpdate);

        $('#'+modalId).modal('show');
       }
     });
  });
}

function updateR(formId, num, hasFile) {

  $("#"+formId).submit(function(e){
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

    if(hasFile) {
      obj.data = new FormData(this);
      obj.contentType = false;
      obj.cache = false;
      obj.processData = false;
    }else {
      obj.data = $(this).serialize();
    }

    $.ajax(obj);
  });
}

function showModalDelete(id, formId, modalId) {
  $("body").on("click", "#"+id, function () {
    var urlDestroy = $(this).data('url');
    var formRolDelete = $('#'+formId);
    formRolDelete.attr('action', urlDestroy);
    $('#'+modalId).modal('show');
  });
}

//delete
function destroyR(formId) {
  $("#"+formId).submit(function(e){
    e.preventDefault(e);

    var $this = $(this);
    $this.find(":submit").prop('disabled', true);

    $.ajax({
       type: 'POST',
       url: $this.attr('action'),
       data: $(this).serialize(),
       success: function(data){
        console.log(data)
        if(data.state) {
          window.location = data.url;
        }
       },
       error: function (request, status, error) {
        $this.find(":submit").prop('disabled', false);
      }
    });
  });
}

function showModal(modalCreate, formId, fields) {
  $("#"+modalCreate).on("show.bs.modal", function () {
    $("#"+formId).find('#name').val('');
    var form = $('#'+formId);
    $.each(fields, function( index, value ) {
      if(value.input == 'text') {
        form.find('#'+value.name).val('');
      }else if(value.input == 'checkbox') {
        form.find("input[name='"+value.name+"'][value='1']").prop("checked", true);
      }
    });


  });
}

function hiddenModal(modalCreate, modalEdit) {
  $("#"+modalCreate+", #"+modalEdit+"").on("hidden.bs.modal", function () {
    $('div.form-group').removeClass('has-error');
    $('div.form-group').removeClass(function(index,classes){
      var matches = classes.match(/\bnum-\S+/ig);
      return (matches) ? matches.join(' ') : '';   
    });
    $('span.help-block').remove();
  });
}

function overwriteExport(tableId, columnsExport) {
  jQuery.fn.DataTable.Api.register( 'buttons.exportData()', function ( options ) {    
    if ( this.context.length ) {
      var jsonResult = $.ajax({
          url: $('#'+tableId).data('url'),
          type: 'GET',
          data: {
            action: 'export'
          },
          dataType: "json",
          success: function (result) {
              console.log(result)
          },
          async: false
      });

      jsonResult.responseJSON.data.forEach(function(part, index, theArray) {

        var newData = [];

        for(var i=0; i<columnsExport.length; i++) {
          if($.isArray(columnsExport[i].column)) {
            if(columnsExport[i].condition) {
              newData.push(theArray[index][columnsExport[i].column[0]][columnsExport[i].column[1]] == columnsExport[i].condition[0] ? columnsExport[i].condition[1] : columnsExport[i].condition[2]);
            }else if(columnsExport[i].join) {
              newData.push(theArray[index][columnsExport[i].column[0]][columnsExport[i].column[1]]+' '+theArray[index][columnsExport[i].join[0]][columnsExport[i].join[1]]);
            }else{
              newData.push(theArray[index][columnsExport[i].column[0]][columnsExport[i].column[1]]);
            }           
          }else {
            if(columnsExport[i].condition) {
              newData.push(theArray[index][columnsExport[i].column] == columnsExport[i].condition[0] ? columnsExport[i].condition[1] : columnsExport[i].condition[2]);
            }else if(columnsExport[i].join) {
              newData.push(theArray[index][columnsExport[i].column]+' '+theArray[index][columnsExport[i].join]);
            }else {
              newData.push(theArray[index][columnsExport[i].column]);  
            } 
          } 
        }                
          delete theArray[index];
          theArray[index] = newData;
      });
      return {body: jsonResult.responseJSON.data, header: $("#"+tableId+" thead tr th.r").map(function() { return this.innerHTML; }).get()};
    }
  });
}

function dataTableServerSide(tableId, fileName, titleFile, columnDefs, orientationPdf, pageSize, pageLength, search, order, pagination, columns, customizePdf) {

  $.fn.dataTable.ext.errMode = 'none'; //alert, throw, none

  $('#'+tableId).DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": $('#'+tableId).data('url'),
      "data": {action: 'ajax'}
    },
    "columns": columns,
    order: order,
    "columnDefs": columnDefs,
    dom: 'Bfrtip',
        buttons: [
            {extend: 'copyHtml5', className: 'hidden'},
            {extend: 'excelHtml5', className: 'hidden', title: titleFile, filename: fileName},
            {extend: 'csvHtml5', className: 'hidden', filename: fileName},
            //'print',
            /*{extend: 'pdfHtml5', className: 'hidden', orientation: orientationPdf, pageSize: pageSize, title: titleFile, filename: fileName
            }*/
            {extend: 'pdfHtml5', className: 'hidden', orientation: orientationPdf, pageSize: pageSize, title: titleFile, filename: fileName,
              customize: customizePdf ? function (doc, customize) {
                //doc.content[1].table.widths = '40%';
                doc.content[1].table.widths = 
                Array(doc.content[1].table.body[0].length + 1).join('*').split('');
              } : false
            }
        ],
    "pageLength": pageLength,
    "searching": search,
    "paging": pagination,
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se encontraron registros",
            //"info": "Página _PAGE_ de _PAGES_",
            "info": "",
            //"infoEmpty": "No hay registros disponibles",
            "infoEmpty": "",
            //"infoFiltered": "(filtrado de _MAX_ total registros)",
            "infoFiltered": "",
            "loadingRecords": "Cargando...",
            "search": "Buscar:",
            "processing": "Procesando...",
            "paginate": {
            "first":      "Primero",
            "last":       "último",
            "next":       "Siguiente",
            "previous":   "Anterior"
        },
        },
        
  });
}

function overwriteButtons() {
  $('.dt-buttons.btn-group').append('<button type="button" onclick="fnAction(\'excel\');" class="btn btn-default">Excel</button><button type="button" onclick="fnAction(\'csv\');" class="btn btn-default">CSV</button><button type="button" onclick="fnAction(\'pdf\');" class="btn btn-default">PDF</button>').addClass('m-l-1')
}

function fnAction(action) {
  $('#modal-export').modal({
    backdrop: 'static',
    keyboard: false
  });

  setTimeout(function() {
    $('.buttons-'+action).trigger('click');

  }, 1000)

  var aa = setInterval(function(){
    console.log(3232)
    if(!$('.buttons-'+action).hasClass('processing')) {
      $('#modal-export').modal('hide');
      clearInterval(aa);
    }       
  }, 1000);
}
  