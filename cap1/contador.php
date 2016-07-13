<link rel="stylesheet" type="text/css" media="screen" href="trebuchet.css">
<?php
	
include("conexion.php");

$cont=$miconexion->query("SELECT *, count(id_serie)as cantidad, sum(Duracion) as suma FROM capitulo,serie WHERE capitulo.serie=serie.id_serie GROUP BY id_serie ORDER BY suma DESC");

echo "<table border=1 align=center>";
echo "<th><font face='Trebuchet MS'>Serie</th>";
echo "<th><font face='Trebuchet MS'>Capítulos</th>";
echo "<th><font face='Trebuchet MS'>Minutos</th>";
while ($rows = $cont->fetch_assoc()) {
echo "<tr><td align=center>".$rows["Nombre"]."</td>";
echo "<td align=center>".$rows["cantidad"]."</td>";
echo "<td align=center>".$rows["suma"]."</td></tr>";

}

echo "</table><br>";

?>