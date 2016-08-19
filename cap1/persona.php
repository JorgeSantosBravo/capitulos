<link rel="stylesheet" type="text/css" media="screen" href="Estilos/enlace.css">
<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<?php
include "header/header.php";
include "conexion.php";

$stocke=$miconexion->query("SELECT * FROM persona WHERE id_persona LIKE '".$_GET["id"]."'"); 
while ($rows = $stocke->fetch_assoc()){
echo "<title>".$rows["Nombre_persona"]."</title>";
echo "<h2>".$rows["Nombre_persona"]."</h2><br>";
}
$consultapelis=$miconexion->query("SELECT * FROM persona,peliculas,peliculasdirectores WHERE peliculasdirectores.id_pelicula=peliculas.id_pelicula and persona.id_persona=peliculasdirectores.id_director and persona.id_persona=".$_GET["id"]." ORDER BY peliculas.año ASC"); 
$numpelis=$miconexion->affected_rows;
if ($numpelis>=1){
echo "Películas ($numpelis):<br>";
while ($rows = $consultapelis->fetch_assoc()){
echo "<a href=pelicula.php?id=".$rows["id_pelicula"].">".$rows["año"]." - ".$rows["titulo"]."</a><br>";
}
	 }
$consultaseries=$miconexion->query("SELECT * FROM capitulosdirectores,persona,capitulo,serie WHERE capitulo.serie=serie.id_serie and capitulosdirectores.id_capitulo=capitulo.id_capitulo and capitulosdirectores.id_director=persona.id_persona and id_director LIKE '".$_GET["id"]."'"); 
$numseries=$miconexion->affected_rows;
if ($numseries>=1){
echo "<br>Capítulos ($numseries):<br>";
while ($rows = $consultaseries->fetch_assoc()){
echo "<a href=capitulo.php?id=".$rows["id_capitulo"].">".$rows["Nombre"]." - ".$rows["Titulo"]." #".$rows["s"].".".$rows["e"]."</a><br>";
}
	 }
	 	 
$actores=$miconexion->query("SELECT * FROM persona,peliculas,peliculasactores WHERE persona.id_persona=peliculasactores.id_actor and persona.id_persona=peliculasactores.id_actor and peliculas.id_pelicula=peliculasactores.id_pelicula and persona.id_persona=".$_GET["id"]." ORDER BY peliculas.año ASC"); 
$numactor=$miconexion->affected_rows;
if ($numactor>=1){
echo "<br>Actor ($numactor):<br>";
while ($rows = $actores->fetch_assoc()){
echo "<a href=pelicula.php?id=".$rows["id_pelicula"].">".$rows["año"]." - ".$rows["titulo"]."</a><br>";
}
	 }	 
	 
	 
$resultado=$miconexion->query("SELECT * FROM creadoresserie,serie,persona WHERE creadoresserie.id_sserie=serie.id_serie and creadoresserie.id_ccreador=persona.id_persona and id_ccreador LIKE '".$_GET["id"]."'");
$filas=$miconexion->affected_rows;
if($filas>=1){
$stocke=$miconexion->query("SELECT * FROM creadoresserie,serie,persona WHERE creadoresserie.id_sserie=serie.id_serie and creadoresserie.id_ccreador=persona.id_persona and id_ccreador LIKE '".$_GET["id"]."'"); 
echo "<br>Creador ($filas):<br>";
while ($rows = $stocke->fetch_assoc()){
echo "<a href=serie.php?id=".$rows["id_serie"].">".$rows["Nombre"]."</a><br>";

}
	 }
	 
$actores=$miconexion->query("SELECT * FROM peliculasguionistas,peliculas,persona WHERE peliculas.id_pelicula=peliculasguionistas.id_pelicula and persona.id_persona=peliculasguionistas.id_guionista and persona.id_persona =".$_GET["id"]." ORDER BY peliculas.año ASC"); 
$numactor=$miconexion->affected_rows;
if ($numactor>=1){
echo "<br>Guionista ($numactor):<br>";
while ($rows = $actores->fetch_assoc()){
echo "<a href=pelicula.php?id=".$rows["id_pelicula"].">".$rows["año"]." - ".$rows["titulo"]."</a><br>";
}
	 }
$actores=$miconexion->query("SELECT * FROM peliculasmusicos,peliculas,persona WHERE peliculas.id_pelicula=peliculasmusicos.id_pelicula and persona.id_persona=peliculasmusicos.id_musico and persona.id_persona =".$_GET["id"]." ORDER BY peliculas.año ASC"); 
$numactor=$miconexion->affected_rows;
if ($numactor>=1){
echo "<br>Músico ($numactor):<br>";
while ($rows = $actores->fetch_assoc()){
echo "<a href=pelicula.php?id=".$rows["id_pelicula"].">".$rows["año"]." - ".$rows["titulo"]."</a><br>";
}
	 }
	 
$actores=$miconexion->query("SELECT * FROM peliculasfotografos,peliculas,persona WHERE peliculas.id_pelicula=peliculasfotografos.id_pelicula and persona.id_persona=peliculasfotografos.id_foto and persona.id_persona =".$_GET["id"]." ORDER BY peliculas.año ASC"); 
$numactor=$miconexion->affected_rows;
if ($numactor>=1){
echo "<br>Fotografía ($numactor):<br>";
while ($rows = $actores->fetch_assoc()){
echo "<a href=pelicula.php?id=".$rows["id_pelicula"].">".$rows["año"]." - ".$rows["titulo"]."</a><br>";
}
	 }	 
	 
?>