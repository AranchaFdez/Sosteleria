@extends('layouts.head')
@section('content')
<div class="contact ">
    <div class=" form col-12 col-sm-12 col-md-8 col-lg-4">
    @if (Session::has('inf'))
        <div class="alert alert-success alert-dismissible" role="alert">

             {{Session::get('inf')}}
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        @endif
        <div class="shadow-sm p-3 mb-5 bg-white rounded formulario ">
            <form class="form-horizontal col-12 " method="post" action="{{route('contact.store')}}">
            @csrf
                <fieldset>
                    <legend class="text-center header">Escribenos</legend>
                    <hr>
                    <div class="row">
                   
                        <div class="form-group col-sm-12 col-md-6">
                        
                            <input id="fname" name="name" type="text" placeholder="Nombre" class="form-control">       
                            @error('name')
                                <p style="color:red;">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <input id="lname" name="apellidos" type="text" placeholder="Apellidos" class="form-control">
                            @error('apellidos')
                            <p style="color:red;">{{$message}}</p>                       
                             @enderror                        
                        </div>    
                    </div>
                    <div class="form-group  row">
                            <div class="col-12 col-md-12">
                                <input id="email" name="email" type="text" placeholder="Email" class="form-control">
                                @error('email')
                                <p style="color:red;">{{$message}}</p>                            
                            @enderror   
                            </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 col-md-12">
                            <input id="phone" name="phone" type="text" placeholder="Teléfono" class="form-control">
                            @error('phone')
                            <p style="color:red;">{{$message}}</p>                            
                            @enderror   
                        </div>
                    </div>
                        <div class="form-group  row">
                            <div class="col-12 col-md-12">
                                <textarea class="form-control" id="message" name="mensaje" placeholder="Escriba su masaje para nosotros aquí. Nos comunicaremos con usted en un plazo de 2 días hábiles." rows="7"></textarea>
                                @error('mensaje')
                                <p style="color:red;">{{$message}}</p>                               

                            @enderror 
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Enviar</button>

                            </div>
                        </div>
                </fieldset>
            </form>
     

        </div>
    </div>
    <div class="contacto col-12 col-sm-12 col-md-12 col-lg-9" >
        <img src='../images/contact/8741.jpg' alt="" >
    
    </div>
</div>
@endsection

