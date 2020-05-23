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


	public function MostrarComponentes(Request $request){

		$espacio=$request->input('espacio');
		$evento=$request->input('evento');

		$componentes= DB::table('eventos')
			->join('espacios','espacio','=',"ide")
			->join('componente_x_espacios','eventos.id',"=",'componente_x_espacios.evento')
			->select('espa_componentes.cantidad', 'espa_componentes.precio', 'componentes.categoria', 'componentes.nombreComponente')
			->where('espacios.ide', '=', $espacio)
			->get();

		$opciones="";
		/*foreach ($componentes as $c ) {
			$opciones.=$c->cantidad."<br>";
		}
		$opciones.="<br>------------------<br>";*/
		$opciones.='<thead>
			<tr>
				<th>Categoria</th>
				<th>Componente</th>
				<th>Cantidad a usar</th>
				<th>Cantidad existente</th>
			</tr>
		</thead><tbody>';
		$contador=0;
		foreach ($componentes as $comp) {
			$opciones.='<tr>
							<td>
								<input  title="falllllll" type="text" class="form-control uppercase"  id="categoria'.$contador.'" name="categoria'.$contador.'"  value="'.$comp->categoria.'" readonly >
							</td>
							<td>
								<input  title="falllllll" type="text" class="form-control uppercase"  id="componente'.$contador.'" name="componente'.$contador.'"  value="'.$comp->nombreComponente.'" readonly >
							</td>
							<td>
								<input  title="falllllll" type="text" class="form-control uppercase"  id="necesita'.$contador.'" name="necesita'.$contador.'"  value="0" required >
							</td>
							<td>
								<input  title="falllllll" type="text" class="form-control uppercase"  id="cantidad'.$contador.'" name="cantidad'.$contador.'"  value="'.$comp->cantidad.'"  readonly>
							</td>


						</tr>';
						$contador++;
		}


		$opciones.='</tbody>';
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

			$opciones='<div class="row" id="show">

				<div class="col-md-4 col-sm-12">
					<label for="categotiaComp">Elige una categoria</label>
					<select class="form-control form-control-sm" id="categotiaComp" onchange="Busc_componente();">
						<option disabled selected>Elige una categoria</option>
					</select>
				</div>

				<div class="col-md-3 col-sm-12">
					<label for="componente">Elige un componente</label>
					<select class="form-control form-control-sm" id="componente" onchange="Busc_cantidad();">';

			$opciones.="<option disabled selected>Elige una categoria</option>";

			foreach ($categoria as $catego) {
				$opciones.="<option>$catego->categoria</option>";
			}

			$opciones.='	</select>
			</div>

			<div class="col-md-3 col-sm-12">
				<label for="necesarios">Elige cuantos necesitaras</label>
				<select class="form-control form-control-sm" id="necesarios">
					<option disabled selected>Elige cuantos usaras</option>
				</select>
			</div>

			<div class="col-md col-sm-12">

				<button type="button" class="btn btn-info btn-lg glyphicon glyphicon-plus-sign" style="height: 40px; margin-top: 15px;">Add</button>

			</div>
		</div>';
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
		for ($i=0; $i <=$canti; $i++) {
			$opciones.="<option>$i</option>";
		}

		echo $opciones;
	}
}
