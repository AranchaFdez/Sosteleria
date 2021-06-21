@extends('layouts.head')
@section('content')
<pre>

</pre>
<form action="{{url('/client')}}" method="post" enctype="multipart/form-data">
    @csrf

  @include('layouts.client.form',['modo'=>'Registrar'])

</form>
<pre>

</pre>
@endsection