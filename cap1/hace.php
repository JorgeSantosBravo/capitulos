<link rel="stylesheet" type="text/css" media="screen" href="trebuchet.css">
<?php
include("conexion.php");
echo "<strong>Hoy hace unos años...</strong><br>
<strong>Películas</strong>:<br>
";

$anio=date ("Y");
$dif=$anio-2013;
$dia=date("d");
$mes=date("m");

for ($i=2013;$i<$anio;$i++){
$fech=$miconexion->query("SELECT * FROM titulopelicula,fechastitulos WHERE titulopelicula.id_pelicula=fechastitulos.id_titulo AND DAY(fecha)=".$dia." and MONTH(fecha)=".$mes." AND YEAR(fecha)=".$i);
while ($rows = $fech->fetch_assoc()) {
	$fecha = explode("-",$rows["fecha"]); 
//if (($fecha[0]==date ("Y")-1||$fecha[0]==date ("Y")-2||$fecha[0]==date ("Y")-3)&&$fecha[1]==date ("m")&&$fecha[2]==date ("d")) {
echo $fecha[0].": <a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a><br>";
}
}

echo "<br><strong>Capítulos</strong>:<br>";
for ($i=2013;$i<$anio;$i++){
$fech=$miconexion->query("SELECT * FROM temporada,titulocapitulo,tituloserie,fechastitulos WHERE temporada.id_temporada=titulocapitulo.ns AND titulocapitulo.serie=tituloserie.id_serie and titulocapitulo.id_capitulo=fechastitulos.id_titulo AND DAY(fecha)=".$dia." and MONTH(fecha)=".$mes." AND YEAR(fecha)=".$i);
while ($rows = $fech->fetch_assoc()) {
$fecha = explode("-",$rows["fecha"]); 

echo $fecha[0].": <a href=titulo.php?id=".$rows["id_capitulo"].">".$rows["titulo_serie"]." (".$rows["numero_temporada"]."x".$rows["e"].") - ".$rows["titulo_capitulo"]."</a><br>";
}
}
?>