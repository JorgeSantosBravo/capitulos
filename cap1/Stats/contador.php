<title>Contador de capítulos por serie</title>
<?php
	
include("header/header.php");

$cont=$miconexion->query("SELECT *, count(id_serie)as cantidad, sum(duracion) as suma FROM tituloserie,titulocapitulo WHERE titulocapitulo.serie=tituloserie.id_serie GROUP BY id_serie ORDER BY suma DESC");

echo "<table border=1 align=center>";
echo "<th><font face='Trebuchet MS'>Nº</th>";
echo "<th><font face='Trebuchet MS'>Serie</th>";
echo "<th><font face='Trebuchet MS'>Capítulos</th>";
echo "<th><font face='Trebuchet MS'>Minutos</th>";
$i=1;
while ($rows = $cont->fetch_assoc()) {
echo "<tr><td align=center>".$i."</td>";
echo "<td align=center><a href=titulo.php?id=".$rows["id_serie"].">".$rows["titulo_serie"]."</a></td>";
echo "<td align=center>".$rows["cantidad"]."</td>";
echo "<td align=center>".$rows["suma"]."</td></tr>";
$i++;
}

echo "</table><br>";

?>