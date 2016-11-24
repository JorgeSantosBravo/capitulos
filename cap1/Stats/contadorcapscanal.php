<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<?php
	
include("conexion.php");

$cont=$miconexion->query("SELECT *,COUNT(id_capitulo) as cantidad FROM titulocapitulo,tituloserie,canal WHERE titulocapitulo.serie=tituloserie.id_serie and tituloserie.canal=canal.ID_canal GROUP BY canal ORDER BY cantidad DESC");
echo "<table border=1 align=center>";
echo "<th><font face='Trebuchet MS'>Canal</th>";
echo "<th><font face='Trebuchet MS'>Capítulos</th>";
while ($rows = $cont->fetch_assoc()) {
echo "<tr><td align=center><a href=canal.php?id=".$rows["ID_canal"].">".$rows["Nomcanal"]."</a></td>";
echo "<td align=center>".$rows["cantidad"]."</td></tr>";
}

echo "</table><br>";

?>