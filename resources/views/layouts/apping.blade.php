<?php
	$me=Session::get('me1');
	$ruta=Request::path();
	$esta=False;

	if ($ruta=='menu' or $ruta=='home') {
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
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta content='IE=edge' http-equiv='X-UA-Compatible'/>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>

    <title>@yield('title')</title>



  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>


<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>



  </head>




  <body>



<aside class="sidebar-left">
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Facultad de Ingeniería</a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="sidebar-menu">
              <li class="header"> Opciones </li>





<li class="treeview">



    @foreach ($me  as $m)

   @if($m['nivel']==0)



           <a href={{$m['url'] }}>
                   <i class="fa fa-dashboard"></i> <span>{{$m['titulo'] }}</span>
                   <i class="fa fa-angle-left pull-right"></i>

          </a>

    @elseif ($m['nivel']==1 && $m['otro']=='a')
        <ul class="treeview-menu">
    @elseif ($m['nivel']==2)
            <li><a href="{{$m['url'] }}"><i class="fa fa-circle-o"></i> {{$m['titulo'] }}</a></li>
    @elseif ($m['nivel']==1 && $m['otro']=='c')
      </ul>
    </li>
<li class="treeview">

@endif

 @endforeach


              <li class="header">comunes</li>
              <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>otro</span></a></li>
              <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Manual</span></a></li>
              <li>

      <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>

               </li>
            </ul>
          </div>
          <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
      </nav>
    </aside>





    <div class='content container-fluid' style="background-color:#fafafa;">
      <div class="col-sm-12">
      <div class="jquery-script-ads" style="margin:0px auto;">

<script type="text/javascript"><!--
google_ad_client = "ca-pub-2783044520727903";
/* jQuery_demo */
google_ad_slot = "2780937993";
google_ad_width = 728;
google_ad_height = 20;
//-->
</script>

<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>


 @yield('content')




      <div class="col-sm-12">
        <footer>
          <p>Sistema de espacios 2019</p>
        </footer>
      </div>
    </div>
</div>




    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src='js/SidebarNav.min.js' type='text/javascript'></script>
  <script>
      $('.sidebar-menu').SidebarNav()
    </script>
    <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
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
