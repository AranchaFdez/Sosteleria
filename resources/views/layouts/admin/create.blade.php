
<pre>

</pre>
<form action="{{url('/admin')}}" method="post" enctype="multipart/form-data">
    @csrf

  @include('layouts.admin.form',['modo'=>'Crear'])

</form>
