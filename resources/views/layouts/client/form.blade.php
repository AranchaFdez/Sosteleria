<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header" style="background:lightskyblue;">
              <h1>{{$modo}} Empresa</h1></div>
            <div class="card-body">

                @if(count($errors)>0)
                    <div class="alert alert-danger"role="alert">
                        <ul>
                            @foreach ($errors->all() as $error )
                                <li> {{$error}}</li>
                            @endforeach
                        </ul>
                    </div>

                @endif

                <div class="form-group">
                    <label for="nif">NIF empresa</label>
                    <input type="text" name="nif" id="nif" value="{{isset($local->nif)?$local->nif:old('nif') }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="nombre_empresa">Nombre empresa</label>
                    <input type="text" name="nombre_empresa" id="nombre_empresa" class="form-control" value="{{isset($local->nombre_empresa)?$local->nombre_empresa:old('nombre_empresa')}}">
                </div>

                <label for="foto">Foto :</label><br>
                    @if (isset($local->foto))
                        <img src="{{asset('storage').'/'.$local->foto}}"  style="width: 10%;" class="img-thumbnail img-fluid"><br>
                    @endif
                <div class="custom-file">
                    <input type="file" name="foto" id="foto" >
                </div>
                <?php
                use GuzzleHttp\Client;

                $client = new Client();
                $response = Http::get('https://datos.comunidad.madrid/catalogo/api/action/datastore_search?id=f22c3f43-c5d0-41a4-96dc-719214d56968&fields=_id,municipio_distrito,fecha_informe,casos_confirmados_ultimos_14dias,tasa_incidencia_acumulada_ultimos_14dias');
                $response->json();
                $response=$response ['result']['records'];
                ?>
                
                <div class="form-group">
                    <label for="cod_salud">Cod_salud</label>
                    <select class="form-control"name="cod_salud" >
                    @foreach ($response as $zona )
                   <option value="{{$zona['_id']}}" 
                   <?php if(isset($local->cod_salud) && $local->cod_salud==$zona) {
                    echo "selected=selected";
                    } 
                    ?>
                    >{{$zona['municipio_distrito']}}</option>
                    @endforeach
                   </select>
                    
                </div>

                <div class="form-group">
                <label for="tipo_local">Tipo Local</label>
                <select class="form-control" name='tipo_local' >
                    <option value="Bar"
                     <?php 
                        if(isset($local->tipo_local) && $local->tipo_local=="Bar" ) {
                         echo "selected=selected";
                        } 
                     ?>>Bar</option>
                     <option value="Restaurante" 
                         <?php if(isset($local->tipo_local) && $local->tipo_local=="Restaurante" ) {
                         echo "selected=selected";
                
                         } 
                    ?>
                     > Restaurante</option>
                    </select>
                </div>
                <?php
               $tipo_comida=array("Alemana","Americana","Andaluza","Argentina","Asiática","Australiana","Árabe","Arrocería","Bangladesh","BBQ","Bocadillos","Bocadillos/Wraps","Braseria","Caribeña","Casera","China","Centroamericana",
               "Colombiana","Crepetería","Coreana","Ecuatoriana","Egipcia","Empanadas","Española","Etíope","Francesa","Fusión","Gallega","Gourmet","Griega","Hamburguesas","Hawaiana", "Heladería","India", "Inglesa","Italiana",
               "Jamaicana","Japonesa","Kebab", "Kosber","Kurda", "Libanesa","Malasia","Marroquí","Marisquería","MEditerránea","Mexicana","Nepalí","Noruega","Oriental","Paellas","Paquistaní","Peruana","Pizza","Portuguesa","Rusa","Siria",
               "Sudamericana","Sushi","Tailandesa","Tapas","Tibatana","Turca","Venezolana","Vietnamita");
               
               ?>
               <div class="form-group">
                <label for="tipo_local">Tipo Comida</label>

                    <select class="form-control"name="tipo_comida" >
                        @foreach ($tipo_comida as $comida )
                    <option value="{{$comida}}" 
                    <?php if(isset($local->tipo_comida) && $local->tipo_comida==$comida ) {
                        echo "selected=selected";
                        } 
                        ?>
                        >{{$comida}}</option>
                        @endforeach
                    </select>
               
               </div>
                <div class="form-group">
                    <label for="descripcion">Descripcion corta </label>
                    <textarea name="descripcion" id="descripcion" class="form-control" minlength="130" maxlength="130">{{isset($local->descripcion)?$local->descripcion:old('descripcion')}}</textarea>
                </div>

                <div class="form-group">
                    <label for="descripcion">Mensaje de bienvenida</label>
                    <textarea name="descrip" id="descripcion" class="form-control" minlength="400" maxlength="400">{{isset($local->descrip)?$local->descrip:old('descrip')}}</textarea>
                </div>

                <div class="form-group">
                    <label for="telf_fijo">telf1</label>
                    <input type="text" name="telf1" id="telf_fijo"  class="form-control" value="{{isset($local->telf1)?$local->telf1:old('telf1')}}">
                </div>

                <div class="form-group">
                    <label for="telf_movil">telf2</label>
                    <input type="text" name="telf2" id="telf_movil"  class="form-control" value="{{isset($local->telf2)?$local->telf2:old('telf2')}}">
                </div>

                <div class="form-group">
                    <label for="mail">mail</label>
                    <input type="email" name="mail" id="mail"  class="form-control" value="{{auth()->user()->email}}" readonly>
                </div>

                <div class="form-group">
                    <label for="cp">CP</label>
                    <input type="text" name="cp" id="cp"  class="form-control" value="{{isset($local->cp)?$local->cp:old('cp')}}">
                </div>

                <div class="form-group">
                    <label for="direccion">Direccion</label>
                    <input type="text" name="direccion" id="direccion" class="form-control" value="{{isset($local->direccion)?$local->direccion:old('direccion')}}">
                </div>

                <label for="menu">Menu :</label><br>
                <div class="form-check form-check-inline">
                @if(isset($local->menu) && $local->menu =="si")
                    Si
                        <input type="radio" name="menu" value="si" id="menu"  class="form-check-input" checked>
                    No
                        <input type="radio" name="menu" value="no" id="menu"  class="form-check-input">
                    @else
                    Si
                        <input type="radio" name="menu" value="si" id="menu"  class="form-check-input">
                    No
                        <input type="radio" name="menu" value="no" id="menu"  class="form-check-input" checked>
                    @endif
                </div>
                <br>

                <label for="para_llevar">Para llevar :</label><br>
                @if(isset($local->para_llevar) && $local->para_llevar =="si")
                Si
                    <input type="radio" name="para_llevar" value="si" id="para_llevar" checked>
                No
                    <input type="radio" name="para_llevar" value="no" id="para_llevar">
                @else
                Si
                    <input type="radio" name="para_llevar" value="si" id="para_llevar" >
                No
                    <input type="radio" name="para_llevar" value="no" id="para_llevar" checked>
                @endif
                <br>


                <label for="comer_alli">Para comer alli :</label><br>
                @if(isset($local->comer_alli) && $local->comer_alli =="si")
                Si
                    <input type="radio" name="comer_alli" value="si" id="comer_alli" checked>
                No
                    <input type="radio" name="comer_alli" value="no" id="comer_alli">
                @else
                Si
                    <input type="radio" name="comer_alli" value="si" id="comer_alli" >
                No
                    <input type="radio" name="comer_alli" value="no" id="comer_alli" checked>
                @endif
                <br>

                <label for="terraza">Terraza:</label><br>
                @if(isset($local->terraza) && $local->terraza =="si")
                Si
                    <input type="radio" name="terraza" value="si" id="terraza" checked>
                No
                    <input type="radio" name="terraza" value="no" id="terraza">
                @else
                Si
                    <input type="radio" name="terraza" value="si" id="terraza" >
                No
                    <input type="radio" name="terraza" value="no" id="terraza" checked>
                @endif
                <br>

                <label for="vegano">Vegano:</label><br>
                @if(isset($local->vegano) && $local->vegano =="si")
                Si
                    <input type="radio" name="vegano" value="si" id="vegano" checked>
                No
                    <input type="radio" name="vegano" value="no" id="vegano">
                @else
                Si
                    <input type="radio" name="vegano" value="si" id="vegano" >
                No
                    <input type="radio" name="vegano" value="no" id="vegano" checked>
                @endif
                <br>

                <label for="carta_alerg">carta alergenos:</label><br>
                @if(isset($local->carta_alerg) && $local->carta_alerg =="si")
                Si
                    <input type="radio" name="carta_alerg" value="si" id="carta_alerg" checked>
                No
                    <input type="radio" name="carta_alerg" value="no" id="carta_alerg">
                @else
                Si
                    <input type="radio" name="carta_alerg" value="si" id="carta_alerg" >
                No
                    <input type="radio" name="carta_alerg" value="no" id="carta_alerg" checked>
                @endif
                <br>

                <label for="oferta">Ofertas</label><br>
                @if(isset($local->oferta) && $local->oferta =="si")
                Si
                    <input type="radio" name="oferta" value="si" id="oferta" checked>
                No
                    <input type="radio" name="oferta" value="no" id="oferta">
                @else
                Si
                    <input type="radio" name="oferta" value="si" id="oferta" >
                No
                    <input type="radio" name="oferta" value="no" id="oferta" checked>
                @endif
                <br>
                <label for="oferta">Glovo</label><br>
                @if(isset($local->oferta) && $local->oferta =="si")
                Si
                    <input type="radio" name="glovo" value="si" id="glovo" checked>
                No
                    <input type="radio" name="glovo" value="no" id="glovo">
                @else
                Si
                    <input type="radio" name="glovo" value="si" id="glovo" >
                No
                    <input type="radio" name="glovo" value="no" id="glovo" checked>
                @endif
                <br>
                <label for="oferta">Uber eats</label><br>
                @if(isset($local->oferta) && $local->oferta =="si")
                Si
                    <input type="radio" name="uber_eats" value="si" id="uber_eats" checked>
                No
                    <input type="radio" name="uber_eats" value="no" id="uber_eats">
                @else
                Si
                    <input type="radio" name="uber_eats" value="si" id="uber_eats" >
                No
                    <input type="radio" name="uber_eats" value="no" id="uber_eats" checked>
                @endif
                <br>

                <div class="form-group">
                <label for="web">Web</label>
                <input type="text" name="web" id="web" class="form-control" value="{{isset($local->web)?$local->web:old('web')}}">
                </div>

                <input  type="hidden" name="estado" value="No Activo" ><br>
                <input  type="hidden" name="visitas" value="0" ><br>

                <h3>Especificación del horario</h3>
                    <div class="form-group">
                        <label for="web">De Domingo a Jueves</label>
                        <input type="text" name="D_J" id="D_J" class="form-control" value="{{old('D_J')}}">
                    </div>
                    <div class="form-group">
                        <label for="web">De Viernes a Sábado</label>
                        <input type="text" name="V_S" id="V_S" class="form-control"  value="{{old('V_S')}}">
                    </div>
                    <div class="form-group">
                        <label for="web">Día de descanso</label>
                        <input type="text" name="descanso" id="descanso" class="form-control"   value="{{old('descanso')}}">
                    </div>
              

                <a href="{{url('/register')}}"  class="btn btn-primary">Atrás</a>
                <button type="submit" class="btn btn-primary" name="enviar">Registrar</button>
                </div>
            </div>
        </div>
    </div>
</div>