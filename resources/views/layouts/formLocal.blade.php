<div class="row selects">
    <div class="form-group  form-check-inline col-md-4">
            <label for="tipo_local">Elige Tipo de local</label>
            <select id="inputState" class="form-control" name="tipo_local">
                <option value="">Elige Tipo de Local</option>
                <option value="Bar">Bar</option>
                <option value="Restaurante">Restaurante</option>

            </select>
    </div>
    <?php
    $tipo_comida=array("Alemana","Americana","Andaluza","Argentina","Asiática","Australiana","Árabe","Arrocería","Bangladesh","BBQ","Bocadillos","Bocadillos/Wraps","Braseria","Caribeña","Casera","China","Centroamericana",
    "Colombiana","Crepetería","Coreana","Ecuatoriana","Egipcia","Empanadas","Española","Etíope","Francesa","Fusión","Gallega","Gourmet","Griega","Hamburguesas","Hawaiana", "Heladería","India", "Inglesa","Italiana",
    "Jamaicana","Japonesa","Kebab", "Kosber","Kurda", "Libanesa","Malasia","Marroquí","Marisquería","Mediterránea","Mexicana","Nepalí","Noruega","Oriental","Paellas","Paquistaní","Peruana","Pizza","Portuguesa","Rusa","Siria",
    "Sudamericana","Sushi","Tailandesa","Tapas","Tibatana","Turca","Venezolana","Vietnamita");
    ?>
   <div class="form-group  form-check-inline col-md-4">
         <label for="tipo_local">Elige Tipo de Comida</label>
         <select class="form-control"name="tipo_comida" >
             <option value="">Elige Tipo de Comida</option>

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
    <div class="form-group  form-check-inline col-md-3">
            <label for="inputZona">Elige Zona</label>
            <select id="inputState" class="form-control" name="cod_salud">
                <option value="">Elija zona...</option>
                    @foreach($respuesta as $zona)
                        <option value="<?=$zona['_id']?>"><?=$zona['municipio_distrito']?></option>

                    @endforeach
            </select>
    </div>
</div>
<div class="row checks">
    <div class="form-check filtro form-check-inline ">
        <input class="form-check-input" type="checkbox" name="terraza" id="inlineRadio3" value="si">
        <label class="form-check-label" for="inlineRadio3">TERRAZA</label>
    </div>
    <div class="form-check filtro form-check-inline ">
        <input class="form-check-input" type="checkbox" name="para_llevar" id="inlineRadio4" value="si">
        <label class="form-check-label" for="inlineRadio4">PARA LLEVAR</label>
    </div>
    <div class="form-check filtro  form-check-inline ">
        <input class="form-check-input" type="checkbox" name="vegano" id="inlineRadio5" value="si">
        <label class="form-check-label" for="inlineRadio5">VEGANO</label>
    </div>
    <div class="form-check filtro form-check-inline ">
        <input class="form-check-input" type="checkbox" name="oferta" id="inlineRadio6" value="si">
        <label class="form-check-label" for="inlineRadio6">OFERTA</label>
    </div>
    <div class="form-check filtro form-check-inline ">
        <input class="form-check-input" type="checkbox" name="alergenos" id="inlineRadio7" value="si">
        <label class="form-check-label" for="inlineRadio7">ALERGENOS</label>
    </div>
</div>
<br>
<div class="search">
<button type="submit" class="btn btn-primary" name="enviar">Buscar</button>
</div>