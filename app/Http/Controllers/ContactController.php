<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMailalble;

class ContactController extends Controller
{
    public function index (){
        return view('layouts.contact');

    }
 public function store (Request $request){
     $request->validate([
        'name'=>'required',
        'apellidos'=>'required',
        'email'=>'required|email',
        'phone'=>'required',
        'mensaje'=>'required',
     ]);
    /* foreach ($request->request as $valor) {
       $valor=strip_tags($valor);
    }*/
    $correo= new ContactMailalble($request->all());
    Mail::to('arantzazu_fdez@outlook.com')->send($correo);
    return  redirect('/contact')->with('inf','Mensaje enviado');
    }
}