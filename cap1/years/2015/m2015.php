<title>2015</title>
<?php

echo "<body><table border=1 align=center>";
echo "<th bgcolor=white><font face='Trebuchet MS'>Nº</th>";
echo "<th bgcolor=white><font face='Trebuchet MS'>Fecha</th>";
echo "<th bgcolor=white><font face='Trebuchet MS'>Medio</th>";
echo "<th bgcolor=white><font face='Trebuchet MS'>Formato</th>";
echo "<th bgcolor=white><font face='Trebuchet MS'>Serie</th>";
echo "<th bgcolor=white><font face='Trebuchet MS'>SE</th>";
echo "<th bgcolor=white><font face='Trebuchet MS'>Título</th>";

echo "<th bgcolor=white><font face='Trebuchet MS'>Duración</th>";


$i=1;	//Contador para contar las filas impares y ponerlas de distinto color


$fech=$miconexion->query("SELECT * FROM capitulo,serie WHERE capitulo.serie LIKE serie.id_serie ORDER BY (fecha) ASC");

while ($rows = $fech->fetch_assoc()) {
	$fecha = explode("-",$rows["fecha"]); 
	if ($fecha[0]==2015){
echo "<tr";
if ($i%2!=0)
{echo" bgcolor=#E6E6E6>";}
else{
	echo" bgcolor=white>";
}
echo "<td align=center>".$i."</td>";
echo '<td>'.$fecha[2].'/'.$fecha[1].'/'.$fecha[0].'</td>';
echo "<td align=center>".$rows["medio"]."</td>";
echo "<td align=center>".$rows["formato"]."</td>";
echo '<td align=center>'.$rows["Nombre"].'</td>';
echo '<td align=center>S'.$rows["s"].'E'.$rows["e"].'</td>';
echo "<td align=center>".$rows["Titulo"]."</td>";

echo "<td align=center>".$rows["Duracion"]."</td></tr>";
$i++;

}
}
echo "</table><br></font>";
echo "<a href='visor.php?v=years/index.php'>Volver a anuarios</a><br>";
?>
