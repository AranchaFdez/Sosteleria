@extends('layouts.principal')
@section('contenido')
<div class="searchI">
 
 </div>
<div class="  contenedor">
    
    <div class="row seccion1 ">
    <form method="post" action="{{url('/sosteleria/local')}}" class="col-12 col-sm-12 col-md-12 col-lg-8">
            @csrf
            @include('layouts.formLocal')
    </form>
      <div class="apiTiempo col-12 col-sm-12 col-md-12 col-lg-4">
          @include('layouts.Tutiempo')
      </div>
  </div>

    <div class="titulo col-12">
        <h2>Resultado de tu búsqueda</h2>
    </div>
    <form method="post" action="{{url('/sosteleria/local')}}">
        <div class="row destacados">
            @if(count($sql)>0)
                 @foreach($sql as $loca)
                    <div class="card "   style="width: 18rem;">
                        <img class="card-img-top"  src='{{url("../storage/$loca->foto")}}'>
                            <div class="card-body">
                                <h5 class="card-title">{{$loca->nombre_empresa}}</h5>
                                <p class="card-text">{{$loca->descripcion}}</p>
                                    <form action="{{url('/local/'.strtolower($loca->tipo_local).'/'.$loca->nif)}}" method="post">
                                    @csrf
                                        <input type="submit" value="Visitar" class="btn btn-primary">
                                    </form>
                            </div>
                    </div>
                @endforeach
            @else
                <h6>No hay resultados en su búsqueda</h6>
            @endif
        </div>
    </form>
    {!! $sql->links() !!}
    <div class="row volver">
    <a href="{{url('/sosteleria/')}}"  class="btn btn-primary">Volver</a>
    </div>
</div>
@endsection
