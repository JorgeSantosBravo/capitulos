<link rel="stylesheet" type="text/css" media="screen" href="trebuchet.css">
<?php
	
include("conexion.php");

$cont=$miconexion->query("SELECT *, count(director.id_director)as cantidad FROM capitulo,capitulosdirectores,director WHERE capitulo.id_capitulo=capitulosdirectores.id_capitulo and director.id_director=capitulosdirectores.id_director GROUP BY director.id_director ORDER BY cantidad DESC");
echo "<table border=1 align=center>";
echo "<th><font face='Trebuchet MS'>Director</th>";
echo "<th><font face='Trebuchet MS'>Capítulos</th>";
while ($rows = $cont->fetch_assoc()) {
echo "<tr><td align=center>".$rows["Nomdir"]."</td>";
echo "<td align=center>".$rows["cantidad"]."</td></tr>";
}

echo "</table><br>";

?>