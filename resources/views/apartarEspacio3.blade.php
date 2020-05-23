@extends('layouts.apping2')
@section('title', 'Apartando')

@section('content')


<script type="text/javascript">

function test(){

	var usuario = $('#nombreUsusario').val();

	$.ajax({
        url: "{{ route('prueba') }}",
        type: "GET",
        data: {usuario},
        success: function(opciones)
        {
        $("#tabla").html(opciones);

        }
    });

}

function Busc_Evento(){
	var evento =$('#nombreEvento').val();
	var espacio=$('#espacio').val();

	$.ajax({
		url:'eventoComp',
		type:'GET',
		data:{evento,espacio}
		success: function(opciones)
		{
			$('#datosComp').html(opciones);
		}

	});
}

function Busc_categoria(){
	var espacio=$('#espacio').val();

	$.ajax({
		url: '{{route("BusCategoria")}}',
		type:'GET',
		data:{espacio},
		success: function(opciones)
		{
			$("#show").html(opciones);
		}
	});
}

function Busc_componente(){
	var espacio=$('#espacio').val();
	var categoria=$('#categotiaComp').val();

	$.ajax({
		url: '{{route("BusCompo")}}',
		type:'GET',
		data:{espacio,categoria},
		success: function(opciones)
		{
			$("#componente").html(opciones);
		}
	});
}

function Busc_cantidad(){
	var espacio=$('#espacio').val();
	var categoria=$('#categotiaComp').val();
	var componente=$('#componente').val();

	$.ajax({
		url: '{{route("BusCantidad")}}',
		type:'GET',
		data:{espacio,categoria,componente},
		success: function(opciones)
		{
			$("#necesarios").html(opciones);
		}
	});
}
</script>

<!--<form class="form" onSubmit="test(); return false;">-->
<form class="form" action="{{ route('prueba') }}">
	{{csrf_field()}}
	<div class="x_panel">
		<div class="x_title">
			<h2>DATOS PERSONALES</h2>
			<ul class="nav navbar-right panel_toolbox">
				<li>
					<a ><i ></i></a>
				</li>
				<li>
					<a ><i ></i></a>
				</li>
				<li>
					<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
				</li>

			</ul>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">

			<div class="row">

				<div class="col-md-6 col-sm-12  form-group">

					<label for="nombreUsusario"> Nombre</label>
					<input class="form-control" type="text" placeholder="{{Auth::user()->name}}" readonly name="nombreUsusario" id="nombreUsusario" value="uriel">
				</div>
				<div class="col-md-6 col-sm-12  form-group">
					<label for="emailUsusario"> Email</label>
					<input class="form-control" type="email" placeholder="{{Auth::user()->email}}" readonly name="emailUsusario" >
				</div>

			</div>
		</div>
	</div>

	<div class="x_panel">
		<div class="x_title">
			<h2>Datos del evento</h2>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">

			<div class="row">

				<div class="col-md-4 col-sm-12  form-group">

					<label for="nombreEvento">Nombre</label>
					<input  title="falllllll" type="text" class="form-control uppercase" placeholder="Ejem: Clausura, practica 1...etc" id="nombreEvento" name="nombreEvento"   required >

				</div>
				<div class="col-md-4 col-sm-12  form-group">

					<label for="DescEvento">Descripción</label>
					<input  title="falllllll" type="text" class="form-control uppercase" placeholder="Ejem: Clausura de fin de curso del ciclo escolar " id="DescEvento" name="DescEvento"   required >

				</div>
				<div class="col-md-4 col-sm-12  form-group">

					<label for="espacio">Elige un espacio</label>
					<select class="form-control form-control-sm" id="espacio" name= "espacio" onchange="Busc_Evento();">
						<option disabled selected>Elige un espacio</option>
						@foreach($espacios as $esp)
						  <option value="{{$esp->ide}}">{{$esp->nombreEspacio}}</option>
						@endforeach
					</select>

				</div>

			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12  form-group">

						<div class="x_panel" >
							<div class="x_title">
								<h2>Elige los componentes que usaras en tu eventos
									<small>(tendra costo extra cada componente)</small>
								</h2>
								<ul class="nav navbar-right panel_toolbox">
									<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
									</li>
									<li class="dropdown">
										<a><i></i></a>
									</li>
									<li><a class="close-link"><i class="fa fa-close"></i></a>
									</li>
								</ul>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<div class="row" id="show">


								</div>
							</div>
						</div>

				</div>
			</div>
		</div>
	</div>

	<div class="x_panel">
		<div class="x_title">
			<h2>Componentes utilizados anteriormente
			</h2>
			<ul class="nav navbar-right panel_toolbox">
				<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
				</li>
				<li class="dropdown">
					<a><i></i></a>
				</li>
				<li><a class="close-link"><i class="fa fa-close"></i></a>
				</li>
			</ul>
			<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<div class="row">
			<div class="col-sm-12">
				<div class="card-box table-responsive">
					<div class="row">
						<div class="col-md-10 col-sm-12"></div>
						<div class="col-md-2 col-sm-12">
							<button type="button" class="btn btn-info btn-lg glyphicon glyphicon-edit" onclick=" Busc_categoria();">Edit</button>
						</div>

					</div>

					<table id="datatable" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th>Categoria</th>
								<th>Componente</th>
								<th>Cantidad</th>
								<th>Costo</th>
								<th>Quitar</th>
							</tr>
						</thead>

						<tbody id="datosComp">


						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<input type="submit"  class="btn btn-primary" value="enviar">


</form>


@endsection
