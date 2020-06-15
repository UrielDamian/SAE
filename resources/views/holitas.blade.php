@extends('layouts.apping2')
@section('title', 'Apartando')

@section('content')


<!--<form class="form" onSubmit="test(); return false;">-->
<form class="form" action="{{ route('holitasTest') }}">
	{{csrf_field()}}

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

							<div class="col-md-4 col-sm-12 ">
								Elige el dia y la duracion de horas
								<fieldset>
                            		<div class="control-group">
                              			<div class="controls">
                                			<div class="input-prepend input-group">
                                  				<span class="add-on input-group-addon fa fa-calendar-o"></span>
                                  				<input type="text" name="reservation-time" id="reservation-time" class="form-control"s/>
                                			</div>
                              			</div>
                            		</div>
                          	</fieldset>

							</div>
							<div class="col-md-6 col-sm-12  form-group">
								<label for="emailUsusario"> Email</label>
								<input class="form-control" type="email" placeholder="{{Auth::user()->email}}" readonly name="emailUsusario" >
							</div>

						</div>


					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="x_panel">
		<div class="x_title">
			<h2>Componentes utilizados anteriormente</h2>
			<ul class="nav navbar-right panel_toolbox">
				<li>
					<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
				</li>
				<li class="dropdown">
					<a><i></i></a>
				</li>
				<li>
					<a class="close-link"><i class="fa fa-close"></i></a>
				</li>
			</ul>

			<div class="clearfix"></div>
		</div>

		<div class="x_content">
			<div class="row">
				<div class="col-sm-12">
					<div class="card-box table-responsive">


						<div class="col-md-4 col-sm-12">
							<label for="Fecha">Date Picking</label>
							<div class="input-group date form_date " data-date="" data-date-format="dd MM yyyy" data-link-field="Fecha" data-link-format="dd/mm/yyyy">

								<input class="form-control" type="text" value="" readonly>
								<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
							</div>
							<input type="hidden" id="Fecha" value="" /><br />
						</div>

						<div class="col-md-4 col-sm-12">


							<label for="HoraI">Time Picking</label>
							<div class="input-group date form_time1 " data-date="" data-date-format="hh:ii" data-link-field="HoraI" data-link-format="hh:ii">

								<input class="form-control" type="text" value="" readonly>
								<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
							</div>
							<input type="hidden" id="HoraI" value="" /><br />

						</div>

						<div class="col-md-4 col-sm-12">


							<label for="HoraF">Time Picking</label>
							<div class="input-group date form_time2 " data-date="" data-date-format="hh:ii" data-link-field="HoraF" data-link-format="hh:ii">

								<input class="form-control" type="text" value="" readonly>
								<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
							</div>
							<input type="hidden" id="HoraF" value="" /><br />

						</div>




							<button type="button" class="btn btn-info btn-lg glyphicon glyphicon-plus-sign"  onclick="test();">Agregar</button>


					</div>
				</div>
			</div>
		</div>
	</div>
</form>


<script type="text/javascript">

	let Disablehours=[0, 1, 2, 3, 4, 5, 6, 22, 23];

	$('.form_datetime').datetimepicker({
		//language:  'fr',
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
		showMeridian: 1
	});

	$('.form_date').datetimepicker({
		language: 'en',
	//	format: 'dd/mm/yyyy',
	    weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		daysOfWeekDisabled: '0,6',
		forceParse: 0
	});

	$('.form_time1').datetimepicker({
		language: 'en',
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		minuteStep: 30,
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
		minuteStep: 30,
		forceParse: 0
	});

	$('.form_time1').datetimepicker().on('hide', function(ev) {

		Disablehours.push(10);
		$('.form_time2').datetimepicker('setHoursDisabled', Disablehours);
	});

	$('.form_time1').datetimepicker('setHoursDisabled', Disablehours);
	$('.form_time2').datetimepicker('setHoursDisabled', Disablehours);









	function test() {

		var usuario = $('#Fecha').val();

		alert("la fecha es: " + usuario);
	}
</script>




@endsection
