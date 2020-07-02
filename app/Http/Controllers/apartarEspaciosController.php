<?php

namespace App\Http\Controllers;
use  Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Espacio;
use App\Evento;
use App\ComponenteXEspacio;
use Auth;
use App\SolicitudEspacio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApartandoEspacios;
use App\Mail\EnviandoSolitud;



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

    	//  $usuarios=Usuario::where("nombre",$request->Nombre);
    	//  echo $request->espacio;


      $apartar_espacio=new SolicitudEspacio;
      $apartar_espacio->id_usuario=$usuario->id;
      $apartar_espacio->id_espacio=$request->espacio;
      $apartar_espacio->fecha=$request->fecha;
      $apartar_espacio->horaInicio=$request->horaI;
      $apartar_espacio->horaFinal=$request->horaF;
      $apartar_espacio->save();

      echo "";
    }

	public function crearApartandoEspacio(Request $request)
	{
		$request->validate([
			'nombreEvento'=>'required',
			'DescEvento'=>'required',
			'espacio'=>'required',
			'Fecha'=>'required',
			'HoraI'=>'required',
			'HoraF'=>'required',
		],[

			'nombreEvento.required'=>'Se require nombre del evento',
			'DescEvento.required'=>'Se require descripción del evento',
			'espacio.required'=>'Debes seleccionar un espacio',
			'Fecha.required'=>'Debes seleccionar una fecha válida',
			'HoraI.required'=>'Debes seleccionar la hora en que empezará el evento',
			'HoraF.required'=>'Debes seleccionar la hora en que terminará el evento'
		]);


		$NombreEvento=$request->input("nombreEvento");
		$DescripcionEvento=$request->input("DescEvento");
		$espacio=$request->input("espacio");

		$existeEvento= DB::table('eventos')
					->where('espacio','=',$espacio)
					->where('Nombre','=',$NombreEvento)
					->exists();

		$evento=new Evento;

		if ($existeEvento==null) {

			$evento->Nombre=$NombreEvento;
			$evento->Descripcion = $DescripcionEvento;
			$evento->espacio = $espacio;
			$evento->nuevo="si";

			$apartar_espacio=new SolicitudEspacio;
	        $apartar_espacio->usuario=Auth::user()->id;

	        $apartar_espacio->fecha=$request->input("Fecha");
	        $apartar_espacio->horaInicio=$request->input("HoraI");
	        $apartar_espacio->horaFinal=$request->input("HoraF");


			DB::transaction(function() use ($apartar_espacio, $evento, $request) {
				$evento->save();

				$contador=0;
				while (True) {
					if ($request->input("UsarCompo_".$contador) == "") {
						break;
					}
					$ParaEvento= new ComponenteXEspacio;

					$cantidad=$request->input("UsarCantidad_".$contador);
					$costo=$request->input("UsarCosto_".$contador);


					$ParaEvento->Total=$cantidad*$costo;
					$ParaEvento->cantidadUsar=$cantidad;
					$ParaEvento->categoria=$request->input("UsarCatego_".$contador);
					$ParaEvento->nombreComponente =$request->input("UsarCompo_".$contador);
					$ParaEvento->evento=$evento->id;
					$ParaEvento->save();


					$contador++;
				}

				$apartar_espacio->even= $evento->id;
				$apartar_espacio->save();
			});


		}else{
			$auxEvento=DB::table('eventos')
						->where('espacio','=',$espacio)
						->where('Nombre','=',$NombreEvento)
						->first();

			$evento->id=$auxEvento->id;


			$apartar_espacio=new SolicitudEspacio;
	        $apartar_espacio->usuario=Auth::user()->id;

	        $apartar_espacio->fecha=$request->input("Fecha");
	        $apartar_espacio->horaInicio=$request->input("HoraI").":00";
	        $apartar_espacio->horaFinal=$request->input("HoraF").":00";


			DB::transaction(function() use ($apartar_espacio, $evento, $request) {

				$contador=0;
				while (True) {
					if ($request->input("UsarCompo_".$contador) == "") {
						break;
					}
					$ParaEvento= new ComponenteXEspacio;

					$cantidad=$request->input("UsarCantidad_".$contador);
					$costo=$request->input("UsarCosto_".$contador);


					$ParaEvento->Total=$cantidad*$costo;
					$ParaEvento->cantidadUsar=$cantidad;
					$ParaEvento->categoria=$request->input("UsarCatego_".$contador);
					$ParaEvento->nombreComponente =$request->input("UsarCompo_".$contador);
					$ParaEvento->evento=$evento->id;
					$ParaEvento->save();


					$contador++;
				}

				$apartar_espacio->even= $evento->id;
				$apartar_espacio->save();
			});


		}

		$mensaje="¡Se guardó tu solicitud!,enviaremos la confirmación al correro: ".Auth::user()->email;

		$this->crearPDF($request);

		Mail::to(Auth::user()->email)->send(new ApartandoEspacios());


		$Encargado=DB::table('espacios')
				   ->join("users","idencargado","=","id")
				   ->select('email')
				   ->where('ide','=',$espacio)
				   ->first();
		Mail::to($Encargado->email)->send(new EnviandoSolitud());


		return redirect('apartar')->with('mensaje',$mensaje);

	}


	private function crearPDF(Request $request){
		$meses=['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];

		$fecha=$request->input("Fecha");
		$fecha=explode('-',$fecha);

		$fecha[1]=(int)$fecha[1];

		$fechas=$fecha[2]." de ".$meses[$fecha[1]-1]." del ".$fecha[0];
		$espacio=$request->input("espacio");

		$esp=DB::table('espacios')
				   ->where('ide','=',$espacio)
				   ->select('nombreEspacio')
				   ->first();


		$aEnviar= array(
						'nombreEvento'=>strtolower($request->input("nombreEvento")),
						'DescEvento'=>strtolower($request->input("DescEvento")),
						'espacio'=>strtolower($esp->nombreEspacio),
						'Fecha'=>$fechas,
						'HoraI'=>$request->input("HoraI"),
						'HoraF'=>$request->input("HoraF"),
						'usuario'=>Auth::user()->name,
						'emailUs'=>Auth::user()->email

					);

		$contador=0;
		$i=0;
		$componentes=array();
		while (True) {
			if ($request->input("UsarCompo_".$contador) == "") {
				break;
			}
			$componentes[$i]=$request->input("UsarCatego_".$contador);
			$componentes[$i+1]=$request->input("UsarCompo_".$contador);
			$componentes[$i+2]=$request->input("UsarCantidad_".$contador);
			$contador++;
			$i+=3;
		//echo "<script>console.log( 'Esta categoria:".$componentes['categoria']."');</script>";
		}
		$pdf= PDF::loadView('pdfs.ApartarEspacio', compact("aEnviar","componentes"));


		$rutaGuardado = "FilePdfs/";
		//Nombre del Documento.
		$nombreArchivo ="Solicitud.pdf";

		//$pdf->render();
		$output = $pdf->output();


		file_put_contents( $rutaGuardado.$nombreArchivo, $output);
		$pdf2= PDF::loadView('pdfs.SolicitudApartar', compact("aEnviar", "componentes"));

		$rutaGuardado="FilePdfs/";
		$nombreArchivo="Peticion.pdf";
		$output=$pdf2->output();
		file_put_contents( $rutaGuardado.$nombreArchivo, $output);

	}


}
