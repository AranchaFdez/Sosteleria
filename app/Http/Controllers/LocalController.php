<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Horario;
use App\Models\Local;
use App\Http\Controllers\ZonasBasicasController;

use Illuminate\Http\Request;

class LocalController extends Controller
{

    public function index(){

    }
    public function carta(){
        $currentURL = url()->full();
        $url=strrchr($currentURL,"/");
        $nif=substr( $url,1);
        $local=Local::findOrFail($nif);
        $id_carta=$local->id_carta;
        $id_horario=$local->id_horario;
        $tipo_local=$local->tipo_local;
        

        DB::table('local')->where('nif','LIKE',$nif)->increment("visitas", 1);

        $cat= DB::select("SELECT DISTINCT categoria_plato.* from categoria_plato, plato, carta 
        WHERE plato.id_cat_plato=categoria_plato.id_cat_plato AND plato.id_carta=carta.id_carta and carta.id_carta=$id_carta");

        $cat2= DB::select("SELECT DISTINCT categoria_bebida.* from categoria_bebida, bebida, carta 
        WHERE bebida.id_cat_bebida=categoria_bebida.id_cat_bebida AND bebida.id_carta=carta.id_carta and carta.id_carta=$id_carta");

        $platos=DB::select("SELECT  plato.* , categoria_plato.nombre_cat_plato from carta INNER JOIN plato on carta.id_carta=plato.id_carta JOIN categoria_plato
        on categoria_plato.id_cat_plato=plato.id_cat_plato where carta.id_carta=$id_carta");

        $bebidas=DB::select("SELECT  bebida.* , categoria_bebida.nombre_cat_bebida from carta INNER JOIN bebida on carta.id_carta=bebida.id_carta JOIN categoria_bebida
        on categoria_bebida.id_cat_bebida=bebida.id_cat_bebida where carta.id_carta=$id_carta");

        $menuPlato=DB::select("SELECT plato.*, menu.nombre_menu, menu.precio as preciom FROM `plato`, `menu_plato`, `menu`, `menu_carta` WHERE plato.id_plato=menu_plato.id_plato 
        and menu_plato.id_menu=menu.id_menu and menu.id_menu=menu_carta.id_menu and menu_carta.id_carta=$id_carta");
        
        $menuBebida=DB::select("SELECT bebida.* FROM `bebida`, `menu_bebida`, `menu`, `menu_carta` WHERE bebida.id_bebida=menu_bebida.id_bebida 
        and menu_bebida.id_menu=menu.id_menu and menu.id_menu=menu_carta.id_menu and menu_carta.id_carta=$id_carta");
        
        $horario=DB::select("SELECT * FROM `horario` WHERE id_horario=$id_horario");
        
        
        if($tipo_local=="Restaurante"){
            return view('layouts.restaurante')->with('local',$local)->with('platos',$platos)->with('bebidas',$bebidas)->with('cat',$cat)->with('cat2',$cat2)
            ->with('menuP',$menuPlato)->with('menuB',$menuBebida)->with('horario',$horario[0]);   
        }else{
            return view('layouts.bar')->with('local',$local)->with('platos',$platos)->with('bebidas',$bebidas)->with('cat',$cat)->with('cat2',$cat2)
            ->with('menuP',$menuPlato)->with('menuB',$menuBebida)->with('horario',$horario[0]);
        }
        
    }
    
}