<link rel="stylesheet" type="text/css" media="screen" href="Estilos/pelicula.css">
<head>
<style>
@import 'https://fonts.googleapis.com/css?family=Libre+Baskerville';
</style>
</head>
<?php

include "header/header.php";
include "conexion.php";


$peli=$miconexion->query("SELECT * FROM peliculas WHERE id_pelicula LIKE '".$_GET["id"]."'"); 

while ($rows = $peli->fetch_assoc()) {
/*TÍTULO:*/ echo "<title>".$rows["titulo"]."</title>";
echo "<table class=imagen><tr><td>";
echo "<img class=poster src=poster/".$rows["poster"]." width=230 height=345></td></tr><tr><td class=puntuacion>";
$punt=$miconexion->query("SELECT * FROM peliculas,fechaspeliculas WHERE peliculas.id_pelicula=fechaspeliculas.id_pelicula and peliculas.id_pelicula LIKE '".$_GET["id"]."' ORDER BY fechaspeliculas.fecha DESC LIMIT 1");
while ($rows2 = $punt->fetch_assoc()) {

echo $rows2["puntuacion"];

}
echo "</td></tr></table>";
echo "<div id=datos>
<table class=datos>
<tr><th align=left colspan=3>".$rows["titulo"]."</th></tr>
<tr><td class=cabeza>Título orig.</td><td> </td><td>".$rows["titulo_original"]."</td></tr>
<tr><td class=cabeza>Año</td><td> </td><td>".$rows["año"]."</td></tr>
<tr><td class=cabeza>Duración</td><td> </td><td>".$rows["duracion"]."</td></tr>
<tr><td class=cabeza>País</td><td> </td><td>".$rows["pais"]."</td></tr>
<tr><td class=cabeza valign=top>Dirección</td><td> </td><td>
";

$dire=$miconexion->query("SELECT * FROM peliculasdirectores,persona WHERE peliculasdirectores.id_director=persona.id_persona and id_pelicula LIKE '".$_GET["id"]."'"); 
$a = array();
while ($rows2 = $dire->fetch_assoc()) {
array_push($a, "<a href=persona.php?id=".$rows2["id_persona"].">".$rows2["Nombre_persona"]."</a>");
}
$final= implode(', ', $a);
if (!$final==""){
echo $final."</td></tr>"; 
}
echo "<tr><td class=cabeza valign=top>Guión</td><td> </td><td>
";

$guion=$miconexion->query("SELECT * FROM peliculasguionistas,persona WHERE peliculasguionistas.id_guionista=persona.id_persona and id_pelicula LIKE '".$_GET["id"]."'"); 
$a = array();
while ($rows2 = $guion->fetch_assoc()) {
array_push($a, "<a href=persona.php?id=".$rows2["id_persona"].">".$rows2["Nombre_persona"]."</a>");
}
$final= implode(', ', $a);
if (!$final==""){
echo $final."</td></tr>"; 
}

echo "<tr><td class=cabeza valign=top>Música</td><td> </td><td>";
$music=$miconexion->query("SELECT * FROM peliculasmusicos,persona WHERE peliculasmusicos.id_musico=persona.id_persona and id_pelicula LIKE '".$_GET["id"]."'"); 
$a = array();
while ($rows2 = $music->fetch_assoc()) {
array_push($a, "<a href=persona.php?id=".$rows2["id_persona"].">".$rows2["Nombre_persona"]."</a>");
}
$final= implode(', ', $a);
if (!$final==""){
echo $final."</td></tr>"; 
}

echo "<tr><td class=cabeza valign=top>Fotografía</td><td> </td><td>";
$cast=$miconexion->query("SELECT * FROM peliculasfotografos,persona WHERE peliculasfotografos.id_foto=persona.id_persona and id_pelicula LIKE '".$_GET["id"]."'"); 
$a = array();
while ($rows2 = $cast->fetch_assoc()) {
array_push($a, "<a href=persona.php?id=".$rows2["id_persona"].">".$rows2["Nombre_persona"]."</a>");
}
$final= implode(', ', $a);
if (!$final==""){
echo $final."</td></tr>"; 
}
echo "<tr><td class=cabeza valign=top>Reparto</td><td> </td><td>";
$cast=$miconexion->query("SELECT * FROM peliculasactores,persona WHERE peliculasactores.id_actor=persona.id_persona and id_pelicula LIKE '".$_GET["id"]."'"); 
$a = array();
while ($rows2 = $cast->fetch_assoc()) {
array_push($a, "<a href=persona.php?id=".$rows2["id_persona"].">".$rows2["Nombre_persona"]."</a>");
}
$final= implode(', ', $a);
if (!$final==""){
echo $final."</td></tr>"; 
}

echo "<tr><td class=cabeza valign=top>Productora</td><td> </td><td>";
$cast=$miconexion->query("SELECT * FROM peliculasproductoras,productora WHERE peliculasproductoras.id_productora=productora.id_productora and id_pelicula LIKE '".$_GET["id"]."'"); 
$a = array();
while ($rows2 = $cast->fetch_assoc()) {
array_push($a, "<a href=productora.php?id=".$rows2["id_productora"].">".$rows2["nombre_productora"]."</a>");
}
$final= implode(', ', $a);
if (!$final==""){
echo $final."</td></tr>"; 
}
echo "<tr><td class=cabeza valign=top>Géneros</td><td> </td><td>";
$cast=$miconexion->query("SELECT * FROM peliculasgeneros,genero WHERE peliculasgeneros.id_genero=genero.id_genero and id_pelicula LIKE '".$_GET["id"]."'"); 
$a = array();
while ($rows2 = $cast->fetch_assoc()) {
array_push($a, "<a href=genero.php?id=".$rows2["id_genero"].">".$rows2["nombre_genero"]."</a>");
}
$final= implode(', ', $a);
if (!$final==""){
echo $final." | ";
}
$cast=$miconexion->query("SELECT * FROM peliculastemas,tema WHERE peliculastemas.id_tema=tema.id_tema and id_pelicula LIKE '".$_GET["id"]."'"); 
$a = array();
while ($rows2 = $cast->fetch_assoc()) {
array_push($a, "<a href=tema.php?id=".$rows2["id_tema"].">".$rows2["nombre_tema"]."</a>");
}
$final= implode(', ', $a);
echo $final."</td></tr>"; 


"</table></div>";
}

echo "<table class=visionados><tr><td>";
$numero=$miconexion->query("SELECT COUNT(*) as con FROM fechaspeliculas WHERE id_pelicula LIKE '".$_GET["id"]."'");


if ($rows=$numero->fetch_assoc()){
	echo "Has visto esta película ".$rows["con"];
	
	if ($rows["con"]==1){
	echo " vez";
	
	}else{
		echo " veces";
	}
echo	"</td></tr>";
}

/*
$resultado=$miconexion->query("SELECT * FROM peliculas,fechaspeliculas WHERE peliculas.id_pelicula=fechaspeliculas.id_pelicula and peliculas.id_pelicula LIKE '$_GET[id]'");

echo "<table border=1><tr><td>Fecha</td><td>Punt.</td><td>FilmAffinity</td><td>IMDB</td><td>RottenTomatoes</td><td>AudienceScore</td><td>Letterboxd</td><td>Media</td><td>Media prof.</td></tr>";
$i=1;
$j=1;
$pu=0;	//CONTADOR PARA HACER LA MEDIA
$fa=0;
$imdb=0;
$rt=0;
$as=0;
$lb=0;
while ($rows = $resultado->fetch_assoc()) {
   echo "<tr><td>";
  $fe=explode("-", $rows["fecha"]);
 echo $fe[2]."/".$fe[1]."/".$fe[0];
 echo "</td><td align=center> ";
   $pu=$rows["puntuacion"];
   echo  $rows["puntuacion"]."</td>";
   echo "<td align=center>";
	if (!$rows["filmaffinity"]==0){
		echo $rows["filmaffinity"];
		$fa=$rows["filmaffinity"];
		$i++;
		$j++;
	}
	echo "</td>";
	 echo "<td align=center>";
	if (!$rows["imdb"]==0){
		echo $rows["imdb"];
		$imdb=$rows["imdb"];
		$i++;
		$j++;
	}
	echo "</td>";
	 echo "<td align=center>";
	if (!$rows["tomatometer"]==0){
		echo $rows["tomatometer"];
		$rt=$rows["tomatometer"];
		$i++;
		$j++;
	}
	echo "</td>";
	echo "<td align=center>";
	if (!$rows["audiencescore"]==0){
		echo $rows["audiencescore"];
		$as=$rows["audiencescore"];
		$i++;
	}
	echo "</td>";
	echo "<td align=center>";
	if (!$rows["letterboxd"]==0){
		echo $rows["letterboxd"];
		$lb=$rows["letterboxd"];
		$i++;
		$j++;
	}
	echo "</td>";
   echo "<td align=center>";
   $media=($pu+$fa+$imdb+$rt+$as+$lb)/$i;
   echo number_format($media, 3);
   echo "</td>";
   echo "<td align=center>";
   if ($j>1){
	   $j-=1;
   }
   $mediaprof=($fa+$imdb+$rt+$lb)/$j;
   if (!$mediaprof==0){
   echo number_format($mediaprof, 3);
   }
   echo "</td>";
   $i=1;		//VOLVEMOS A PONER EL CONTADOR EN SU POSICIÓN INICIAL
   $j=1;
}
echo "</table>";
*/


echo "</table>";


?>