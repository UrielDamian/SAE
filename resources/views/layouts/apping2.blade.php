<?php
	$me=Session::get('me1');
	$ruta=Request::path();
	$esta=False;

	if ($ruta=='menu' or $ruta=='home' or $ruta='holitas') {
		$esta=True;
	}else{

		foreach ($me as $m) {
			if ($m['url']==$ruta) {
				$esta=True;
			}
		}
	}

	if ($esta) {
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/ingenieria.ico" type="image/ico" />


    <title>@yield('title')</title>




	<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

  	<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

  	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


	    <!-- Bootstrap -->
	    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	    <!-- Font Awesome -->
	    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	    <!-- NProgress -->
	    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
	    <!-- iCheck -->
	    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">

	    <!-- bootstrap-progressbar -->
	    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
	    <!-- JQVMap -->
	    <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>


	    <!-- Custom Theme Style -->
	    <link href="build/css/custom.min.css" rel="stylesheet">





		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
		<script src="http://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>


		<script type="text/javascript" src="js/bootstrap.min.js" charset="UTF-8"></script>
		<script type="text/javascript" src="js/datetimepicker.js" charset="UTF-8"></script>


































  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{route('home')}}" class="site_title"><span>Facultad de Ingenieria</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
				<div class="profile_pic">
					<center>
						<img src="images/ingenieria.jpg" alt="..." style="width:100px; margin: 0px 50px;" class="img-circle">
					</center>

              </div>

            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Opciones</h3>
                <ul class="nav side-menu">
					@foreach ($me  as $m)
						@if($m['nivel']==0)
						<li>
						<!--<a href="{{$m['url'] }}">-->
						<a href="#">
							 <i class="fa fa-edit"></i>
							 <span>{{$m['titulo'] }}</span>
							 <span class="fa fa-chevron-down"></span>
						 </a>
						@elseif ($m['nivel']==1 && $m['otro']=='a')
							<ul class="nav child_menu">
				    	@elseif ($m['nivel']==2)
				            <li><a href="{{$m['url'] }}"><i class="fa fa-circle-o"></i> {{$m['titulo'] }}</a></li>
				    	@elseif ($m['nivel']==1 && $m['otro']=='c')
				      		</ul>
							</li>
						@endif
					@endforeach
                </ul>
              </div>

              <div class="menu_section">
                <h3>comunes</h3>
                <ul class="nav side-menu">
					<li>
						<a href="#">
							<i class="fa fa-windows"></i> otro
							<span class="nav child_menu"></span>
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-windows"></i> Manual
							<span class="nav child_menu"></span>
						</a>
					</li>
					<li>
						<a href="{{ route('logout') }}"
							  	onclick="event.preventDefault();
							  document.getElementById('logout-form').submit();">Logout
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
					</li>

                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->


            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation-->
        <div class="top_nav">

              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>


        </div>
        <!-- /top navigation -->
		<div class="right_col" role="main">
          <div class="">
			  @yield('content')

		  </div>
	  </div>



		<footer>
		  <p style="width:200px; margin: 0px auto;">Sistema de espacios 2019</p>
		</footer>

        <!-- /footer content -->
      </div>
    </div>







    <!-- jQuery -->
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="vendors/Flot/jquery.flot.js"></script>
    <script src="vendors/Flot/jquery.flot.pie.js"></script>
    <script src="vendors/Flot/jquery.flot.stack.js"></script>
    <script src="vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>


	<!-- jQuery Smart Wizard -->
		<script src="vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>



  </body>
</html>

<?php
}else {
	?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<a href="{{route('home')}}">No tienes acceso a esta pagina</a>
	</body>
</html>
	<?php
} ?>
