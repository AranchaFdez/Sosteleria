@extends('layouts.app')

@section('content')
<div class="container">

    <form action="{{url('/admin/'.$local->nif)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        @include('layouts.admin.form',['modo'=>'Editar'])

    </form>
</div>
@endsection
