<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Espacio;

class apartarEspaciosController extends Controller
{
	//

    public function apartar()
    {

        $espacios=Espacio::all();

        return view ("apartarEspacio",compact("espacios"));
    }


    public function insertar(Request $request)
    {
      $usuario=new Usuario;
      $usuario->nombre=$request->nombre;
      $usuario->email=$request->email;
      $usuario->save();

    //  $usuarios=Usuario::where("nombre",$request->Nombre);
    //  echo $request->espacio;


      $apartar_espacio=new EspacioSolicitado;
      $apartar_espacio->id_usuario=$usuario->id;
      $apartar_espacio->id_espacio=$request->espacio;
      $apartar_espacio->fecha=$request->fecha;
      $apartar_espacio->horaInicio=$request->horaI;
      $apartar_espacio->horaFinal=$request->horaF;
      $apartar_espacio->save();

      echo "";
    }


}
