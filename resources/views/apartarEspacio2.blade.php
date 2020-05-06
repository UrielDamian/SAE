@extends('layouts.appIng')
@section('title', 'bienvenidos')
@section('content')

<script type="text/javascript">
  function insertar(){
    var nombre = $('#Nombre').val();
    var email=$('#email').val();
    var espacio=$('#espacio').val();
    var fecha=$('#fecha').val();
    var horaI=$('#horaI').val();
    var horaF=$('#horaF').val();

    if(nombre!="" && email!="" && espacio!="" && fecha!="" && horaI!="" && horaF!=""){


    $.ajax(
      {
          url:"{{ route('crearSolicitud') }}",
          type: "get",
          data : {nombre,email,espacio,fecha,horaI,horaF},
          success: function(opciones){
            $("#tla").html(opciones);
      }
    })

  alert("Le mandaremos su orden de pago a su correo cuando sea aceptada su solicitud");
}else{
  alert("POR FAVOR LLENE TODOS LOS CAMPOS");
}
  }
</script>


<div class="card" style="width: 50rem;">
  <table border="1">
  <thead>
  <div class="form-row">
    <div class="col">
      Lunes
    </div>
    <div class="col">
    Martes
    </div>
    <div class="col">
    Miercoles
    </div>
    <div class="col">
    Jueves
    </div>
    <div class="col">
    Sabado
    </div>
    <div class="col">
    Domingo
    </div>
  </div>
</thead>
<tbody>
  <tr>

    <div class="form-row">
      <td>
      <div class="col">
      1
    </div></td><td>
      <div class="col">
      2
      </div></td><td>
      <div class="col">
      3
      </div></td><td>
      <div class="col">
      4
      </div></td><td>
      <div class="col">
      5
      </div></td><td>
      <div class="col">
      6
      </div></td><td>
    </div>
  </tr>
  <tr>

    <div class="form-row">
      <td>
      <div class="col">
      1
    </div></td><td>
      <div class="col">
      2
      </div></td><td>
      <div class="col">
      3
      </div></td><td>
      <div class="col">
      4
      </div></td><td>
      <div class="col">
      5
      </div></td><td>
      <div class="col">
      6
      </div></td><td>
    </div>
  </tr>
  <tr>

    <div class="form-row">
      <td>
      <div class="col">
      1
    </div></td><td>
      <div class="col">
      2
      </div></td><td>
      <div class="col">
      3
      </div></td><td>
      <div class="col">
      4
      </div></td><td>
      <div class="col">
      5
      </div></td><td>
      <div class="col">
      6
      </div></td><td>
    </div>
  </tr>
  <tr>

    <div class="form-row">
      <td>
      <div class="col">
      1
    </div></td><td>
      <div class="col">
      2
      </div></td><td>
      <div class="col">
      3
      </div></td><td>
      <div class="col">
      4
      </div></td><td>
      <div class="col">
      5
      </div></td><td>
      <div class="col">
      6
      </div></td><td>
    </div>
  </tr>
  <tr>

    <div class="form-row">
      <td>
      <div class="col">
      1
    </div></td><td>
      <div class="col">
      2
      </div></td><td>
      <div class="col">
      3
      </div></td><td>
      <div class="col">
      4
      </div></td><td>
      <div class="col">
      5
      </div></td><td>
      <div class="col">
      6
      </div></td><td>
    </div>
  </tr>
</tbody>
</table>
</div>
@endsection
