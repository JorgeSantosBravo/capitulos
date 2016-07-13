<link rel="stylesheet" type="text/css" media="screen" href="fondo.css">
<link rel="stylesheet" type="text/css" media="screen" href="../trebuchet.css">
<title>Mostrar</title>
<?php

include ("../conexion.php");
echo "<body><table border=1 align=center>";
echo "<th bgcolor=white>Nº</th>";
echo "<th bgcolor=white>Fecha</th>";
echo "<th bgcolor=white>Medio</th>";
echo "<th bgcolor=white>Formato</th>";
echo "<th bgcolor=white>Serie</th>";
echo "<th bgcolor=white>SE</th>";
echo "<th bgcolor=white>Título</th>";
echo "<th bgcolor=white>Director</th>";
echo "<th bgcolor=white>Duración</th>";


$i=1;	//Contador para contar las filas impares y ponerlas de distinto color


$fech=$miconexion->query("SELECT * FROM capitulo,serie WHERE serie.id_serie=capitulo.serie ORDER BY (fecha) ASC");

while ($rows = $fech->fetch_assoc()) {
	$fecha = explode("-",$rows["fecha"]); 
	if ($fecha[0]==2016){
echo "<tr";
if ($i%2!=0)
{echo" bgcolor=#E6E6E6>";}
else{
	echo" bgcolor=white>";
}
echo '<td>'.$i.'</td>';
echo '<td>'.$fecha[2].'/'.$fecha[1].'/'.$fecha[0].'</td>';
echo "<td align=center>".$rows["medio"]."</td>";
echo "<td align=center>".$rows["formato"]."</td>";
echo '<td align=center>'.$rows["Nombre"].'</td>';
echo '<td align=center>S'.$rows["s"].'E'.$rows["e"].'</td>';
echo "<td align=center>".$rows["Titulo"]."</td>";

$stocke=$miconexion->query("SELECT * FROM capitulosdirectores,director WHERE capitulosdirectores.id_director=director.id_director and capitulosdirectores.id_capitulo LIKE '".$rows["id_capitulo"]."'"); 
$a = array();
while ($rows2 = $stocke->fetch_assoc()) {
   array_push($a, $rows2["Nomdir"]);
}
$final= implode(', ', $a);
echo "<td align=center>".$final."</td>";
echo "<td align=center>".$rows["Duracion"]."</td></tr>";
$i++;

}
}
echo "</table><br></font>";
echo "<a href='index.php'>Volver a anuarios</a><br>";
echo "<a href='../index.php'>Volver a inicio</a>";
?>
