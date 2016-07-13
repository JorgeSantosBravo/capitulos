<?php
include ("conexion.php");
$fech=$miconexion->query("SELECT * FROM director,serie,creadoresserie WHERE serie.id_serie=creadoresserie.id_sserie and creadoresserie.id_ccreador=director.id_director ");

while ($rows = $fech->fetch_assoc()) {
echo $rows["Nombre"]." ".$rows["Nomdir"]."<br>";
}
?>