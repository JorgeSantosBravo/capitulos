<link rel="stylesheet" type="text/css" media="screen" href="trebuchet.css">
<?php
	
include("conexion.php");

$cont=$miconexion->query("SELECT *,COUNT(id_capitulo) as cantidad FROM capitulo,serie,canal WHERE capitulo.serie=serie.id_serie and serie.Canal=canal.ID_canal and YEAR(fecha)=2016 GROUP BY canal,MONTH(fecha) ORDER BY MONTH(fecha) ASC");
echo "<table border=1 align=center>";
echo "<th>Canal</th>";
echo "<th>Mes</th>";
//echo "<th>Capítulos</th>";
//Está mal hecha entera.
while ($rows = $cont->fetch_assoc()) {
	$fecha = explode("-",$rows["fecha"]);
echo"
<tr><td align=center>".$rows["Nomcanal"]."</td>
<td align=center>".$rows["cantidad"]."</td></tr>";
}

echo "</table><br>";

?>