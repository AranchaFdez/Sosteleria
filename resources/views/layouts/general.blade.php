@extends('layouts.principal')
@section('contenido')
<div class="cabecera">
    <div class="principal">
        <h3>Dinos que buscas y te diremos que encuentras</h3>

        <a href="{{url('/sosteleria/local')}}"  class="btn btn-primary">Empieza tu búsqueda</a>

    </div>
   
        
      </div>
<div class="general">
  
    <h1>Bares destacados</h1>
        <div class="destacados row">
            @foreach($data['bar'] as $loca)
            <div class="card" style="width: 18rem;">
                <img class="card-img-top " src='{{url("../storage/$loca->foto")}}' >
                    <div class="card-body ">
                        <h5 class="card-title">{{$loca->nombre_empresa}}</h5>
                        <p class="card-text">{{$loca->descripcion}}</p>
                        <form action="{{url('/local/bar/'.$loca->nif)}}" method="post">
                            @csrf
                            <input type="submit" value="Visitar" class="btn btn-primary">
                        </form>
                    </div>
            </div>
            @endforeach
        </div>

    <h1>Restaurantes destacados</h1>
        <div class="destacados row">
            @foreach($data['restaurante'] as $restaurante)
            <div class="card" style="width: 18rem;">
                <img class="card-img-top"src='{{url("../storage/$restaurante->foto")}}' >
                    <div class="card-body">
                        <h5 class="card-title">{{$restaurante->nombre_empresa}}</h5>
                        <p class="card-text">{{$restaurante->descripcion}}</p>
                        <form action="{{url('/local/restaurante/'.$restaurante->nif)}}" method="post">
                            @csrf
                            <input type="submit" value="Visitar" class="btn btn-primary">
                        </form>
                    </div>
            </div>
            @endforeach
        </div>

</div>

@endsection
