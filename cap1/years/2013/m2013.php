<title>2013</title>
<?php
echo "<body><table border=1 align=center>";
echo "<th bgcolor=white>Nº</th>";
echo "<th bgcolor=white>Fecha</th>";
echo "<th bgcolor=white>Formato</th>";
echo "<th bgcolor=white>Serie</th>";
echo "<th bgcolor=white>SE</th>";
echo "<th bgcolor=white>Duración</th>";


$i=1;	//Contador para contar las filas impares y ponerlas de distinto color


$fech=$miconexion->query("SELECT * FROM titulocapitulo,tituloserie,fechastitulos WHERE titulocapitulo.id_capitulo = fechastitulos.id_titulo and tituloserie.id_serie=titulocapitulo.serie and YEAR(fecha)=2013 ORDER BY (fecha),fechastitulos.id_titulo ASC");

while ($rows = $fech->fetch_assoc()) {
	$fecha = explode("-",$rows["fecha"]); 
	if ($fecha[0]==2013){
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
echo '<td align=center>'.$rows["titulo_serie"].'</td>';
echo '<td align=center>S'.$rows["s"].'E'.$rows["e"].'</td>';

echo "<td align=center>".$rows["duracion"]."</td></tr>";
$i++;

}
}
echo "</table><br>";
echo "<a href=visor.php?v=years/index.php>Volver a anuarios</a><br>";
?>
