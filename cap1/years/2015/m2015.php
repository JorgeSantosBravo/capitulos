<title>2015</title>
<?php
echo "<body><table border=1 align=center>";
echo "<th bgcolor=white>Nº</th>";
echo "<th bgcolor=white>Fecha</th>";
echo "<th bgcolor=white>Medio</th>";
echo "<th bgcolor=white>Formato</th>";
echo "<th bgcolor=white>Serie</th>";
echo "<th bgcolor=white>SE</th>";
echo "<th bgcolor=white>Título</th>";
echo "<th bgcolor=white>Duración</th>";


$i=1;	//Contador para contar las filas impares y ponerlas de distinto color


$fech=$miconexion->query("SELECT * FROM temporada,titulocapitulo,tituloserie,fechastitulos WHERE temporada.id_temporada=titulocapitulo.ns AND titulocapitulo.id_capitulo = fechastitulos.id_titulo and tituloserie.id_serie=titulocapitulo.serie and YEAR(fecha)=2015 ORDER BY (fecha),fechastitulos.id_titulo ASC");

while ($rows = $fech->fetch_assoc()) {
	$fecha = explode("-",$rows["fecha"]); 
	if ($fecha[0]==2015){
echo "<tr";
if ($i%2!=0)
{echo" bgcolor=#E6E6E6>";}
else{
	echo" bgcolor=white>";
}
$fechcompl=$fecha[2].'/'.$fecha[1].'/'.$fecha[0];

echo "<td align=center>".$i."</td>";
echo '<td><a name="'.$fechcompl.'"></a> '.$fechcompl.'</td>';
echo "<td align=center>".$rows["medio"]."</td>";
echo "<td align=center>".$rows["formato"]."</td>";
echo '<td align=center><a href=titulo.php?id='.$rows["id_serie"].'>'.$rows["titulo_serie"].'</a></td>';
echo '<td align=center>S'.$rows["numero_temporada"].'E'.$rows["e"].'</td>';
echo "<td align=center><a href=titulo.php?id=".$rows["id_titulo"].">".$rows["titulo_capitulo"]."</a></td>";

echo "<td align=center>".$rows["duracion"]."</td></tr>";
$i++;

}
}
echo "</table><br></font>";
echo "<a href='visor.php?v=years/index.php'>Volver a anuarios</a><br>";
?>
