<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Local;
use App\Models\Horario;
use App\Models\Carta;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class clientController extends Controller
{
    public function index()
    {
        
         return view('layouts.client.index');
    }
    public function create(){
        return view('layouts.client.create');
    }

    public function store(Request $request){
        
        if($request->telf2==null && $request->web==null){
            $campos=[
                'nif'=>'required|string|max:9',
                'nombre_empresa'=>'required|string|max:100',
                'foto'=>'required|max:10000|mimes:jpeg,png,jpg',
                'tipo_local'=>'required|string|max:20',
                'telf1'=>'required|numeric|digits:9',
                'cp'=>'required|string|max:5',
                'direccion'=>'required|string|max:100',
            ];
        }elseif($request->telf2==null){
            $campos=[
                'nif'=>'required|string|max:9',
                'nombre_empresa'=>'required|string|max:100',
                'foto'=>'required|max:10000|mimes:jpeg,png,jpg',
                'tipo_local'=>'required|string|max:20',
                'telf1'=>'required|numeric|digits:9',
                'cp'=>'required|string|max:5',
                'direccion'=>'required|string|max:100',
                'web'=>'string|max:255',
            ];
        }elseif($request->web==null){
            $campos=[
                'nif'=>'required|string|max:9',
                'nombre_empresa'=>'required|string|max:100',
                'foto'=>'required|max:10000|mimes:jpeg,png,jpg',
                'tipo_local'=>'required|string|max:20',
                'telf1'=>'required|numeric|digits:9',
                'telf2'=>'numeric|digits:9',
                'cp'=>'required|string|max:5',
                'direccion'=>'required|string|max:100',
            ];
        }else{
            $campos=[
                'nif'=>'required|string|max:9',
                'nombre_empresa'=>'required|string|max:100',
                'foto'=>'required|max:10000|mimes:jpeg,png,jpg',
                'tipo_local'=>'required|string|max:20',
                'telf1'=>'required|numeric|digits:9',
                'telf2'=>'numeric|digits:9',
                'cp'=>'required|string|max:5',
                'direccion'=>'required|string|max:100',
                'web'=>'string|max:255',
            ];

        }

        $mensaje=[
            'required'=>'El :attribute es requerido',
            'foto.required'=>"La imagen es requerida",

        ];
        
        
        $this->validate($request,$campos,$mensaje);
        $nif=$request->input('nif');
        $datosEmpresa=request()->except('_token','estado','enviar','D_J', 'V_S','descanso');
        $horario=request()->only('D_J', 'V_S','descanso');
        Horario::insert($horario);
        if($request->hasFile('foto')){
            $datosEmpresa['foto']=$request->file('foto')->store('uploads','public');
        }
        $datosEmpresa = array_map(function($v){
            return trim(strip_tags($v));
        }, $datosEmpresa);

        if($datosEmpresa["telf2"]==""){
            $datosEmpresa["telf2"]=null;
        }
        Local::insert($datosEmpresa);
         $id=DB::table('horario')->count();
        Local::where("nif", $nif)->update(["id_horario" => $id]);

        $locales=DB::select("SELECT nombre_carta from carta");
        $nombre=$request->nombre_empresa;

        for($i=0;$i<=count($locales)-1;$i++){
            $locales[$i]=$locales[$i]->nombre_carta;
        }

        if (in_array($nombre, $locales)) {
            $idc=DB::table('carta')
            ->select("id_carta")
            ->where('nombre_carta','LIKE',$nombre)
            ->get();
            $idc=$idc[0]->id_carta;
            Local::where("nif", $nif)->update(["id_carta" => $idc]);
        }else{
            $idc=DB::select("SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='restaurante2' AND  TABLE_NAME='carta'");
            $idc=$idc[0]->AUTO_INCREMENT;
            Local::where("nif", $nif)->update(["id_carta" => $idc]);
            DB::select("INSERT INTO `carta` (nombre_carta) VALUES ('$nombre')");
        }
        

        return redirect('/client');
    }
}
