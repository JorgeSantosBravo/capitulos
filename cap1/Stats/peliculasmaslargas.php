<title>Películas más largas</title>
<style>
table{
	
	text-align:center;
}

</style>
<?php
include "conexion.php";

$stocke=$miconexion->query("SELECT * FROM titulopelicula ORDER BY duracion DESC LIMIT 20"); 
echo "<table align=center border=1>
<tr><th>Nº</th>
<th>Año</th>
<th>Título</th>
<th>Minutos</th>
</tr>

";
$i=1;
while ($rows = $stocke->fetch_assoc()){

echo "<tr><td>".$i."</td><td>".$rows["año"]."</td><td><a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td><td>".$rows["duracion"]."</td></tr>";
$i++;
}


echo "</table>"
?>