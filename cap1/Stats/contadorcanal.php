<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<?php
	
include("conexion.php");

$cont=$miconexion->query("SELECT *, count(id_serie)as cantidad FROM tituloserie,canal WHERE tituloserie.canal=canal.ID_canal GROUP BY id_canal ORDER BY cantidad DESC");
echo "<table border=1 align=center>";
echo "<th><font face='Trebuchet MS'>Canal</th>";
echo "<th><font face='Trebuchet MS'>Series</th>";
while ($rows = $cont->fetch_assoc()) {
echo "<tr><td align=center><a href=canal.php?id=".$rows["ID_canal"].">".$rows["Nomcanal"]."</a></td>";
echo "<td align=center>".$rows["cantidad"]."</td></tr>";
}

echo "</table><br>";

?>