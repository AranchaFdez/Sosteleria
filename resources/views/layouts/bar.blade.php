<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{$local->nombre_empresa}}</title>

    <!-- Stiles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>


    <style>
        *{
            padding: 0px;
            margin: 0px;
            box-sizing: border-box;

        }
        #container{
            box-sizing: border-box;
            background-color:white;
        }

        .head{
            width: 100%;


        }
        .navbar{
            position: absolute;
            top:0px;
            left: 0px;
            z-index: 1;
            width: 100%;


        }
        .navbar-brand{
            margin-left: 15%;
            font-size: 22px;
        }
        .nav-item{
            font-size: 18px;
        }
        .navbar-collapse {
           width: 100%;

        }
        .navbar-nav{
            width: 100%;
            display: flex;
            justify-content: end;

        }

        .navbar{
            background: rgb(0, 0, 0,0.8);
            width: 100%;
        }
        .navbar-toggler-icon{
            background-color: floralwhite;
        }
        .cabecera{
            width: 100%;
            height: 500px;
            top:0px;
            left: 0px;

        }
        footer{
            background: rgba(0,0,0,0.8); 
            width: 100%;
            left: 0;
            bottom: 0;
            color:white;
            padding: 1%;
            text-align: center;

        }
        .imgBajo{
            width: 100%;


        }
        .imgBajo >img{
            width: 100%;
            height: 450px;
            background-position: center;
        }
        .horario{
            background: rgb(0, 0, 0,0.8);
            border: 1px solid black;
            padding: 5%;
            position: absolute;
            left: 10%;
            color:white;
            width: 30%;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .horario > h2 {
            text-decoration: underline;
        }
        .telDir{
            background: rgb(0, 0, 0,0.8);
            border: 1px solid black;
            padding: 7%;
            position: absolute;
            right:10%;
            color:white;
            width: 30%;
            height: 100%;
        }
        .telDir h2{
            text-decoration: underline;

        }
        .inf{
            position: relative;
            width: 100%;
            margin:0;
        }
        .imgSaludo{
            height: 250px;
        }
        .imgSaludo,.bienvenido {
            width: 100%;
        }
        .imgSaludo img{
            width: 100%;
            height: 100%;
        }
        .saludo{
            margin: 10% auto;
            width:100%;

        }
        .infc{
            display:flex;
            flex-direction:row;
            width: 80%;
            margin-left:10%;
            margin-bottom:5%;
            background-color:whitesmoke;
           

        }
        .carta{
            width:40%;
            margin-bottom:5%;
            margin-top:1%;
            margin-left: 4%;
            border: 10px, solid, red;
        }
        .carta h1{
            line-height:200%;
        }
        .carta2{
            width:100%;
            margin-left:2%;
        }
        .carta2 ul{
            margin-left:15px;
        }
        .menu{
            width:40%;
            margin-left: 7%;
            margin-top:2%;
            margin-bottom:5%;
            border: 10px, solid, red;
            

        }
        .menu2{
            width:100%;
            margin-left:2%;
        }
        .titulom, .titulom li {
            display: flex;
            flex-direction: row;
            width: 100%;
        }
        .titulom h3, .titulom li, .titulom li b{
            width: 100%;
        }
        
        
  </style>
</head>
<body>

<div id="container" >
    <div class="nava ">
        <nav class="navbar navbar-expand-md navbar-light  shadow-sm">
            <div class="container">
                <a class="navbar-brand text-white" href="#">
                {{$local->nombre_empresa}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                   

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto navbar-right">
                        <li class="nav-item active">
                            <a class="nav-link  text-white" href="{{ route('sosteleria.index') }}">Inicio </a></h5>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link  text-white"  href="{{url('about')}}">Sobre nosotros</a>
                        </li>
                        <li class="nav-item text-white">
                            <a class="nav-link  text-white"  href="{{url('contact')}}">Contacto</a>
                        </li> 
                    </ul>
                </div>
            </div>
        </nav>

          <div class="head">
            <img src="{{url('/images/bar.jpg')}}" alt="Image" class="cabecera"/>
        </div>
    </div>
    <div class="saludo row justify-content-center">
        <div class="bienvenido col-4 ">
          <h1>  Bienvenidos a {{$local->nombre_empresa}}
            </h1>

            {{$local->descrip}}

        </div>


        <div class="imgSaludo col-4">
        <img src='{{url("../storage/$local->foto")}}' alt="Image" />
        </div>

    </div>

    <div class="row infc">

    <div class="menu ">
            <div class="col-12">
                <h1>MENUS</h1>
                    <div class="menu2">
                        @foreach ($menuP as $p)
                                <div class="titulom">
                                <h3><b>{{$p->nombre_menu}}</b></h3><h3 style="text-align:right;"><b>{{$p->preciom}}€</b></h3><br>
                                </div>
                            <h5><b>Platos</b></h5>
                                @if($p->imagen!=null)
                                     <div>
                                         <img src='{{url("../images/$p->imagen")}}' style="width: 100px; height: 100px;" />
                                    </div><br>
                                @endif
                                <p><b>{{$p->nombre_plato}}</b><br>
                                <i>{{$p->descripcion}}</i><br>
                                <h5><b>Bebidas</b></h5>
                            @foreach ($menuB as $b  )
                            @if($p->imagen!=null)
                                     <div>
                                         <img src='{{url("../images/$b->imagen")}}' style="width: 100px; height: 100px;" />
                                    </div><br>
                                @endif
                            <p><b>{{$b->nombre_bebida}}</b><br>
                                <i>{{$b->descripcion}}</i><br>
                            @endforeach
                        @endforeach
                    </div>
            
            <h1>BEBIDAS</h1>
            
                    <div class="menu2">
                        @foreach ($cat2 as $s  )
                            <h3><b>{{$s->nombre_cat_bebida}}</h3></b><br>
                            @foreach ($bebidas as $b  )
                            @if($s->id_cat_bebida==$b->id_cat_bebida)
                            <ul> 
                                @if($b->imagen!=null)
                                     <div>
                                         <img src='{{url("../images/$b->imagen")}}' style="width: 100px; height: 100px;" />
                                    </div><br>
                                @endif
                                <div class="titulom">
                                <li><b>{{$b->nombre_bebida}}</b><b style="text-align:right;">{{$b->precio}}€</b></li>
                                </div>
                                <i>{{$b->descripcion}}</i>
                            </ul>
                            @endif
                            @endforeach
                        @endforeach
                    </div>
            </div>
        </div>

        <div class="carta ">
            <div class="col-12">
                <h1>PLATOS</h1>
                    <div class="carta2">
                        @foreach ($cat as $t  )
                            <h3><b>{{$t->nombre_cat_plato}}</h3></b><br>
                            @foreach ($platos as $p  )
                            @if($t->id_cat_plato==$p->id_cat_plato)
                            <ul>
                                @if($p->imagen!=null)
                                     <div>
                                         <img src='{{url("../images/$p->imagen")}}' style="width: 100px; height: 100px;" />
                                    </div><br>
                                @endif
                                <div class="titulom">
                                <li><b>{{$p->nombre_plato}}</b><b style="text-align:right;">{{$p->precio}}€</b></li>
                                </div>
                                
                                <i>{{$p->descripcion}}</i>
                                
                            </ul>
                            @endif
                            @endforeach
                        @endforeach
                    </div>
            </div>
        </div>
    </div>
</div>
    <div class=" row inf">
        
            <div class="imgBajo ">
                <img src="{{url('/images/sven2.jpg')}}" alt="">
            </div>
         
        <div class="row  horario">
            <h2>Horarios</h2>

                <p >De domingo a Jueves : {{$horario->D_J}}</p>
                <p >De Viernes a Domingo : {{$horario->V_S}}</p>
                <p >Día descanso: {{$horario->descanso}}</p>
            
             @if($local->web!=null)
             <h2>WEB</h2>
                <a href='{{$local->web}}'>{{$local->web}}</a>
            @endif
        </div>
        <div class="telDir row">
            <div class="row">
            <h2 class="col-12">Donde encontrarnos</h2>
            @if($local->telf1!=null)
                <p class="col-12">Teléfono Fijo:
                {{$local->telf1}}</p>
            @endif
            @if($local->telf2!=null)
                <p  class="col-12">Teléfono Móvil:
                {{$local->telf2}}</p>
            @endif
            @if($local->direccion!=null)
                <p  class="col-12">Dirección:
                {{$local->direccion}}</p>
            @endif
            </div>
             <div class="row servicios ">
                 @if($local->uber_eats=="si" || $local->glovo=="si")
                <h2 class="col-12">Servicios</h2>
               
                @if($local->uber_eats=="si")
                <div class="col-auto">
                    <img src="{{url('../images/ubereats.png')}}" alt="">
                </div>
                @endif
                
                @if($local->glovo=="si")
                     <div class="col-auto">
                        <img src="{{url('../images/glovo.png')}}" alt="">
                    </div>
                 @endif
                 
                 @endif
            </div>
        </div>
    </div>
    <footer>
        <p>Todos los derechos reservados a Sosteleria.S.L 2021
    </footer>

</div>



</body>