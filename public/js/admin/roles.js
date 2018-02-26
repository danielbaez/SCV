$(document).ready(function() {
  //***roles***
  
  var num = 0;
  var openedModalCount = 0;

	$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $("body").on("click", "#rol-edit", function () {
    var urlUpdate = $(this).data('url-update');
    $.ajax({
       type: 'GET',
       url: $(this).data('url-edit'),
       data: {},
       success: function(data) {
        console.log(data)
        var formRolEdit = $('#form-rol-edit');
        formRolEdit.find('#name').val(data.name);
        formRolEdit.find("input[name='state'][value='"+data.state+"']").prop("checked", true);

        formRolEdit.attr('action', urlUpdate);

        $('#modal-rol-edit').modal('show');
       }
     });
  });

  $("body").on("click", "#rol-delete", function () {
    var urlDestroy = $(this).data('url');
    var formRolDelete = $('#form-rol-delete');
    formRolDelete.attr('action', urlDestroy);
    $('#modal-rol-delete').modal('show');
  });

  $("#form-rol-create").submit(function(e){
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

  $("#form-rol-edit").submit(function(e){
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

  $("#form-rol-delete").submit(function(e){
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

  $("#modal-rol-create").on("show.bs.modal", function () {
    $("#form-rol-create").find('#name').val('');
  });

  $("#modal-rol-edit").on("show.bs.modal", function () {
    //$("#form-rol-edit").find('#password').val('');
  });

  $("#modal-rol-create, #modal-rol-edit").on("hidden.bs.modal", function () {
    $('div.form-group').removeClass('has-error');
    $('div.form-group').removeClass(function(index,classes){
      var matches = classes.match(/\bnum-\S+/ig);
      return (matches) ? matches.join(' ') : '';   
    });
    $('span.help-block').remove();
  });

  //***DataTable***

  $('#roles').DataTable({
    order: [ [0, 'desc'] ],
    "columnDefs": [
      {"targets": [3], orderable: false},
    ],
    dom: 'Bfrtip',
    buttons: [
      {extend: 'copyHtml5', className: 'hidden'},
      {extend: 'excelHtml5', title: 'Lista de roles', filename: 'reporte-roles', exportOptions: {columns: [0, 1, 2]}},
      {extend: 'csvHtml5', filename: 'reporte-roles', exportOptions: {columns: [0, 1, 2]}},
      //'print',
      {extend: 'pdfHtml5', orientation: 'portrait', pageSize: 'A4', title: 'Lista de roles', filename: 'reporte-roles', exportOptions: {columns: [0, 1, 2]},
        customize: function (doc) {
          //doc.content[1].table.widths = '40%';
          doc.content[1].table.widths = 
          Array(doc.content[1].table.body[0].length + 1).join('*').split('');
        }
      }
    ],
    "pageLength": 8,
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

});