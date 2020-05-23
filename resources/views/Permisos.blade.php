@extends('layouts.apping2')
@section('title', 'bienvenidos')
@section('content')
<script type="text/javascript">

function asignar(){
  var usuario = $('#usuario').val();

  var selected = '';
    $('#formid input[type=checkbox]').each(function(){
        if (this.checked) {
            selected += $(this).val()+', ';
        }
    });

    $.ajax({
        url: "{{ route('asignarPermiso') }}",
        type: "GET",
        data: { usuario,selected},
        success: function(opciones)
        {
        $("#tla").html(opciones);

        }
    });

}
</script>


<script type="text/javascript">

function eliminar(){


  var selected = '';
    $('#formid2 input[type=checkbox]').each(function(){
        if (this.checked) {
            selected += $(this).val()+', ';
        }
    });

    $.ajax({
        url: "{{ route('quitarPermiso') }}",
        type: "GET",
        data: {selected},
        success: function(opciones)
        {
        $("#tla").html(opciones);

        }
    });

}
</script>

<script type="text/javascript">
  function Mostrar(){
    var usuario = $('#usuario').val();

    $.ajax(
      {
          url:"{{ route('mostrarPermisos') }}",
          type: "GET",
          data : {usuario},
          success: function(opciones){
            $("#tla").html(opciones);
      }
    })

  }
</script>




<table>
	<td WIDTH="250">

		<form  class="form" id="formid2"  onSubmit="eliminar(); return false">
			<!--<table id="tla" border=2>-->
			<table id="tla" class="table table-striped table-bordered" style="width:100%">

				<center>
					<thead>
						<tr>
							<td>Usuario</td>
      					</tr>
      				</thead>
				</center>
    		</table>

    		<input type="submit"  class="btn btn-primary" value="Quitar recursos"  >
  		</form>
  	</td>
  	<td></td>
  	<td>
    	<center>
			<form class="form" id="formid"  onSubmit="asignar(); return false">
    			{{csrf_field()}}
				<p>Elige el usuario y el recurso que le deses asignar</p>
  				<table>
    				<tr>
      					<td>
        					<div class="form-group" >
          						Seleciona el usuario
        					</div>
      					</td>
      					<td>
        					<div class="form-group">
            					<select class="form-control form-control-sm" id="usuario" name= "ususario" onchange="Mostrar()">
                				@foreach($usu as $usuarios)
                      			<option value="{{$usuarios->id}}">{{$usuarios->name}}</option>
                				@endforeach
            					</select>
        					</div>
      					</td>
    				</tr>
    				<tr>
      					<td WIDTH="50">
        					<div class="form-group">
          						Seleciona el recurso
        					</div>
      					</td>
      					<td>
          					@foreach($recu as $recursos)
            				<div class="form-group">
              					<input class="form-check-input" type="checkbox" name="recurso[]" id="recurso[]" value="{{$recursos->id}}">{{$recursos->TituloOpcion}}</input>
            				</div>
          					@endforeach
      					</td>
    				</tr>
    				<tr>
      					<td>
               				<input type="submit"  class="btn btn-primary" value="enviar"  >
       					</td>
    				</tr>
  				</table>

			</form>
		</center>
	</td>
</table>
@endsection
