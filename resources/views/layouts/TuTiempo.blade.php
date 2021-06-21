<?php
//Fichero para realizar la cache de los datos, especifica la ruta (path) del directorio que desees utilizar.
//Recuerda que el directorio para la cache debe tener permisos de escritura.
$PathFicheroCacheDatos = $_SERVER['DOCUMENT_ROOT'].'\3768.txt';
include_once($PathFicheroCacheDatos);


$WeatherJson = file_get_contents('https://api.tutiempo.net/json/?lan=es&apid=zxGaaXaaXqXBxsl&lid=3768');
$WeatherArray = json_decode($WeatherJson,true);
//Guardamos cache
$JsonCachear = addslashes(serialize($WeatherArray));
$TextoCachearDatos = '<?php $LastUpdate = '.time().'; $JsonCache = \''.$JsonCachear.'\'; ?>';
$fp = @fopen($PathFicheroCacheDatos,"w");
fwrite($fp,$TextoCachearDatos);
fclose($fp);


$MesesName = array('-','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');

$WeatherPrint = '<div id="WeatherTutiempo">
<div class="header">
<h2>El tiempo en '.$WeatherArray['locality']['name'].'</h2>
<p>Pronóstico 7 días | El tiempo por Tutiempo.net</p>
</div>';

$mifecha = new DateTime(); 
//$mifecha->modify('+2 hours'); 
$horaActual=$mifecha->format('G');
$horaActual=$horaActual.":00";

//Salida horas
for($i = 1; $i <= 25; $i++){
list($anio,$mes,$dia) = explode("-",$WeatherArray['hour_hour']['hour'.$i]['date']);

if(str_contains($WeatherArray['hour_hour']['hour'.$i]['hour_data'],$horaActual)){
    $WeatherPrint .= '<div class="daydata">';
    $WeatherPrint .= '<p class="time"><strong>'.$WeatherArray['hour_hour']['hour'.$i]['hour_data'].'</strong> | '.$WeatherArray['hour_hour']['hour'.$i]['text'].'</p>
    <p class="wind"><img alt="'.$WeatherArray['hour_hour']['hour'.$i]['text'].'" title="'.$WeatherArray['hour_hour']['hour'.$i]['text'].'" height="50" src="https://v5i.tutiempo.net/wi/01/50/'.$WeatherArray['hour_hour']['hour'.$i]['icon'].'.png" width="50">'.$WeatherArray['hour_hour']['hour'.$i]['temperature'].'&deg;C
    <p class="">Viento :'.$WeatherArray['hour_hour']['hour'.$i]['wind'].' km/h</p>
    Humedad: '.$WeatherArray['hour_hour']['hour'.$i]['humidity'].'%<br></p>
    </div>';
break;
}
}

$WeatherPrint .= '<p class="linkTT"><a href="'.$WeatherArray['locality']['url_hourly_forecast'].'" target="_blank" rel="nofollow">Ver pronóstico por horas 14 días</a></p></div>';

print  $WeatherPrint;
?>
