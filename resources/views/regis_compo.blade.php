<h4>registrar usuario</h4>
<form id="registrar_con" method="post" action="{{URL::to('/')}}/insertar_con">
  {{ csrf_field() }}
  <div>
    <p>nombre</p>
    <input type="text" id="title" name="nombre" value="">
  </div>
   <div>
    <p>pass</p>
    <input type="text" id="title" name="cantidad" value="">
  </div>
 
  <div>
    <input type="submit" value="Save">
  </div>
</form>