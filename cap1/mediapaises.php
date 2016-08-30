<?php
include "conexion.php";


$consulta=$miconexion->query("SELECT pais,AVG(fechaspeliculas.puntuacion) as media FROM peliculas,fechaspeliculas WHERE peliculas.id_pelicula=fechaspeliculas.id_pelicula GROUP BY pais ORDER BY media DESC"); 
echo "<table border=1 align=center>";
echo "<th><font face='Trebuchet MS'>País</th>";
echo "<th><font face='Trebuchet MS'>Media</th>";
while ($rows = $consulta->fetch_assoc()) {
if (!$rows["pais"]==""){
echo "<tr><td align=center><a href=pais.php?id=".$rows["pais"].">".$rows["pais"]."</a></td>";
echo "<td align=center>".$rows["media"]."</td></tr>";
}
}
echo "</table><br>";

?>