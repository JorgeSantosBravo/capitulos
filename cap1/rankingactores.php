<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<link rel="stylesheet" type="text/css" media="screen" href="Estilos/enlace.css">
<title>Ránking de actores</title>
<?php
include "header/header.php";
include "conexion.php";
$i=1;
$consulta=$miconexion->query("SELECT *,COUNT(*) as con FROM persona,titulopelicula,peliculasactores WHERE persona.id_persona=peliculasactores.id_actor and titulopelicula.id_pelicula=peliculasactores.id_pelicula GROUP BY persona.id_persona ORDER BY con DESC LIMIT 100"); 
echo "<table align=center><tr><th>Pos.</th><th>Nombre</th><th>Num</th></tr>";
while ($rows = $consulta->fetch_assoc()){
	echo "<tr><td>".$i."</td><td><a href=persona.php?id=".$rows["id_persona"].">".$rows["Nombre_persona"]."</a></td><td>".$rows["con"]."</td></tr>";
$i++;
	}
echo "</table>";
?>