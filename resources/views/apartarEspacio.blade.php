@extends('layouts.apping2')
@section('title', 'Apartando')

@section('content')


<style>
	.espacio{
		margin-top: 40px;
	}
</style>
<div class="espacio">
	@if($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
	@endif

	@if(session()->get('mensaje'))

		<div class="alert alert-success">
			{{session()->get('mensaje')}}
		</div>

	@endif
<!--	onSubmit="enviar(); return false"-->
<form class="form-horizontal form-label-left" action="{{route('ApartarEspacio')}}">
	<div class="x_panel">
		<div class="x_title">
			<h2>Crea tu evento </h2>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<div id="wizard" class="form_wizard wizard_horizontal">
				<ul class="wizard_steps">
					<li>
						<a href="#step-1">
							<span class="step_no">1</span>
							<span class="step_descr">
								Datos personales<br />
								<small>Tus datos de usuario</small>

							</span>
						</a>
					</li>
					<li>
						<a href="#step-2">
							<span class="step_no">2</span>
							<span class="step_descr">
								Evento<br />
								<small>Datos del evento</small>
							</span>
						</a>
					</li>
					<li>
						<a href="#step-3">
							<span class="step_no">3</span>
							<span class="step_descr">
								Componentes<br />
								<small>Agrega o quita componentes</small>
							</span>
						</a>
					</li>
					<li>
						<a href="#step-4">
							<span class="step_no">4</span>
							<span class="step_descr">
								Terminos y condiciones<br />
							</span>
						</a>
					</li>
				</ul>
				<div id="step-1">
					<div class="x_panel">
						<div class="x_title">
							<h2>DATOS PERSONALES</h2>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<div class="row">
								<div class="col-md-6 col-sm-12  form-group">

									<label for="nombreUsusario"> Nombre</label>
									<input class="form-control" type="text" placeholder="{{Auth::user()->name}}" readonly name="nombreUsusario" id="nombreUsusario" value="uriel">
								</div>
								<div class="col-md-6 col-sm-12  form-group">
									<label for="emailUsusario"> E-mail</label>
									<input class="form-control" type="email" placeholder="{{Auth::user()->email}}" readonly name="emailUsusario" >
								</div>

							</div>
						</div>
					</div>
				</div>


				<div id="step-2">
					<div class="x_panel">
						<div class="x_title">
							<h2>Datos del evento</h2>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">

							<div class="row">

								<div class="col-md-4 col-sm-12  form-group">

									<label for="nombreEvento">Nombre</label>
									<input  title="Escribe el  nombre de tu evento" type="text" class="form-control uppercase" placeholder="Ejem: Clausura, practica 1...etc" id="nombreEvento" name="nombreEvento" value="{{old('nombreEvento')}}">

								</div>
								<div class="col-md-4 col-sm-12  form-group">

									<label for="DescEvento">Descripción</label>
									<input  title="Descripción del evento" type="text" class="form-control uppercase" placeholder="Ejem: Clausura de fin de curso del ciclo escolar " id="DescEvento" name="DescEvento" value="{{old('DescEvento')}}">

								</div>
								<div class="col-md-4 col-sm-12  form-group">

									<label for="espacio">Elige un espacio</label>
									<select class="form-control form-control-sm" id="espacio" name= "espacio"  onchange="Busc_Evento();" >
										<option disabled selected>Elige un espacio</option>
										@foreach($espacios as $esp)
										  <option value="{{$esp->ide}}">{{$esp->nombreEspacio}}</option>
										@endforeach
									</select>

								</div>

								<div class="col-md-4 col-sm-12">
									<label for="Fecha">Elige la fecha de tu evento</label>
									<div class="input-group date form_date " data-date="" data-date-format="dd MM yyyy" data-link-field="Fecha" data-link-format="yyyy-mm-dd">

										<input class="form-control" type="text" value="" id="Fechas" readonly>
										<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
									</div>
									<input type="hidden" id="Fecha" name="Fecha" value="{{old('Fecha')}}" /><br />
								</div>

								<div class="col-md-4 col-sm-12">


									<label for="HoraI">¿a que hora inciará?</label>
									<div class="input-group date form_time1 " data-date="" data-date-format="hh:ii" data-link-field="HoraI" data-link-format="hh:ii">

										<input class="form-control" type="text" value="" id="HoraIs" readonly>
										<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									</div>
									<input type="hidden" id="HoraI" name="HoraI" value="{{old('HoraI')}}"/><br />

								</div>

								<div class="col-md-4 col-sm-12">


									<label for="HoraF">¿a que hora terminará?</label>
									<div class="input-group date form_time2 " data-date="" data-date-format="hh:ii" data-link-field="HoraF" data-link-format="hh:ii">

										<input class="form-control" type="text" value="" id="horaFs" readonly>
										<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									</div>
									<input type="hidden" id="HoraF" name="HoraF" value="{{old('HoraF')}}" /><br />

								</div>



							</div>
							<div class="alert alert-primary">
								<p>Nota:<br>
								&nbsp;&nbsp;&nbsp;&nbsp; -Algunas fechas estan deshabilitas por 2 motivos:
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; *Las fechas son pasadas.
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; *Ya hay eventos confirmados para esas fechas.
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;-Algunas horas estan deshabilitadas por dos motivos:
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; *Son horas no laborables.
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; *Ya hay eventos confirmados para esas horas.
								<br>

							</p>

							</div>
						</div>
					</div>

				</div>

				<div id="step-3">

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
									<div class="col-md-4 col-sm-12">

										<label for="categotiaComp">Elige una categoria</label>
										<select class="form-control form-control-sm" id="categotiaComp" onchange="Busc_componente();">
											<option disabled selected>Elige una categoria</option>
										</select>

									</div>

									<div class="col-md-3 col-sm-12">

										<label for="componente">Elige un componente</label>
										<select class="form-control form-control-sm" id="componente" onchange="Busc_cantidad();">
											<option disabled selected>Elige un componente</option>
										</select>

									</div>

									<div class="col-md-3 col-sm-12">

										<label for="necesarios">Elige cuantos necesitaras</label>
										<select class="form-control form-control-sm" id="necesarios">
											<option disabled selected>Elige cuantos usaras</option>
										</select>

									</div>

									<div class="col-md col-sm-12">

										<button type="button" class="btn btn-info btn-lg glyphicon glyphicon-plus-sign" style="height: 40px; margin-top: 15px;" onclick="add_comp();">Agregar</button>

									</div>

								</div>
							</div>
						</div>

					</div>

					<div class="col-md-12 col-sm-12  form-group">
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
								<div class="col-sm-12">
									<div class="card-box table-responsive">
										<p class="text-muted font-13 m-b-30">
											Si necesitas una cantidad distinta puedes agregar el componente con la cantidad necesaria, y se borrará la actual
										</p>

										<table id="datatable" class="table table-hover table-condensed" style="width:100%">
											<thead>
												<tr>
													<th>Categoria</th>
													<th>Componente</th>
													<th>Cantidad</th>
													<th>Costo c/u</th>
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


					</div>

				</div>

				<div id="step-4">
                    <h2 class="StepTitle">Términos y condiciones</h2>
                    <p>Se mandará la solicitud al administrador del lugar para que él evalue tu petición, necesitas esperar a que él la acepte.
					<br>Una vez que acepte tu solicitud  tendrás 3 días para realizar el pago correspondiente en el área de caja de la facultad de ingeniería.
                    <br>En caso de que existan dos o mas eventos que choquen en los horarios, el lugar se le asignará al primero que pague.
                    </p>
					<div class="col-md-4 col-sm-12  "></div>
					<div class="col-md-4 col-sm-12  ">
						<input type="submit" name="" class="btn btn-primary" value="Acepto los términos y condiciones">
					</div>
					<div class="col-md-4 col-sm-12  "></div>

                </div>
			</div>
		</div>
	</div>
</form>
</div>
<script type="text/javascript">

let fechasYHorasOcupadas=[];

function Busc_Evento(){
	var evento=$('#nombreEvento').val();
	var espacio=$('#espacio').val();

	document.getElementById("Fechas").value=" ";
	document.getElementById("HoraIs").value=" ";
	document.getElementById("horaFs").value=" ";

	var aux;

	if (evento!="") {



		$.ajax({
			url:'{{route("eventoComp")}}',
			type:'GET',
			data:{evento,espacio},
			success: function(opciones)
			{
				if (opciones!="1") {

					$('#datosComp').html(opciones);
				}
			}

		});
		Busc_categoria();

		$.ajax({
			url:'{{route("buscarHoras")}}',
			type:'GET',
			data:{espacio},
			success: function(opciones){
				fechasYHorasOcupadas=opciones.split("#");
			}
		});
	}else{
		alert("Por favor primero escribe el nombre de tu evento");
	}

}

function Busc_categoria(){
	var espacio=$('#espacio').val();

	$.ajax({
		url: '{{route("BusCategoria")}}',
		type:'GET',
		data:{espacio},
		success: function(opciones)
		{

			$("#categotiaComp").html(opciones);


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

function remove_Compo(id){
	var categoriaUS="";
	var componenteUS="";
	var costoUS="";
	var cantidadUS="";


	var cont=0;

	while(true){

		if (document.getElementById("UsarCatego_"+cont))
		{
			if (cont!=id) {
				categoriaUS+= document.getElementById("UsarCatego_"+cont).value + ', ';
				componenteUS+= document.getElementById("UsarCompo_"+cont).value + ', ';
				costoUS+= document.getElementById("UsarCosto_"+cont).value + ', ';
				cantidadUS+= document.getElementById("UsarCantidad_"+cont).value + ', ';

			}
		}else {

			break;
		}
		cont++;

	}

	$.ajax({
		url: '{{route("quitComponente")}}',
		type:'GET',
		data:{categoriaUS, componenteUS, cantidadUS, costoUS},
		success: function(opciones)
		{
			$("#datosComp").html(opciones);
		}
	});
}

function add_comp(){
	var espacio=$('#espacio').val();
	var evento=$('#nombreEvento').val();
	var categoria=$('#categotiaComp').val();
	var componente=$('#componente').val();
	var cantidadUsar=$('#necesarios').val();

	var categoriaUS="";
	var componenteUS="";
	var costoUS="";
	var cantidadUS="";

	var cont=0;

	while(true){

		if (document.getElementById("UsarCatego_"+cont))
		{
			categoriaUS+= document.getElementById("UsarCatego_"+cont).value + ', ';
			componenteUS+= document.getElementById("UsarCompo_"+cont).value + ', ';
			costoUS+= document.getElementById("UsarCosto_"+cont).value + ', ';
			cantidadUS+= document.getElementById("UsarCantidad_"+cont).value + ', '


		}else {

			break;
		}
		cont++;

	}

	$.ajax({
		url: '{{route("addComponente")}}',
		type:'GET',
		data:{espacio, evento, categoria, componente, cantidadUsar, categoriaUS, componenteUS, cantidadUS, costoUS},
		success: function(opciones)
		{
			$("#datosComp").html(opciones);
		}
	});

	Busc_categoria();
	Busc_componente();
	Busc_cantidad();
}

/**
	configurando el datePicker
*/
$('.form_date').datetimepicker({
	language: 'en',
	weekStart: 1,
	todayBtn: 1,
	autoclose: 1,
	todayHighlight: 1,
	startView: 2,
	minView: 2,
	daysOfWeekDisabled: '0,6',
	forceParse: 0
});


/**
	este metodo dice en que dia va a empezar
	este metodo se manda a traer antes de que se muestre el DatePicker
*/
$('.form_date').datetimepicker().on('show', function(ev) {

	let hoy = new Date();


	switch (hoy.getDay()) {
		case 0://domingo debe llegar al dia miercoles
			hoy.setDate(hoy.getDate() + 4);
			break;
		case 1://lunes debe llegar al dia jueves

			hoy.setDate(hoy.getDate() + 4);
			break;
		case 2://martes debe llegar al dia viernes

			hoy.setDate(hoy.getDate() + 4);
			break;
		case 3://miercoles debe llegar al dia lunes

			hoy.setDate(hoy.getDate() + 6);
			break;
		case 4://jueves debe llegar al dia martes

			hoy.setDate(hoy.getDate() + 6);
			break;
		case 5://viernes debe llegar al dia miercoles

			hoy.setDate(hoy.getDate() + 6);
			break;
		case 6://sabado debe llegar al dia jueves

			hoy.setDate(hoy.getDate() + 5);
			break;
	}
	let empezar=hoy.getFullYear()+"-"+(hoy.getMonth()+1)+"-"+hoy.getDate();



	$('.form_date').datetimepicker('setStartDate', empezar);
});


/**
	este metodo da acceso a los demas pickers
	este metodo se manda a traer cuando el datePicker se oculta
*/
$('.form_date').datetimepicker().on('hide', function(ev) {

	let fechar = $('#Fecha').val();
	let DisablehoursInicio=[0, 1, 2, 3, 4, 5, 6, 21,22, 23];//deshabilita horas en que PUEDE empezar el evento
	let DisablehoursFin=[0, 1, 2, 3, 4, 5, 6, 22, 23];//deshabilita horas en que PUEDE terminar el evento
	let fechasHor=[[]];//tendra una tabla donde las columnas son: fecha, HoraInicio,HoraFinal
	let indices=[];//va a tener los index de la primera columna de fechasHor para saber las fechas coinidentes
	let existeFecha=false;//revisa si la fecha seleccionada esta en el arreglo fechasHor

	for (var i = 0; i < fechasYHorasOcupadas.length-1; i++) {
		var x=fechasYHorasOcupadas[i].split(" ");
		fechasHor[i]=x;
	}


	/*	for (var i = 0; i < fechasHor.length; i++) {
		for (var j = 0; j < 3; j++) {
			switch (j) {
				case 0:
					alert("fecha: "+fechasHor[i][j]);
					break;
				case 1:
					alert("Hora de inicio: "+fechasHor[i][j]);
					break;
				case 2:
					alert("Hora de fin: "+fechasHor[i][j]);
					break;

			}
		}
	}*/


	//solo se les da acceso a los demas pickers si es que seleccionaron fecha
	if (fechar!="") {
		//configurando los timePickers
		$('.form_time1').datetimepicker({
			language: 'en',
			weekStart: 1,
			todayBtn: 1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 1,
			minView: 0,
			maxView: 1,
			minuteStep: 60,
			forceParse: 0
		});
		$('.form_time2').datetimepicker({
			language: 'en',
			weekStart: 1,
			todayBtn: 1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 1,
			minView: 0,
			maxView: 1,
			minuteStep: 60,
			forceParse: 0
		});

		for (var i = 0; i < fechasHor.length; i++) {
			console.log(" aqui!"+fechasHor[i][1]);
			if ( typeof fechasHor[i][1]!="undefined") {

				fechasHor[i][1]=fechasHor[i][1].slice(0, 2);
				fechasHor[i][2]=fechasHor[i][2].slice(0, 2);
				if (fechasHor[i][0]==fechar) {
					indices.push(i);
					existeFecha=true;
				}

			}

		}



		if (existeFecha) {
			for (var i = 0; i < indices.length; i++) {
				//este for recorre el arreglo de indices para ver donde
				//estan las horas que estan apartadas para el dia seleccionado

				var ind=indices[i];


				var desde=(fechasHor[ind][1])-1;
				var hasta=parseInt(fechasHor[ind][2]);
				hasta=hasta+1;


				//este for empieza en la hora que termia el evento y termina en la hora que inicia el
				//evento esto para obtener el rango de horas utilizadas

				DisablehoursInicio.push(desde-1);
				for (var j = desde; j <= hasta; j++)
				{
					DisablehoursInicio.push(j);
					DisablehoursFin.push(j);
				}


			}
		}



		/**
			Se deshabilitan la hora que se seleciono como inicial y las anteriores a ella
			este metodo se manda a traer cuando el timepicker1 se oculta
		*/
		$('.form_time1').datetimepicker().on('hide', function(ev) {
			let hora= $('#HoraI').val();

			hora=hora.substring(0,2);

			//si tiene mas datos que el arreglo de inicio quiere decir que ya se habian deshabilitado algunas horas
			if (DisablehoursFin.length!=DisablehoursInicio.length+1) {

				for (var i = DisablehoursFin.length; i > DisablehoursInicio.length; i--) {
					DisablehoursFin.pop();
				}
			}


			for (var i = 6; i <= hora; i++) {
				DisablehoursFin.push(i);

			}

			//tambien debemos cuidar si el nuevo evento empieza antes que alguno de los eventos
			//ya apartados, no vaya a terminar despues de estos
			if (existeFecha) {
				for (var i = 0; i < indices.length; i++) {
					//este for recorre el arreglo de indices para ver donde
					//estan las horas que estan apartadas para el dia seleccionado

					var ind=indices[i];

					if (hora<fechasHor[ind][1]) {

						var desde=(fechasHor[ind][1])-1;
						var hasta=20;


						//este for empieza en la hora que termia el evento y termina en la hora que inicia el
						//evento esto para obtener el rango de horas utilizadas
						for (var j = desde; j <= hasta; j++)
						{
							DisablehoursInicio.push(j);
							DisablehoursFin.push(j);
						}

					}


				}
			}

			$('.form_time2').datetimepicker('setHoursDisabled', DisablehoursFin);
		});


		//deshabilita las horas segun el arreglo Disablehours
		$('.form_time1').datetimepicker('setHoursDisabled', DisablehoursInicio);
		$('.form_time2').datetimepicker('setHoursDisabled', DisablehoursFin);



	}
});





</script>
@endsection
