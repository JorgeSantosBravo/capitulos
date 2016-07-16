<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<?php
	
include("conexion.php");

$cont=$miconexion->query("SELECT *,COUNT(id_capitulo) as cantidad FROM capitulo,serie,canal WHERE capitulo.serie=serie.id_serie and serie.Canal=canal.ID_canal GROUP BY canal ORDER BY cantidad DESC");
echo "<table border=1 align=center>";
echo "<th><font face='Trebuchet MS'>Canal</th>";
echo "<th><font face='Trebuchet MS'>Capítulos</th>";
while ($rows = $cont->fetch_assoc()) {
echo "<tr><td align=center>".$rows["Nomcanal"]."</td>";
echo "<td align=center>".$rows["cantidad"]."</td></tr>";
}

echo "</table><br>";

?>