<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;

use Illuminate\Http\Request;
use App\Espacio;
use App\User;
use Redirect,Response;

class Espacios_c extends Controller
{
	public function registrare(Request $request) {
  		Espacio::create($request->all());
	}

	public function in_espacio(Request $request)
	{

		$id = $request->input('id');
		$nom = $request->input('nom');
		$des = $request->input('des');
      	// $id = $_GET['id'];
      	// $nom = $_GET['nom'];
  		//$des = $_GET['des'];

		$objUs =  new Espacio();
		$objUs->idencargado = $id;
		$objUs->nombreEspacio =$nom;
		$objUs->desEspacio =$des;
		$objUs->created_at ="2019-01-01";
		$objUs->updated_at ="2019-01-01";
		$objUs->save();
	}

	public function getEspacios()
    {
		//$espacios = Espacio::select(['id','idencargado','nombreEspacio']);
		$espacios = \DB::table('espacios')
                     ->Join('users', function($join)
					 {
						$join->on('espacios.idencargado', '=', 'users.id');
					})
					->get();
					//$espacios = DB::select('select e.id,u.name,e.nombreEspacio
					//		 from espacios e
					//		 join users u on e.idencargado = u.id ');
					return Datatables::of($espacios)
					->addColumn('action', function($espacio){
						return '<a href="#" class="btn btn-xs btn-primary edit" id="'.$espacio->ide.'"><i class="glyphicon glyphicon-edit"></i> Edit</a>' . ' '.
                		'<a href="#" class="btn btn-xs btn-primary remove" id2="'.$espacio->ide.'"><i class="glyphicon glyphicon-remove"></i> borrar</a>'
						;})
					->make(true);

    }
	public function edit(Request $request)
	{
		$id = $request->input('ide');
		$espacios = \DB::table('espacios')
            ->where('ide', $id)
            ->update(['idencargado' => $request->input('ida')
            ,'nombreEspacio' => $request->input('espa')
            ,'desEspacio' => $request->input('desc')]);

		$success_output = '<div class="alert alert-success">Updated</div>';

		// return Response::json($success_output);
	}

	public function elimina(Request $request)
	{
		$id = $request->input('ide');
		$espacios = \DB::table('espacios')
            ->where('ide', $id)
            ->delete();

		$success_output = '<div class="alert alert-success">eliminado</div>';
		// return Response::json($success_output);
	}
	public function edit1(Request $request)
	{
		$id = $request->input('id');
    	$where = array('ide' => $id);
    	$user  = Espacio::where($where)->first();

    	return Response::json($user);
	}

	public function muestra_v(){
		$users = User::all();
		return view('r_espacios_v')->with('us',$users);

	}
}
