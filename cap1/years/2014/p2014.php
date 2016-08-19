<title>2014</title>
<?php
echo "<body><table border=1 align=center>";
echo "<th bgcolor=white>Nº</th>";
echo "<th bgcolor=white>Fecha</th>";
echo "<th bgcolor=white>Formato</th>";
echo "<th bgcolor=white>Año</th>";
echo "<th bgcolor=white>Título</th>";
echo "<th bgcolor=white>Punt.</th>";


$i=1;	//Contador para contar las filas impares y ponerlas de distinto color


$fech=$miconexion->query("SELECT * FROM peliculas,fechaspeliculas WHERE peliculas.id_pelicula=fechaspeliculas.id_pelicula and YEAR(fecha)=2014 ORDER BY fecha ASC");

while ($rows = $fech->fetch_assoc()) {
	$fecha = explode("-",$rows["fecha"]); 
echo "<tr";
if ($i%2!=0)
{echo" bgcolor=#E6E6E6>";}
else{
	echo" bgcolor=white>";
}
$fechcompl=$fecha[2].'/'.$fecha[1].'/'.$fecha[0];

echo "<td align=center>".$i."</td>";
echo '<td><a name="'.$fechcompl.'"></a> '.$fechcompl.'</td>';
echo "<td align=center>".$rows["formato"]."</td>";
echo '<td align=center>'.$rows["año"].'</td>';
echo '<td align=center><a href=pelicula.php?id='.$rows["id_pelicula"].'>'.$rows["titulo"].'</a></td>';
echo '<td align=center>'.$rows["puntuacion"].'</td>';
$i++;


}
echo "</table><br>";
echo "<a href=visor.php?v=years/index.php>Volver a anuarios</a><br>";
?>
