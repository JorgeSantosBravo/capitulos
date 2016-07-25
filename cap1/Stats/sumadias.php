<?php
include "conexion.php";

$stocke=$miconexion->query("SELECT fecha,SUM(Duracion) as suma FROM capitulo GROUP BY fecha ORDER BY suma DESC LIMIT 201"); 
echo "<table align=center border=1>
<tr><th>Nº</th>
<th>Día</th>
<th>Minutos</th>
</tr>

";
$i=1;
while ($rows = $stocke->fetch_assoc()){
$fecha = explode("-",$rows["fecha"]); 

if ($fecha[2]=="00"){}else{
	$fechcompl=$fecha[2]."/".$fecha[1]."/".$fecha[0];
echo "<tr><td>".$i."</td><td><a href=visor.php?v=years/".$fecha[0]."/m".$fecha[0].".php#$fechcompl>".$fechcompl."</a></td><td>".$rows["suma"]."</td></tr>";
$i++;
}
}

echo "</table>"
?>