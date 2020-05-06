<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class Usuario_c extends Controller
{
	private $idus=0;

	public function __construct(){
        $this->middleware('auth');
    }

	public function index(){
        $idus=\Auth::user()->id;
    }


	public function menu(){
       return view('home');
   }

   public function menux(){
	   $menu = \DB::table('us_rec')
                     ->leftJoin('recursos', function($join)
                         {
                             $join->on('us_rec.idrec', '=', 'recursos.id');

                         })
                    ->leftJoin('opcionesm', function($join)
                         {
                             $join->on('recursos.opPadre', '=', 'opcionesm.id');

                         })

                      ->where('us_rec.idUs','=', \Auth::user()->id)
                     ->get();
		//construimos el menu
		$menuoki = array();

		$op ="0";
		$ophijo=1;//0:abierto 1:cerrado
		foreach($menu as $detalle)
		{
			if ($detalle->opPadre =! $op){
				if($ophijo===0){
					//------------indica que inicia un hijo--- nivel = 1
 					$opcion = array(
						"nivel" => '1',
      					"icono" => "x",
      					"titulo" => "x",
      					"url" =>'',
      					"otro" => 'c'
      				);

					$menuoki []= $opcion;
					//----------fin dw hijo-------------------
					$ophijo=1;
				}

				$opcion = array(
					"nivel" => '0',
      				"icono" => $detalle->icono,
      				"titulo" => $detalle->opcionMenu,
      				"url" =>'',
      				"otro" => '0'
      			);

				$op = $detalle->opPadre;

    			//$menuoki = array_push($menuoki,$opcion);

     			$menuoki []= $opcion;


				if($ophijo===1){

					//------------indica que inicia un hijo--- nivel = 1
 					$opcion = array(
						"nivel" => '1',
      					"icono" => "x",
      					"titulo" => "x",
      					"url" =>'',
      					"otro" => 'a'
      				);

					$menuoki []= $opcion;
					$ophijo=0;

					//----------fin dw hijo-------------------
				}
			}

			$opcion = array(
				"nivel" => '2',
      			"icono" => $detalle->icono,
      			"titulo" => $detalle->TituloOpcion,
      			"url" =>$detalle->url,
      			"otro" => '0'
      		);

			$op = $detalle->opPadre;
			$menuoki []= $opcion;
		}

		//------------indica que inicia un hijo--- nivel = 1
		$opcion = array(
			"nivel" => '1',
			"icono" => "x",
      		"titulo" => "x",
      		"url" =>'',
      		"otro" => 'c'
      	);

		$menuoki []= $opcion;
		//----------fin dw hijo-------------------

		return view('menux')->with('me',$menuoki);
		// return view('layouts.appIng')-> with('me', $menuoki);
	}


}
