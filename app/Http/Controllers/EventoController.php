<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

	public function test(Request $request){

	}

	public function MostrarComponentes(Request $request){

		$opciones="";
		$espacio=$request->input('espacio');
		$evento=$request->input('evento');


		$existeEvento= DB::table('eventos')
					->where('espacio','=',$espacio)
					->where('Nombre','=',$evento)
					->exists();



		if ($existeEvento!=null) {
			$existeEvento= DB::table('eventos')
						->select('id')
						->where('espacio','=',$espacio)
						->where('Nombre','=',$evento)
						->first();

			$evento=$existeEvento->id;

			$tieneCompo= DB::table('componente_x_evento')
						->where('evento','=',$evento)
						->exists();

			if ($tieneCompo) {

				$opciones="1";
				$componentes= DB::table('componente_x_evento')
					->select('cantidadUsar',
							'categoria',
							'Total',
							'nombreComponente')
					->where('evento', '=', $evento)
					->get();

				$contador=0;
				foreach ($componentes as $comp) {
					$costo=$comp->Total/$comp->cantidadUsar;
					$opciones.="
					<th>
						<input type='text' class='form-control' readonly name='UsarCatego_$contador' id='UsarCatego_$contador' value='$comp->categoria'>
					</th>
					<th>
						<input type='text'  class='form-control' readonly name='UsarCompo_$contador' id='UsarCompo_$contador' value='$comp->nombreComponente'>
					</th>
					<th>
						<input type='text'  class='form-control' readonly name='UsarCantidad_$contador' id='UsarCantidad_$contador' value='$comp->cantidadUsar'>
					</th>
					<th>
						<input type='text'   class='form-control' readonly name='UsarCosto_$contador' id='UsarCosto_$contador' value='$costo'>
					</th>
					<th>
						<a href='#' class='fa fa-remove btn btn-xs btn-primary remove' onclick='remove_Compo($contador);'><i class='glyphicon'></i> Borrar</a>'
					</th>";
					$contador++;
				}
			}

		}
		echo $opciones;
	}

	public function MostrarCategoria(Request $request){

		$espacio=$request->input('espacio');

		$categoria= DB::table('espa_componentes')
			->join('espacios','espacio_id','=',"ide")
			->join('componentes','espa_componentes.compont_id',"=",'componentes.id')
			->select( 'componentes.categoria')
			->where('espacios.ide', '=', $espacio)
			->groupBy('componentes.categoria')
			->get();

			$opciones='
				';

			$opciones.="<option disabled selected>Elige una categoria</option>";

			foreach ($categoria as $catego) {
				$opciones.="<option>$catego->categoria</option>";
			}

			$opciones.='	';
		echo $opciones;
	}

	public function MostrarComp(Request $request){

		$espacio=$request->input('espacio');
		$categoria=$request->input('categoria');

		$comp= DB::table('espa_componentes')
			->join('espacios','espacio_id','=',"ide")
			->join('componentes','espa_componentes.compont_id',"=",'componentes.id')
			->select( 'componentes.nombreComponente')
			->where('espacios.ide', '=', $espacio)
			->where('componentes.categoria','=', $categoria)
			->get();

			$opciones="<option disabled selected>Elige un componente</option>";

			foreach ($comp as $compo) {
				$opciones.="<option>$compo->nombreComponente</option>";
			}
		echo $opciones;
	}

	public function MostrarCantidad(Request $request){

		$espacio=$request->input('espacio');
		$categoria=$request->input('categoria');
		$componente=$request->input('componente');
		if ($categoria=="" or $componente=="") {
			return "";
		}
		$cant= DB::table('espa_componentes')
			->join('espacios','espacio_id','=',"ide")
			->join('componentes','espa_componentes.compont_id',"=",'componentes.id')
			->select('cantidad')
			->where('espacios.ide', '=', $espacio)
			->where('componentes.categoria','=', $categoria)
			->where('componentes.nombreComponente','=', $componente)
			->first();

		$opciones="<option disabled selected>Elige cuantos usaras</option>";

		$canti=$cant->cantidad;
		for ($i=1; $i <=$canti; $i++) {
			$opciones.="<option>$i</option>";
		}

		echo $opciones;
	}

	public function addComponente(Request $request){


		$espacio=$request->input('espacio');
		$categoria=$request->input('categoria');
		$componente=$request->input('componente');
		$cantidadUsar=$request->input('cantidadUsar');

		$categoriaUS=$request->input('categoriaUS');
		$componenteUS=$request->input('componenteUS');
		$costoUS=$request->input('costoUS');
		$cantidadUS=$request->input('cantidadUS');

		$categoriaUS=explode(",", $categoriaUS,-1);
		$componenteUS=explode(",", $componenteUS,-1);
		$costoUS=explode(",", $costoUS,-1);
		$cantidadUS=explode(",",$cantidadUS,-1);


		$estaAgregado=False;
		$opciones="";

		if ($categoria=="" or $componente=="" or $cantidadUsar=="" or $espacio=="") {
			return "";
		}


		$contador=0;
		for ($i=0; $i < count($categoriaUS); $i++) {

			$categoriaUS[$i]=str_replace(" ","",$categoriaUS[$i]);
			$componenteUS[$i]=str_replace(" ","",$componenteUS[$i]);
			$cantidadUS[$i]=str_replace(" ","",$cantidadUS[$i]);
			$costoUS[$i]=str_replace(" ","",$costoUS[$i]);
			/*
			$aux=$categoriaUS[$i]==$categoria;
			$aux2=$componenteUS[$i]==$componente;


			echo "<script>console.log( 'Esta categoria:".$categoria."".$categoriaUS[$i]."".$aux."' );</script>";
			echo "<script>console.log( 'Esta componente:".$componente."".$componenteUS[$i]."".$aux2."' );</script>";
			*/
			if ($categoriaUS[$i]==$categoria && $componenteUS[$i]==$componente)
			{
				$cantidadUS[$i]=$cantidadUsar;
				$estaAgregado=True;
				//echo "<script>console.log( 'Esta agregado :".$estaAgregado."' );</script>";
			}

			$opciones.="
			<tr>
				<th>
					<input type='text' class='form-control' readonly name='UsarCatego_$contador' id='UsarCatego_$contador' value='$categoriaUS[$i]'>
				</th>
				<th>
					<input type='text'  class='form-control' readonly name='UsarCompo_$contador' id='UsarCompo_$contador' value='$componenteUS[$i]'>
				</th>
				<th>
					<input type='text'  class='form-control' readonly name='UsarCantidad_$contador' id='UsarCantidad_$contador' value='$cantidadUS[$i]'>
				</th>
				<th>
					<input type='text'   class='form-control' readonly name='UsarCosto_$contador' id='UsarCosto_$contador' value='$costoUS[$i]'>
				</th>
				<th>
					<a href='#' class='fa fa-remove btn btn-xs btn-primary remove' onclick='remove_Compo($contador);'><i class='glyphicon'></i> Borrar</a>
				</th>
			</tr>";

			$contador++;
		}

		if (!$estaAgregado) {

			$precio= DB::table('espa_componentes')
				->join('espacios','espacio_id','=',"ide")
				->join( 'componentes', 'espa_componentes.compont_id', "=" , 'componentes.id')
				->select('precio')
				->where('espacios.ide', '=', $espacio)
				->where('componentes.categoria','=', $categoria)
				->where('componentes.nombreComponente','=', $componente)
				->first();

			$opciones.="
			<tr>
				<th>
					<input type='text' class='form-control' readonly name='UsarCatego_$contador' id='UsarCatego_$contador' value='$categoria'>
				</th>
				<th>
					<input type='text'  class='form-control' readonly name='UsarCompo_$contador' id='UsarCompo_$contador' value='$componente'>
				</th>
				<th>
					<input type='text'  class='form-control' readonly name='UsarCantidad_$contador' id='UsarCantidad_$contador' value='$cantidadUsar'>
				</th>
				<th>
					<input type='text'   class='form-control' readonly name='UsarCosto_$contador' id='UsarCosto_$contador' value='$precio->precio'>
				</th>
				<th>
					<a href='#' class='fa fa-remove btn btn-xs btn-primary remove' onclick='remove_Compo($contador);'><i class='glyphicon'></i> Borrar</a>
				</th>
				</tr>";

		}

		echo $opciones;
	}

	public function quitComponente(Request $request){

		$categoriaUS=$request->input('categoriaUS');
		$componenteUS=$request->input('componenteUS');
		$costoUS=$request->input('costoUS');
		$cantidadUS=$request->input('cantidadUS');

		$categoriaUS=explode(",", $categoriaUS,-1);
		$componenteUS=explode(",", $componenteUS,-1);
		$costoUS=explode(",", $costoUS,-1);
		$cantidadUS=explode(",",$cantidadUS,-1);



		$contador=0;
		$opciones="";

		for ($i=0; $i < count($categoriaUS); $i++) {

			$categoriaUS[$i]=str_replace(" ","",$categoriaUS[$i]);
			$componenteUS[$i]=str_replace(" ","",$componenteUS[$i]);
			$costoUS[$i]=str_replace(" ","",$costoUS[$i]);
			$cantidadUS[$i]=str_replace(" ","",$cantidadUS[$i]);

			//echo "<script>console.log( 'estoy en el for' );</script>";
			$opciones.="
			<tr>
				<th>
					<input type='text' class='form-control' readonly name='UsarCatego_$contador' id='UsarCatego_$contador' value='$categoriaUS[$i]'>
				</th>
				<th>
					<input type='text'  class='form-control' readonly name='UsarCompo_$contador' id='UsarCompo_$contador' value='$componenteUS[$i]'>
				</th>
				<th>
					<input type='text'  class='form-control' readonly name='UsarCantidad_$contador' id='UsarCantidad_$contador' value='$cantidadUS[$i]'>
				</th>
				<th>
					<input type='text'   class='form-control' readonly name='UsarCosto_$contador' id='UsarCosto_$contador' value='$costoUS[$i]'>
				</th>
				<th>
					<a href='#' class='fa fa-remove btn btn-xs btn-primary remove' onclick='remove_Compo($contador);'><i class='glyphicon'></i> Borrar</a>
				</th>
			</tr>";

			$contador++;
		}

		echo $opciones;
	}


	public function HorasOcupadas(Request $request){

		$espacio=$request->input('espacio');
		$f=Date("Y-m-d");
		$fecha= Date("Y-m-d",strtotime($f."+ 4 days"));

		$horaFecha= DB::table('eventos')
			->join('solicitud_eventos','eventos.id','=',"even")
			->select( 'fecha','HoraInicio','HoraFinal')
			->where('espacio', '=', $espacio)
			->where('fecha','>=',$fecha)
			->OrderBy('fecha')
			->get();

		$auxFecha="";
		$cadena="";
		foreach ($horaFecha as $hor) {
			$cadena.="$hor->fecha $hor->HoraInicio $hor->HoraFinal #";
		}


		return $cadena;

	}
}
