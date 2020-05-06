<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class premisosController extends Controller
{
	//

    public function darPermisos() {
       $recu=DB::select("SELECT id,TituloOpcion FROM recursos");
       $usu=DB::select("SELECT id, name FROM users");
       //$juntos=array_merge($recu,$usu);
       return View("Permisos",compact("recu","usu"));

     }


     public function asignar(Request $request)
     {

       $usuario=$request->input("usuario");
       $recursos=$request->input("selected");

       $opciones="";

       $recursos=explode(",",$recursos);

       for ($i=0; $i <count($recursos)-1 ; $i++) {
         DB::insert("insert into us_recs (idUs,idrec) values(?,?)",[$usuario,$recursos[$i]]);
         // code...
       }

       $recurso=DB::select("SELECT idUS,idrec,u.name,r.TituloOpcion FROM users u , recursos r, us_recs WHERE idUS=u.id and idrec=r.id and idUs=?",[$usuario]);

       $i=0;
       foreach ($recurso as $res) {
        // code...
        if($i==0){
          $opciones.="<thead><td colspan=2>$res->name</td></thead>";
          $i=1;
        }
        $opciones.="<tr>";
       // $opciones.="<td>$res->name</td>";
        $opciones.="<td>$res->TituloOpcion</td>";
        $aux="$res->idUS:$res->idrec";
        $opciones.='<td>  <input class="form-check-input" type="checkbox" name="recurso[]" value='.$aux.'></input></td>';
        $opciones.="</tr>";

       }

       echo $opciones;
    }


    public function quitar(Request $request)
    {

      $recursos=$request->input("selected");

      $opciones="";
      $recursos=explode(",",$recursos);
    //  $opciones.="<tr><td>".count($recursos)."</tr></td>";
      $usuario=explode(":",$recursos[0]);
      $usuario=$usuario[0];


      for ($i=0; $i <count($recursos)-1; $i++) {
        $aux=explode(":",$recursos[$i]);
        $aux=$aux[1];
        DB::delete("DELETE FROM us_recs where idUs=? and idrec=?",[$usuario,$aux]);
      }

      $recurso=DB::select("SELECT idUS,idrec,u.name,r.TituloOpcion FROM users u , recursos r, us_recs WHERE idUS=u.id and idrec=r.id and idUs=?",[$usuario]);

      $i=0;
      foreach ($recurso as $res) {
       // code...
       if($i==0){
         $opciones.="<thead><td colspan=2>$res->name</td></thead>";
         $i=1;
       }
       $opciones.="<tr>";
       $opciones.="<td>$res->TituloOpcion</td>";
       $aux="$res->idUS:$res->idrec";
       $opciones.='<td>  <input class="form-check-input" type="checkbox" name="recurso[]" value='.$aux.'></input></td>';
       $opciones.="</tr>";

      }

      echo $opciones;
   }




    public function mostrar(Request $request){
      $us=$request->input("usuario");
      $opciones="";

      $recurso=DB::select("SELECT idUS,idrec,u.name,r.TituloOpcion FROM users u , recursos r, us_recs WHERE idUS=u.id and idrec=r.id and idUs=?",[$us]);

      $i=0;
      foreach ($recurso as $res) {
       // code...
       if($i==0){
         $opciones.="<thead><td colspan=2>$res->name</td></thead>";
         $i=1;
       }
       $opciones.="<tr>";
      // $opciones.="<td>$res->name</td>";
       $opciones.="<td>$res->TituloOpcion</td>";
       $aux="$res->idUS:$res->idrec";
       $opciones.='<td>  <input class="form-check-input" type="checkbox" name="recurso[]" value='.$aux.'></input></td>';
       $opciones.="</tr>";

     }

     echo $opciones;
    }
}
