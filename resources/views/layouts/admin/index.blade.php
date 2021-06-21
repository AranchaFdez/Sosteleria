@extends('layouts.app')

@section('content')
@php
    $cont=1;
@endphp
<div class="container ">

        @if (Session::has('mensajeT'))
        <div class="alert alert-success alert-dismissible" role="alert">

             {{Session::get('mensajeT')}}
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        @endif

        @if (Session::has('mensajeF'))
        <div class="alert alert-danger alert-dismissible" role="alert">

             {{Session::get('mensajeF')}}
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
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
                        <a href="{{url('/admin/'.$dato->nif.'/edit')}}" class="btn btn-warning">Editar </a>
                        |
                        <form action="{{url('/admin/'.$dato->nif)}}" method="post" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <input type="submit" value="Borrar" onclick="return confirm('¿Desea Borrar la empresa?')" class="btn btn-danger">
                        </form>
                        </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    {!! $local->links() !!}
    <pre>

    </pre>
    <a href="{{url('/admin/activar')}}" class="btn btn-success">Activar nueva empresa</a>
</div>

@endsection
