<title>Capítulos más largos</title>
<style>
table{
	
	text-align:center;
}

</style>
<?php
include "conexion.php";

$stocke=$miconexion->query("SELECT * FROM titulocapitulo,temporada,tituloserie WHERE titulocapitulo.serie=tituloserie.id_serie AND titulocapitulo.ns=temporada.id_temporada  GROUP BY id_capitulo ORDER BY duracion DESC LIMIT 20"); 
echo "<table align=center border=1>
<tr><th>Nº</th>
<th>Serie</th>
<th>SE</th>
<th>Título</th>
<th>Minutos</th>
</tr>

";
$i=1;
while ($rows = $stocke->fetch_assoc()){

echo "<tr><td>".$i."</td><td><a href=titulo.php?id=".$rows["id_serie"].">".$rows["titulo_serie"]."</a></td><td>S".$rows["numero_temporada"]."E".$rows["e"]."</td><td>".$rows["titulo_capitulo"]."</td><td>".$rows["duracion"]."</td></tr>";
$i++;
}


echo "</table>"
?>