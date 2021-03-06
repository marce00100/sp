<?php

namespace App\Http\Controllers\ModuloPlanificacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PruebaController extends Controller
{
    /* Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
       // $this->middleware('auth');
       $this->middleware(function ($request, $next) {
       $this->user= \Auth::user();
       $rol = (int) $this->user->id_rol;
       $sql = \DB::select("SELECT  m.* FROM roles_modulos um INNER JOIN modulos m ON um.id_modulo = m.id WHERE um.id_rol = ".$rol." ORDER BY orden ASC");
       $this->modulos = array();
       foreach ($sql as $mn) {
           array_push($this->modulos, array('id' => $mn->id,'titulo' => $mn->titulo,'descripcion' => $mn->descripcion,'url' => $mn->url,'icono' => $mn->icono,'id_html' => $mn->id_html));
       }


       $sql = \DB::select("SELECT m.* FROM menus m INNER JOIN roles_menu rm ON m.id = rm.id_menu WHERE rm.id_rol = ".$rol." AND id_modulo = 31 AND activo = true ORDER BY m.orden ASC");
       $this->menus = array();
       foreach ($sql as $mn) {

           $submenu = \DB::select("SELECT * FROM sub_menus WHERE id_menu = ".$mn->id." AND activo = true ORDER BY orden ASC");
           array_push($this->menus, array('id' => $mn->id,'titulo' => $mn->titulo,'descripcion' => $mn->descripcion,'url' => $mn->url,'icono' => $mn->icono,'id_html' => $mn->id_html,'submenus' => $submenu));
       }



       \View::share(['modulos'=> $this->modulos,'menus'=>$this->menus]);



       return $next($request);

       });

   }
   public function index()
   {
     return view('ModuloPlanificacion.prueba');
   }

   public function res()
   {
     return view('ModuloPlanificacion.res');
   }
      public function tablero_()
   {
     return \View::make('ModuloPlanificacion.tablero_')->render();
   }
      public function gestion_proyectos_pdes_()
   {
     return \View::make('ModuloPlanificacion.gestion_z')->render();
   }
}
