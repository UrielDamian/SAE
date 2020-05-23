<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Espacio;
use Auth;

class apartarEspaciosController extends Controller
{
	//

    public function apartar()
    {

        $espacios=Espacio::all();


        return view ("apartarEspacio3",compact("espacios"));
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

	public function pruebas(Request $request)
	{

		$user=Auth::user();
		$nose=$request->input('usuario');
		//echo "$user->id<br>";
		$opciones="<tr><td>$nose</td></tr>";

		echo $opciones;
	}


}
