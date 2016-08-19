<title>2016</title>
<?php
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


$fech=$miconexion->query("SELECT * FROM capitulo,serie,capitulosfecha WHERE capitulo.id_capitulo = capitulosfecha.id_capitulo and serie.id_serie=capitulo.serie and YEAR(fecha)=2016 ORDER BY (fecha),capitulosfecha.id_capitulo ASC");

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
echo "<td align=center>".$rows["medio"]."</td>";
echo "<td align=center>".$rows["formato"]."</td>";
echo '<td align=center><a href=serie.php?id='.$rows["id_serie"].'>'.$rows["Nombre"].'</a></td>';
echo '<td align=center>S'.$rows["s"].'E'.$rows["e"].'</td>';
echo "<td align=center><a href=capitulo.php?id=".$rows["id_capitulo"].">".$rows["Titulo"]."</a></td>";

$stocke=$miconexion->query("SELECT * FROM capitulosdirectores,persona WHERE capitulosdirectores.id_director=persona.id_persona and capitulosdirectores.id_capitulo LIKE '".$rows["id_capitulo"]."'"); 
$a = array();
while ($rows2 = $stocke->fetch_assoc()) {
   array_push($a, "<a href=persona.php?id=".$rows2["id_director"].">".$rows2["Nombre_persona"]."</a>");
}
$final= implode(', ', $a);
echo "<td align=center>".$final."</td>";
echo "<td align=center>".$rows["Duracion"]."</td></tr>";
$i++;
}
echo "</table><br></font><a name='final'> </a>";

echo "<a href='visor.php?v=years/index.php'>Volver a anuarios</a><br>";
?>
