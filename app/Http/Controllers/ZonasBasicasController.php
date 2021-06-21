<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\ZonasBasicas;
use App\Models\Local;
use GuzzleHttp\Client;
Use app\http\controllers\ZonasBasicasController;

class ZonasBasicasController extends Controller
{

    public function index(){
        $bar = DB::select("SELECT * from local where tipo_local='Bar' and estado='Activo' order by visitas asc limit 5");
        $restaurante =DB::select("SELECT * from local where tipo_local='Restaurante' and estado='Activo' order by visitas asc limit 10");

        return view('layouts.general')->with('data',['bar' => $bar, 'restaurante' => $restaurante]);
    }
    
    public function recibirForm (Request $request){
        $tipoLocal=$request->get('tipo_local');
        $zona=$request->get('cod_salud');
        $terraza=$request->get('terraza');
        $paraLlevar=$request->get('para_llevar');
        $vegano=$request->get('vegano');
        $oferta=$request->get('oferta');
        $alergenos=$request->get('alergenos');
        $tipoComida=$request->get('tipo_comida');
        
       /*$request->validate([
            'cod_salud'=>'required',
            'tipo_local'=>'required',
        ]);*/
      
      $sql = DB::table('local')
            ->select("*")
            ->where('tipo_local','LIKE',$tipoLocal)
            ->where('cod_salud','LIKE',$zona)
            ->where('terraza','LIKE',$terraza)
            ->where('para_llevar','LIKE',$paraLlevar)
            ->where('vegano','LIKE',$vegano)
            ->where('oferta','LIKE',$oferta)
            ->where('carta_alerg','LIKE',$alergenos)
            ->where('tipo_comida','LIKE',$tipoComida)
            ->where('estado','LIKE',"Activo")
            ->paginate(10);

        $client = new Client();
        $response = Http::get('https://datos.comunidad.madrid/catalogo/api/action/datastore_search?id=f22c3f43-c5d0-41a4-96dc-719214d56968&fields=_id,municipio_distrito,fecha_informe,casos_confirmados_ultimos_14dias,tasa_incidencia_acumulada_ultimos_14dias');
        $response->json();

       return view('layouts.local', ['sql'=>$sql])->with('respuesta', $response['result']['records']);
    }
}