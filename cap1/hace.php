<link rel="stylesheet" type="text/css" media="screen" href="trebuchet.css">
<?php
include("conexion.php");


$fech=$miconexion->query("SELECT * FROM capitulo,serie WHERE capitulo.serie LIKE serie.id_serie");
echo "<strong>Hoy hace unos años...</strong><br>";
while ($rows = $fech->fetch_assoc()) {
$fecha = explode("-",$rows["fecha"]); 

if (($fecha[0]==date ("Y")-1||$fecha[0]==date ("Y")-2||$fecha[0]==date ("Y")-3)&&$fecha[1]==date ("m")&&$fecha[2]==date ("d")) {
echo $fecha[0].": <a href=capitulo.php?id=".$rows["id_capitulo"].">".$rows["Nombre"]." (".$rows["s"]."x".$rows["e"].") - ".$rows["Titulo"]."</a><br>";
}

}

?>