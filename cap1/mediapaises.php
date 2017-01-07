<link rel="stylesheet" type="text/css" media="screen" href="Estilos/enlace.css">
<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<?php
include "conexion.php";

/*
$consulta=$miconexion->query("SELECT pais,AVG(fechastitulos.puntuacion) as media FROM peliculas,fechastitulos WHERE titulo.id_titulo=fechastitulos.id_titulo GROUP BY pais ORDER BY media DESC"); 
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

*/

$consulta=$miconexion->query("SELECT *,AVG(puntuacion) as mediaa FROM titulopelicula,persona,titulosdirectores WHERE persona.id_persona=titulosdirectores.id_director and titulosdirectores.id_titulo=titulopelicula.id_pelicula GROUP BY titulosdirectores.id_director ORDER BY mediaa DESC"); 
echo "<table border=1 align=center>";
echo "<th><font face='Trebuchet MS'>Director</th>";
echo "<th><font face='Trebuchet MS'>Media</th>";
echo "<th><font face='Trebuchet MS'>Películas</th>";
while ($rows = $consulta->fetch_assoc()) {

$cont=$miconexion->query("SELECT COUNT(DISTINCT(id_pelicula)) as con FROM titulosdirectores,titulopelicula,fechastitulos WHERE fechastitulos.id_titulo=titulopelicula.id_pelicula and titulosdirectores.id_titulo=titulopelicula.id_pelicula and titulosdirectores.id_director=".$rows["id_director"]); 
while ($rows2 = $cont->fetch_assoc()) {
if ($rows2["con"]>=4){
if (!$rows["Nombre_persona"]==""){
echo "<tr><td align=center><a href=persona.php?id=".$rows["id_persona"].">".$rows["Nombre_persona"]."</a></td>";
echo "<td align=center>".number_format($rows["mediaa"], 2)."</td>";


echo "<td align=center>".$rows2["con"]."</td></tr>";
}
}
}
}
echo "</table><br>";

$consulta=$miconexion->query("SELECT *,AVG(puntuacion) as mediaa FROM titulopelicula,persona,peliculasactores WHERE persona.id_persona=peliculasactores.id_actor and peliculasactores.id_pelicula=titulopelicula.id_pelicula GROUP BY peliculasactores.id_actor ORDER BY mediaa DESC"); 
echo "<table border=1 align=center>";
echo "<th><font face='Trebuchet MS'>Director</th>";
echo "<th><font face='Trebuchet MS'>Media</th>";
echo "<th><font face='Trebuchet MS'>Películas</th>";
while ($rows = $consulta->fetch_assoc()) {

$cont=$miconexion->query("SELECT COUNT(DISTINCT(titulopelicula.id_pelicula)) as con FROM peliculasactores,titulopelicula,fechastitulos WHERE fechastitulos.id_titulo=titulopelicula.id_pelicula and peliculasactores.id_pelicula=titulopelicula.id_pelicula and peliculasactores.id_actor=".$rows["id_persona"].""); 
while ($rows2 = $cont->fetch_assoc()) {
if ($rows2["con"]>=5){
if (!$rows["Nombre_persona"]==""){
echo "<tr><td align=center><a href=persona.php?id=".$rows["id_persona"].">".$rows["Nombre_persona"]."</a></td>";
echo "<td align=center>".number_format($rows["mediaa"], 2)."</td>";


echo "<td align=center>".$rows2["con"]."</td></tr>";
}
}
}
}
echo "</table><br>";
?>