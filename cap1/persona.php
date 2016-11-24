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
$consultapelis=$miconexion->query("SELECT * FROM persona,titulopelicula,titulosdirectores WHERE titulosdirectores.id_titulo=titulopelicula.id_pelicula and persona.id_persona=titulosdirectores.id_director and persona.id_persona=".$_GET["id"]." ORDER BY titulopelicula.año ASC"); 
$numpelis=$miconexion->affected_rows;
if ($numpelis>=1){
echo "Director (películas) ($numpelis):<br>";
while ($rows = $consultapelis->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_titulo"].">".$rows["año"]." - ".$rows["titulo"]."</a><br>";
}

}

$consultaseries=$miconexion->query("SELECT * FROM titulosdirectores,persona,titulocapitulo,tituloserie WHERE titulocapitulo.serie=tituloserie.id_serie and titulosdirectores.id_titulo=titulocapitulo.id_capitulo and titulosdirectores.id_director=persona.id_persona and id_persona LIKE '".$_GET["id"]."'"); 
$numseries=$miconexion->affected_rows;
if ($numseries>=1){
echo "<br>Director (capítulos) ($numseries):<br>";
while ($rows = $consultaseries->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_titulo"].">".$rows["titulo_serie"]." - ".$rows["titulo_capitulo"]." #".$rows["s"].".".$rows["e"]."</a><br>";

}
	 }

	 	 
$actores=$miconexion->query("SELECT * FROM persona,titulopelicula,peliculasactores WHERE persona.id_persona=peliculasactores.id_actor and titulopelicula.id_pelicula=peliculasactores.id_pelicula and persona.id_persona=".$_GET["id"]." ORDER BY titulopelicula.año ASC"); 
$numactor=$miconexion->affected_rows;
if ($numactor>=1){
echo "<br>Actor ($numactor):<br>";
while ($rows = $actores->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["año"]." - ".$rows["titulo"]."</a><br>";
}
	 }	 
	 
	 
$resultado=$miconexion->query("SELECT * FROM creadoresserie,tituloserie,persona WHERE creadoresserie.id_sserie=tituloserie.id_serie and creadoresserie.id_ccreador=persona.id_persona and id_ccreador LIKE '".$_GET["id"]."'");
$filas=$miconexion->affected_rows;
if($filas>=1){
$stocke=$miconexion->query("SELECT * FROM creadoresserie,tituloserie,persona WHERE creadoresserie.id_sserie=tituloserie.id_serie and creadoresserie.id_ccreador=persona.id_persona and id_ccreador LIKE '".$_GET["id"]."'"); 
echo "<br>Creador ($filas):<br>";
while ($rows = $stocke->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_serie"].">".$rows["titulo_serie"]."</a><br>";

}
	 }
	 
$actores=$miconexion->query("SELECT * FROM peliculasguionistas,titulo,titulopelicula,persona WHERE titulopelicula.id_pelicula=titulo.id_titulo and titulo.id_titulo=peliculasguionistas.id_pelicula and persona.id_persona=peliculasguionistas.id_guionista and persona.id_persona =".$_GET["id"]." ORDER BY titulopelicula.año ASC"); 
$numactor=$miconexion->affected_rows;
if ($numactor>=1){
echo "<br>Guionista ($numactor):<br>";
while ($rows = $actores->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_titulo"].">".$rows["año"]." - ".$rows["titulo"]."</a><br>";
}
	 }
$actores=$miconexion->query("SELECT * FROM peliculasmusicos,titulo,titulopelicula,persona WHERE titulopelicula.id_pelicula=titulo.id_titulo and  titulo.id_titulo=peliculasmusicos.id_pelicula and persona.id_persona=peliculasmusicos.id_musico and persona.id_persona =".$_GET["id"]." ORDER BY titulopelicula.año ASC"); 
$numactor=$miconexion->affected_rows;
if ($numactor>=1){
echo "<br>Músico ($numactor):<br>";
while ($rows = $actores->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_titulo"].">".$rows["año"]." - ".$rows["titulo"]."</a><br>";
}
	 }
	 
$actores=$miconexion->query("SELECT * FROM peliculasfotografos,titulo,titulopelicula,persona WHERE  titulopelicula.id_pelicula=titulo.id_titulo and titulo.id_titulo=peliculasfotografos.id_pelicula and persona.id_persona=peliculasfotografos.id_foto and persona.id_persona =".$_GET["id"]." ORDER BY titulopelicula.año ASC"); 
$numactor=$miconexion->affected_rows;
if ($numactor>=1){
echo "<br>Fotografía ($numactor):<br>";
while ($rows = $actores->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_titulo"].">".$rows["año"]." - ".$rows["titulo"]."</a><br>";
}
	 }	 

?>