@extends('layouts.app')

@section('content')
<div class="container">


    @php
        $cont=1;
    @endphp

    @if (Session::has('mensajeT'))
    <div class="alert alert-success" role="alert">
        {{Session::get('mensajeT')}}
    </div>

    @endif

    @if (Session::has('mensajeF'))
    <div class="alert alert-danger" role="alert">
        {{Session::get('mensajeF')}}
    </div>

    @endif
    <table class="table  table-dark  ">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Nif</th>
                <th>Empresa</th>
                <th>Tipo Local</th>
                <th>Dirección</th>
                <th>CP</th>
                <th>Cod_Salud</th>
                <th>Telefeno 1</th>
                <th>Acciones</th>

            </tr>
        </thead>

        <tbody>
            @foreach ($local as $dato)
                <tr>
                <td>
                    {{$cont++}}
                    </td>
                    <td>{{$dato->nif}}</td>
                    <td>{{$dato->nombre_empresa}}</td>
                    <td>{{$dato->tipo_local}}</td>
                    <td>{{$dato->direccion}}</td>
                    <td>{{$dato->cp}}</td>
                    <td>{{$dato->cod_salud}}</td>
                    <td>{{$dato->telf1}}</td>
                    <td>
                        <form action="{{url('/admin/activar/'.$dato->nif)}}" method="post"class="d-inline">
                            @csrf
                            <input type="submit" value="Activar" onclick="return confirm('¿Desea Activar la empresa?')" class="btn btn-success">
                        </form>
                        <form action="{{url('/admin/activar/'.$dato->nif)}}" method="post" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <input type="submit" value="Borrar" onclick="return confirm('¿Desea Borrar la empresa?')"class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>

    </table>
    @if(count($local)==0)
        <p style="color:red;"><b>No hay empresas que activar</b></p>
    @endif
    {!! $local->links() !!}

    <a href="{{url('/admin/')}}"  class="btn btn-primary">Atrás</a>
</div>
@endsection
