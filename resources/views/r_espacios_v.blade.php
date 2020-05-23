@extends('layouts.apping2')
@section('title', 'Espacios')
@section('content')


<div class="panel panel-default">
	<div class="x_title">
		<h2>Administrar Espacios</h2>
		<ul class="nav navbar-right panel_toolbox">
			<li><a ><i ></i></a></li>
			<li><a ><i ></i></a></li>
			<li>
				<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			</li>

		</ul>
		<div class="clearfix"></div>
	</div>
	<div class="panel-body">


		<form class="form">
			<div class="form-row">
				<div class="col-md-4 mb-3">
					<input  title="falllllll" type="text" class="form-control uppercase " placeholder="nombre espacio" id="nombreEspacio" name="nombreEspacio"   on required>
				</div>

				<div class="col-md-4 mb-3">
					<input  title="falllllll" type="text" class="form-control uppercase" placeholder="descripcion espacio" id="desEspacio" name="desEspacio"   required >
				</div>

				<div class="col-md-2 mb-3">
					<select name="id_admin" id ="id_admin" class="form-control">
						<option disabled selected>Encargado</option>
						@foreach($us as $rol)
						<option value="{{$rol->id}}">{{$rol->name}}</option>
						@endforeach
					</select>
				</div>

				<div class="col-md-2 mb-3">
					<button type="submit" id ="buttoni"  class="btn btn-primary">Registrar</button>
				</div>
			</div>
		</form>

		@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
			</ul>
		</div>
		@endif
	</div>
</div>


<div class="container">
	<table id="espaciost" class="table table-hover table-condensed" style="width:100%">
		<thead>
			<tr>
				<th>Id</th>
				<th>Encargado</th>
				<th>Espacio</th>
				<th>Acciones</th>
			</tr>
		</thead>
    </table>
</div>



<div id="studentModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form  id="student_form">

                <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <h4 class="modal-title">Add Data</h4>
                </div>

                <div class="modal-body">
                    {{csrf_field()}}
                    <span id="form_output"></span>
                    <div class="form-group">
                        <label>Espacio</label>
                        <input type="text" name="espacioM" id="espacioM" class="form-control uppercase" />
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" name="descripM" id="descripM" class="form-control uppercase" />
                    </div>

					<div class="form-group">
						<label>Responsable</label>
						<select name="id_adminm" id ="id_adminm" class="form-control">
							<option disabled selected>Encargado</option>
							@foreach($us as $rol)
							<option value="{{$rol->id}}">{{$rol->name}}</option>
							@endforeach
						</select>
					</div>

                </div>


                <div class="modal-footer">
                    <input type="submit" name="submit" id="action" value="Add" class="btn btn-info" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

            </form>

        </div>
    </div>
</div>



<div id="removeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form  id="remove_form">

                <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <h4 class="modal-title">Add Data</h4>
                </div>

                <div class="modal-body">
                    {{csrf_field()}}
                    <span id="form_output2"></span>

					<div class="form-group">
                        <label> </label>
                        <input type="text" disabled ="true" name="descrip_r" id="descrip_r" class="form-control uppercase" />
                    </div>


                </div>
                <div class="modal-footer">

                    <input type="submit" name="submit" id="action_r" value="Add" class="btn btn-info" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<style type="text/css">
  input.uppercase { text-transform: uppercase; }
</style>

<script>
    $(function(){
       $('#buttoni').click(function() {

		   var id = $('#id_admin').val();
		   var res = $('#nombreEspacio').val();
		   var des = $('#desEspacio').val();

		   $.ajax({
                url: "{{ route('datatable.iespacio') }}",
                type: "GET",
                data: { id: id, nom:res, des:des },
                success: function(response)
                {
                    table.ajax.reload();
                }
            });
       });
    });
</script>



<script>

	$(document).ready( function () {
  		var id;

  		var oTable = $('#espaciost').DataTable({
         	processing: true,
         	serverSide: true,

			ajax: "{{ route('datatable.tespacios') }}",
			columns: [
            	{data: 'ide' , name: 'ide'},
                {data: 'name', name: 'name'},
                {data: 'nombreEspacio', name: 'nombreEspacio'},
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ],
            language: {
				"decimal":        "",
    			"emptyTable":     "No hay datos",
    			"info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
    			"infoEmpty":      "Mostrando 0 a 0 de 0 registros",
    			"infoFiltered":   "(Filtro de _MAX_ total registros)",
    			"infoPostFix":    "",
    			"thousands":      ",",
    			"lengthMenu":     "Mostrar _MENU_ registros",
    			"loadingRecords": "Cargando...",
    			"processing":     "Procesando...",
    			"search":         "Buscar:",
    			"zeroRecords":    "No se encontraron coincidencias",
    			"paginate": {
        		"first":      "Primero",
        		"last":       "Ultimo",
        		"next":       "Próximo",
        		"previous":   "Anterior"
    		},

			"aria": {
        		"sortAscending":  ": Activar orden de columna ascendente",
        		"sortDescending": ": Activar orden de columna desendente"
    		}
		}
	});

	/* When click edit user */
	// $('body').on('click', '.action', function () {
    $('#student_form').on('submit', function (event){
  //$('#action').click(function() {

      var form_data = $('#student_form').serialize();
      var id_es = $(this).attr("id");

      var id_ad = $('#id_adminm').val();
      var esp = $('#espacioM').val();
      var des = $('#descripM').val();

   $.ajax({
                url: "{{ route('datatable.editespacio') }}",
                type: 'GET',
                method:'GET',
                data: { ide: id, ida: id_ad, espa:esp ,desc :des },
                //data: form_data,

                success: function(data)
                {

          //  table.ajax.reload();

                }
            });

   });


 $('#remove_form').on('submit', function (event){
var id = datos['ide'];
   $.ajax({
                url: "{{ route('datatable.borraespacio') }}",
                type: 'GET',
                method:'GET',
                data: { ide: id },
                //data: form_data,

                success: function(data)
                {

           // table.ajax.reload();


                }
            });

   });


var datos;

$("#espaciost tbody").on('click', 'tr', function (e) {

 datos = $('#espaciost').DataTable().row($(this)).data();



});



$(document).on('click', '.edit', function(){
        id = $(this).attr("id");


        $('#form_output').html('');


               $('#espacioM').val(datos['nombreEspacio']);
                $('#descripM').val(datos['desEspacio']);
                //$('#student_id').val(id);

             // $('#id_adminm > option[value=' + datos['name'] + ']').attr('selected', 'selected');
               $('#id_adminm').val(datos['idencargado']);

                $('#studentModal').modal('show');

                $('#action').val('Edit');
                $('.modal-title').text('Editando Espacios');
             //   $('#button_action').val('update');

    });


$(document).on('click', '.remove', function(){
        var id = $(this).attr("id2");


        $('#form_output2').html('');


           $('#descrip_r').val(datos['nombreEspacio']);

                $('#removeModal').modal('show');

                $('#action_r').val('Eliminar');
                $('.modal-title').text('Confirmar eliminar espacio?');


    });




   });



 function mayus(e) {
    e.value = e.value.toUpperCase();
    return;
}

</script>




@endsection
