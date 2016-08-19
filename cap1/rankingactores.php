<?php
include "header/header.php";
include "conexion.php";

$consulta=$miconexion->query("SELECT *,COUNT(*) as con FROM persona,peliculas,peliculasactores WHERE persona.id_persona=peliculasactores.id_actor and peliculas.id_pelicula=peliculasactores.id_pelicula GROUP BY persona.id_persona ORDER BY con DESC"); 
while ($rows = $consulta->fetch_assoc()){
	echo $rows["Nombre_persona"]." - ".$rows["con"]."<br>";
}

?>