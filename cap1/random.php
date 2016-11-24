<?php

include "conexion.php";

$consulta=$miconexion->query("SELECT * FROM titulopelicula order by rand() limit 1"); 
while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a>";
}


?>