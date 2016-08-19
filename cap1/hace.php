<link rel="stylesheet" type="text/css" media="screen" href="trebuchet.css">
<?php
include("conexion.php");
echo "<strong>Hoy hace unos años...</strong><br>
<strong>Películas</strong>:<br>
";
$fech=$miconexion->query("SELECT * FROM peliculas,fechaspeliculas WHERE peliculas.id_pelicula=fechaspeliculas.id_pelicula");
while ($rows = $fech->fetch_assoc()) {
$fecha = explode("-",$rows["fecha"]); 
if (($fecha[0]==date ("Y")-1||$fecha[0]==date ("Y")-2||$fecha[0]==date ("Y")-3)&&$fecha[1]==date ("m")&&$fecha[2]==date ("d")) {
echo $fecha[0].": <a href=pelicula.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a><br>";
}
}
echo "<br><strong>Capítulos</strong>:<br>";
$fech=$miconexion->query("SELECT * FROM capitulo,serie,capitulosfecha WHERE capitulo.id_capitulo=capitulosfecha.id_capitulo and capitulo.serie LIKE serie.id_serie");
while ($rows = $fech->fetch_assoc()) {
$fecha = explode("-",$rows["fecha"]); 
if (($fecha[0]==date ("Y")-1||$fecha[0]==date ("Y")-2||$fecha[0]==date ("Y")-3)&&$fecha[1]==date ("m")&&$fecha[2]==date ("d")) {
echo $fecha[0].": <a href=capitulo.php?id=".$rows["id_capitulo"].">".$rows["Nombre"]." (".$rows["s"]."x".$rows["e"].") - ".$rows["Titulo"]."</a><br>";
}
}
?>