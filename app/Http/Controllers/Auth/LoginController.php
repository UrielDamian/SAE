<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


public function login(Request $request)
    {


        $auth = Auth::attempt( $this->credentials($request));
        #tempt( $this->credentials($request), $request->has('remember')  )
        if ($auth )
        {
            //Obteniendo datos para la sesión


$menu = \DB::table('us_recs')
                     ->leftJoin('recursos', function($join)
                         {
                             $join->on('us_recs.idrec', '=', 'recursos.id');

                         })
                    ->leftJoin('opcionesm', function($join)
                         {
                             $join->on('recursos.opPadre', '=', 'opcionesm.id');

                         })

                      ->where('us_recs.idUs','=', \Auth::user()->id)
                      ->orderBy('opPadre','ASC')
                     ->get();


   //construimos el menu

                     $menuoki = array();


$op =0;
$ophijo=1;//0:abierto 1:cerrado
$i=0;
foreach($menu as $detalle)
{
  $i =$i+1;


  if ($detalle->opPadre == $op){


 }
 else{

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

 $op = $detalle->opPadre;
    $opcion = array(
      "nivel" => '0',
      "icono" => $detalle->icono,
      "titulo" => $detalle->opcionMenu,
      "url" =>"url",
      "otro" => $i
      );



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

    //$op = $detalle->opPadre;

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





            Session::put('me1', $menuoki );


            $this->sendLoginResponse($request);
            //return $recursos;
            return \redirect('/menu');
            //->with('message',"SUCCESSFUl");
        }
        else{

         Session::forget('me1');
            Session::flash('error','No fue posible iniciar sesión con los datos ingresados, ingrese los correctos o contacte al Admin del sistema.');
            return \redirect('/login');
        }
    }

}
