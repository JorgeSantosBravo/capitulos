<link rel="stylesheet" type="text/css" media="screen" href="Estilos/anios.css">
<title>2017</title>
<?php
echo "<body><table align=center>";
echo "<th>Nº</th>";
echo "<th>Fecha</th>";
echo "<th>Formato</th>";
echo "<th>Año</th>";
echo "<th></th>";
echo "<th>Título</th>";
echo "<th>Punt.</th>";


$i=1;	//Contador para contar las filas impares y ponerlas de distinto color


$fech=$miconexion->query("SELECT * FROM titulopelicula,titulo,fechastitulos WHERE titulo.id_titulo=fechastitulos.id_titulo and titulo.id_titulo=titulopelicula.id_pelicula and YEAR(fecha)=2017 ORDER BY fecha ASC");

while ($rows = $fech->fetch_assoc()) {
	$fecha = explode("-",$rows["fecha"]); 
echo "<tr>";
$fechcompl=$fecha[2].'/'.$fecha[1].'/'.$fecha[0];

echo "<td align=center>".$i."</td>";
echo '<td><a name="'.$fechcompl.'"></a> '.$fechcompl.'</td>';
echo "<td align=center>".$rows["formato"]."</td>";
echo '<td align=center>'.$rows["año"].'</td>';
echo '<td align=center><img  width=35 height=50 src=poster/'.$rows["poster"].'></td>';
echo '<td align=center><a href=titulo.php?id='.$rows["id_titulo"].'>'.$rows["titulo"].'</a></td>';
echo '<td align=center>'.$rows["puntuacion"].'</td>';
$i++;
}
echo "</table><a name=final></a><br>";
echo "<a href=visor.php?v=years/index.php>Volver a anuarios</a><br>";
?>
