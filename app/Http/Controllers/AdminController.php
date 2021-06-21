<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Local;
use App\Models\Users;
use App\Models\Horario;
use App\Models\Carta;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $datos['local']=DB::table('local')->where('estado', '=', 'Activo')->paginate(10);
         return view('layouts.admin.index',$datos);
    }

    public function create(){
        return view('layouts.admin.activar');
    }

  

    public function destroy($nif){
        //recupero la inf del local
          $local=Local::findOrFail($nif);
          $mail=$local->mail;
    
          $id= DB::table('users')
            ->select("id")
            ->where('email','LIKE',$mail)
            ->get();
          $id2=$id[0]->id;
          
        //si ya no existe en la carpeta la borro
        if(Storage::delete('public/'.$local->foto)){
            Local::destroy($nif);
            Users::destroy($id2);
            
            return redirect('admin')->with('mensajeT','Se ha borrado con éxito');
        }
            return redirect('admin')->with('mensajeF','La empresa no se ha borrado');
        }


    public function edit( $nif){
        $local=Local::findOrFail($nif);
        $id_horario=$local->id_horario;
       
        $horario=DB::select("SELECT * FROM `horario` WHERE id_horario=".$id_horario);
        $horario=$horario[0];


        return view('layouts.admin.edit', compact('local','horario'));
        
    }

    public function update(Request $request,  $nif){
        $datosEmpresa=request()->except('_token','_method','enviar','D_J', 'V_S','descanso');
        $horario=request()->only('D_J', 'V_S','descanso');
        if($request->hasFile('foto')){
            $local=Local::findOrFail($nif);
            Storage::delete('public/'.$local->foto);
            $datosEmpresa['foto']=$request->file('foto')->store('uploads','public');
        }
        $localUpdate=Local::where('nif',"=",$nif);
        $localUpdate->update($datosEmpresa);
        $local=Local::findOrFail($nif);
        $id_horario=$local->id_horario;
        $horariolUpdate=Horario::where('id_horario',"=",$id_horario);
        $horariolUpdate->update($horario);

        return redirect('admin')->with('mensaje','Se ha actualizado con éxito');


    }

    public function show(){
        $datos['local']=DB::table('local')->where('estado', '=', 'No Activo')->paginate(10);
        return view('layouts.admin.activar',$datos);
    }

    public function activar( $nif){
        $local=Local::findOrFail($nif);
        $estado=$local->estado;

        if($estado=='No Activo'){
            Local::where("nif", $nif)->update(["estado" => "Activo"]);
            return redirect('admin')->with('mensaje','Se ha activado con éxito');
        }else{
            return redirect('admin')->with('mensaje','La empresa ya esta activada');
        };

    }

    public function borrar($nif){
        $local=Local::findOrFail($nif);
        $mail=$local->mail;

        $id= DB::table('users')
            ->select("id")
            ->where('email','LIKE',$mail)
            ->get();
        $id2=$id[0]->id;

        if(Storage::delete('public/'.$local->foto)){
            Local::destroy($nif);
            Users::destroy($id2);
            return redirect('admin')->with('mensajeT','Se ha borrado con éxito');
        }
            return redirect('admin')->with('mensajeF','La empresa no se ha borrado');
            
    }


}
