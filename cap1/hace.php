<style>
table {
  border-collapse: collapse;
}
</style>
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
echo "<table>";
for ($i=2013;$i<$anio;$i++){
$fech=$miconexion->query("SELECT * FROM titulopelicula,fechastitulos WHERE titulopelicula.id_pelicula=fechastitulos.id_titulo AND DAY(fecha)=".$dia." and MONTH(fecha)=".$mes." AND YEAR(fecha)=".$i);
$filas=$miconexion->affected_rows;
     if($filas>=1){
	 
	echo "<tr><td rowspan=$filas valign=top><u>$i</u> </td>";
	 }

while ($rows = $fech->fetch_assoc()) {
	$fecha = explode("-",$rows["fecha"]); 
	

echo  "<td><a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td></tr>";
}
}
echo "</table>";
echo "<br><strong>Capítulos</strong>:<br>";
echo "<table>";

for ($i=2013;$i<$anio;$i++){
	$consulta=$miconexion->query("SELECT * FROM  temporada,titulocapitulo,tituloserie,fechastitulos WHERE temporada.id_temporada=titulocapitulo.ns AND titulocapitulo.serie=tituloserie.id_serie and titulocapitulo.id_capitulo=fechastitulos.id_titulo AND DAY(fecha)=".$dia." and MONTH(fecha)=".$mes." AND YEAR(fecha)=".$i); 
$filas=$miconexion->affected_rows;
     if($filas>=1){
	 
	echo "<tr><td rowspan=$filas valign=top><u>$i</u> </td>";
	 }
while ($rows = $consulta->fetch_assoc()) {
$fecha = explode("-",$rows["fecha"]); 
echo "<td><a href=titulo.php?id=".$rows["id_capitulo"].">".$rows["titulo_serie"]." - ".$rows["numero_temporada"]."x".$rows["e"]."</a></td></tr>";

}

	 }


echo "</table>";
?>