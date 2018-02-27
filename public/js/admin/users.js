$(document).ready(function() {
  //***users***
  
  var num = 0;
  var openedModalCount = 0;

  showModal('modal-user-create', 'form-user-create', [{input: 'text', name: 'name'}, {input: 'text', name: 'lastname'}, {input: 'text', name: 'email'}, {input: 'text', name: 'password'}, {input: 'text', name: 'rol_id'}, {input: 'text', name: 'document'}, {input: 'text', name: 'birth_date'}, {input: 'text', name: 'address'}, {input: 'text', name: 'phone'}, {input: 'checkbox', name: 'state'}]);

  hiddenModal('modal-user-create', 'modal-user-edit');

  //create
  storeR('form-user-create', num, true);
  //update
  showModalEdit('user-edit', 'form-user-edit', 'modal-user-edit', [{input: 'text', name: 'name'}, {input: 'text', name: 'lastname'}, {input: 'text', name: 'email'}, {input: 'text', name: 'rol_id'}, {input: 'text', name: 'document'}, {input: 'text', name: 'birth_date'}, {input: 'text', name: 'address'}, {input: 'text', name: 'phone'}, {input: 'checkbox', name: 'state'}]);
  updateR('form-user-edit', num, true);

  //delete
  showModalDelete('user-delete', 'form-user-delete', 'modal-user-delete');
  destroyR('form-user-delete');

  $("#modal-user-edit").on("show.bs.modal", function () {
    $("#form-user-edit").find('#password').val('');
  });

  //***DataTable***

	jQuery.fn.DataTable.Api.register( 'buttons.exportData()', function ( options ) {
		
    	if ( this.context.length ) {
        var jsonResult = $.ajax({
            url: $('#users').data('url'),
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

        //console.log(jsonResult);
        //console.log(jsonResult.responseJSON.data);

        /*jsonResult.responseJSON.data.forEach(function(part, index, theArray) {
          theArray[index]['rol_id'] = theArray[index]['rol']['name'];
          theArray[index]['state'] = theArray[index]['state'] == 1 ? 'Activo' : 'Inactivo';
          delete theArray[index]["rol"];
        });*/

        /*jsonResult.responseJSON.data.forEach(function(part, index, theArray) {

          theArray[index][5] = theArray[index][7][1];
          theArray[index][6] = theArray[index][6] == 1 ? 'Activo' : 'Inactivo';
          theArray[index].splice(7, 1);//eliminando
          console.log(theArray)
        });*/

        jsonResult.responseJSON.data.forEach(function(part, index, theArray) {

        	var newData = [];
        	newData.push(theArray[index]['id']);
        	newData.push(theArray[index]['name']);
        	newData.push(theArray[index]['lastname']);
        	newData.push(theArray[index]['email']);
        	newData.push(theArray[index]['document']);
        	newData.push(theArray[index]['address']);
        	newData.push(theArray[index]['birth_date']);
        	newData.push(theArray[index]['phone']);
        	newData.push(theArray[index]['rol']['name']);
        	newData.push(theArray[index]['state'] == 1 ? 'Activo' : 'Inactivo');	              
          	delete theArray[index];
          	theArray[index] = newData;
          	//console.log(theArray)
          	
        });

        return {body: jsonResult.responseJSON.data, header: $("#users thead tr th.r").map(function() { return this.innerHTML; }).get()};
    	}
	});

	$.fn.dataTable.ext.errMode = 'none'; //alert, throw, none

	$('#users').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": $('#users').data('url'),
			"data": {action: 'ajax'}
		},
		"columns": [
			{data: 'id'},
			{data: 'name'},
			{data: 'lastname'},
			{data: 'email'},
			{data: 'document'},
			{data: 'address'},
			{data: 'birth_date'},
			{data: 'phone'},
			{data: 'rol.name'},
			{data: 'state', visible: true, render: function ( data, type, full, meta ) {
          return data == 1 ? "<span class='badge alert-success'>Activo</span>" : "<span class='badge alert-danger'>Inactivo</span>";
        }
	    },
      {data: 'photo', visible: true, render: function ( data, type, full, meta ) {
          var url = $('#users').data('url-image')+'/'+data;
          return data ? "<img class='img-responsive' style='border-radius: 50%; width: 42px; height: 42px;' src='"+url+"'>" : '';
        }
      },
	    {data: 'rol.name'},
	    {data: 'action', visible: true, render: function ( data, type, full, meta ) {
          //return '<button class="btn btn-md btn-primary" title="Editar" id="user-edit" data-url="'+data+'"><i class="fa fa-edit"></i></button> <button class="btn btn-md btn-danger" title="Eliminar" id="user-delete" data-url="'+data+'"><i class="fa fa-ban"></i></button>';


          var url = data.split(',');

          return '<button class="btn btn-md btn-primary" title="Editar" id="user-edit" data-url-edit="'+url[0]+'" data-url-update="'+url[1]+'"><i class="fa fa-edit"></i></button> <button class="btn btn-md btn-danger" title="Eliminar" id="user-delete" data-url="'+url[2]+'"><i class="fa fa-ban"></i></button>';
        }
      }
		],
		order: [ [0, 'desc'] ],
		"columnDefs": [
	     { className: "hide_column", "targets": [5] },
	     { className: "hide_column", "targets": [6] },
	     { className: "hide_column", "targets": [7] },
	     { className: "text-center", "targets": [9] },
       { className: "text-center", "targets": [10], orderable: false },
	     { className: "hide_column", "targets": [11] },
	     { className: "text-center", "targets": [12], orderable: false },
      	],
		dom: 'Bfrtip',
        buttons: [
            {extend: 'copyHtml5', className: 'hidden'},
            {extend: 'excelHtml5', className: 'hidden', title: 'Lista de usuarios', filename: 'reporte-usuarios'},
            {extend: 'csvHtml5', className: 'hidden', filename: 'reporte-usuarios'},
            //'print',
            {extend: 'pdfHtml5', className: 'hidden', orientation: 'landscape', pageSize: 'A4', title: 'Lista de usuarios', filename: 'reporte-usuarios'
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
        },
        
	});

	$('.dt-buttons.btn-group').append('<button type="button" onclick="fnAction(\'excel\');" class="btn btn-default">Excel</button><button type="button" onclick="fnAction(\'csv\');" class="btn btn-default">CSV</button><button type="button" onclick="fnAction(\'pdf\');" class="btn btn-default">PDF</button>').addClass('m-l-1')

});

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