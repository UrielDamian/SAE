@extends('layouts.apping2')
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

<table id="tla">
</table>
<form>
  {{csrf_field()}}

    <div class="form-group">
      <input class="form-control" type="text" placeholder="NOMBRE O EMPRESA" name="Nombre" id="Nombre">
    </div>


    <div class="form-group">
     <label for="exampleInputEmail1">Email address</label>
     <input type="email" class="form-control"   aria-describedby="emailHelp"  placeholder="email" name="email" id="email">
     <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
   </div>
  <div class="form-group">
    <select class="form-control form-control-sm" id="espacio" name= "espacio">
            <option disabled selected>Elige un espacio</option>
        @foreach($espacios as $esp)
              <option value="{{$esp->ide}}">{{$esp->nombreEspacio}}</option>
        @endforeach
    </select>
</div>
  <div class="form-group">
<input type="date" class="form-control" placeholder="Elige la fecha"  name="fecha" id="fecha" >
<small id="emailHelp" class="form-text text-muted">Elige la fecha</small>
</div>

  <div class="form-group">
  <input type="time" class="form-control" name="horaI" id="horaI">
  <small id="emailHelp" class="form-text text-muted">Elige la hora de inicio</small>
</div>
<div class="form-group">
<input type="time" class="form-control" name="horaF" id="horaF" >
<small id="emailHelp" class="form-text text-muted">Elige la hora que terminara</small>
</div>
<div class="form-group">
<input type="submit" name="enviar" value="enviar"  onclick = "insertar();" class="btn btn-primary">
</div>

</form>

@endsection
