
$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

//***DataTable***
function dataTableSimple(tableId, fileName, titleFile, hiddenColumn, columnsExport, orientationPdf, pageSize, pageLength, search=true) {
  $('#'+tableId).DataTable({
    order: [ [0, 'desc'] ],
    "columnDefs": [
      {"targets": hiddenColumn, orderable: false},
    ],
    dom: 'Bfrtip',
    buttons: [
      {extend: 'copyHtml5', className: 'hidden'},
      {extend: 'excelHtml5', title: titleFile, filename: fileName, exportOptions: {columns: columnsExport}},
      {extend: 'csvHtml5', filename: fileName, exportOptions: {columns: columnsExport}},
      //'print',
      {extend: 'pdfHtml5', orientation: orientationPdf, pageSize: pageSize, title: titleFile, filename: fileName, exportOptions: {columns: columnsExport},
        customize: function (doc) {
          //doc.content[1].table.widths = '40%';
          doc.content[1].table.widths = 
          Array(doc.content[1].table.body[0].length + 1).join('*').split('');
        }
      }
    ],
    "pageLength": pageLength,
    "searching": search,
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
function storeR(formId, num) {
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
    });
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
        //console.log(data)
        var formRolEdit = $('#'+formId);
        
        $.each(fields, function( index, value ) {
          if(value.input == 'text') {
            formRolEdit.find('#'+value.name).val(data[value.name]);
          }else if(value.input == 'checkbox') {
            formRolEdit.find("input[name='"+value.name+"'][value='"+data.state+"']").prop("checked", true);
          }
        });

        formRolEdit.attr('action', urlUpdate);

        $('#'+modalId).modal('show');
       }
     });
  });
}

function updateR(formId, num, hasFile=false) {

  $("#"+formId).submit(function(e){
    e.preventDefault(e);

    var $this = $(this);
    $this.find(":submit").prop('disabled', true);

    $.ajax({
       type: 'POST',
       url: $this.attr('action'),
       data: hasFile ? new FormData(this) : $(this).serialize(),
       //contentType: hasFile ? false : '',
       cache: hasFile ? false : '',
       processData: hasFile ? false : '',
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
    });
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

  