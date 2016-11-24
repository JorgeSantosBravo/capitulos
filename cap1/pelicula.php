<link rel="stylesheet" type="text/css" media="screen" href="Estilos/pelicula.css">
<head>
<style>
@import 'https://fonts.googleapis.com/css?family=Libre+Baskerville';
</style>
</head>
<?php

include "header/header.php";
include "conexion.php";


$peli=$miconexion->query("SELECT * FROM titulo,titulopelicula WHERE titulo.id_titulo=titulopelicula.id_pelicula and id_pelicula LIKE '".$_GET["id"]."'"); 

while ($rows = $peli->fetch_assoc()) {
/*TÍTULO:*/ echo "<title>".$rows["titulo"]."</title>";
echo "<table class=imagen><tr><td colspan=6>";
echo "<img class=poster src=poster/".$rows["poster"]." width=230 height=345></td></tr>";


$punt=$miconexion->query("SELECT * FROM titulo,fechastitulos WHERE titulo.id_titulo=fechastitulos.id_titulo and titulo.id_titulo LIKE '".$_GET["id"]."' ORDER BY fechastitulos.fecha DESC LIMIT 1");
while ($rows2 = $punt->fetch_assoc()) {

echo "<tr><td colspan=6 class=puntuacion>".$rows2["puntuacion"]."</td></tr><tr>";
if (!is_null($rows2["filmaffinity"])){
echo "<td  size=1 align=center width=1><img src=iconos/filmaffinity.png width=24 height=24>";}
if (!is_null($rows2["imdb"])){
echo "<td  size=1 align=center><img src=iconos/imdb.png width=24 height=24>";}
if (is_null($rows2["tomatometer"])){
	
}else if ($rows2["tomatometer"]>=6.0&&$rows2["tomatometer"]<=7.4){
echo "<td  size=1 align=center><img src=iconos/tomato.png width=24 height=24>";}
else if ($rows2["tomatometer"]<=5.9){
echo "<td  size=1 align=center ><img src=iconos/rotten.png width=24 height=24>";}	
else if ($rows2["tomatometer"]>7.4){
	echo "<td  size=1 align=center><img src=iconos/fresh.png width=24 height=24>";}
if (is_null($rows2["audiencescore"])){
}else if ($rows2["audiencescore"]>=5){
echo "<td size=1 align=center><img src=iconos/pc.png width=24 height=24>";}	
else{
	echo "<td  size=1 align=center><img src=iconos/badpc.png width=24 height=24>";}
if (!is_null($rows2["letterboxd"])){
echo "<td  size=1 align=center><img src=iconos/lb.png width=24 height=24>";	}

echo "</tr>";
if (!is_null($rows2["filmaffinity"])){
echo "<td class=puntuacion>".$rows2["filmaffinity"]."</td>";}
if (!is_null($rows2["imdb"])){
echo "<td class=puntuacion>".$rows2["imdb"]."</td>";}
if (!is_null($rows2["tomatometer"])){
echo "<td class=puntuacion>".$rows2["tomatometer"]."</td>";}
if (!is_null($rows2["audiencescore"])){
echo "<td class=puntuacion>".$rows2["audiencescore"]."</td>";}
if (!is_null($rows2["letterboxd"])){
echo "<td class=puntuacion>".$rows2["letterboxd"]."</td>";}

}
echo "</td></tr></table>";
echo "<table class=datos>
<tr><th align=left colspan=3>".$rows["titulo"]."</th></tr>
<tr><td class=cabeza>Título orig.</td><td> </td><td>".$rows["titulo_original"]."</td></tr>
<tr><td class=cabeza>Año</td><td> </td><td>".$rows["año"]."</td></tr>
<tr><td class=cabeza>Duración</td><td> </td><td>".$rows["duracion"]."</td></tr>
<tr><td class=cabeza>País</td><td> </td><td>".$rows["pais"]."</td></tr>
<tr><td class=cabeza valign=top>Dirección</td><td> </td><td>
";

$dire=$miconexion->query("SELECT * FROM titulosdirectores,persona WHERE titulosdirectores.id_director=persona.id_persona and id_titulo LIKE '".$_GET["id"]."'"); 
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
echo $final; 
echo "</td></tr>";
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


"</table>";
}

echo "<table class=visionados><tr><td>";
$numero=$miconexion->query("SELECT COUNT(*) as con FROM fechastitulos WHERE id_titulo LIKE '".$_GET["id"]."'");


if ($rows=$numero->fetch_assoc()){
	echo "Has visto esta película ".$rows["con"];
	
	if ($rows["con"]==1){
	echo " vez";
	
	}else{
		echo " veces";
	}
echo	"</td></tr>";
}

$resultado=$miconexion->query("SELECT * FROM titulo,fechastitulos WHERE titulo.id_titulo=fechastitulos.id_titulo and titulo.id_titulo LIKE '$_GET[id]' ORDER BY fecha ASC");

   while ($rows=$resultado->fetch_assoc()){
echo "<tr><td>";
  $fe=explode("-", $rows["fecha"]);
 echo $fe[2]."/".$fe[1]."/".$fe[0];
 echo "</td></tr>";
   }

echo "</table>";


?>
<style type="text/css">
  .boton{
        font-size:10px;
        font-weight:bold;
        color:white;
        background:#638cb5;
        border:0px;
        width:80px;
        height:19px;
		position: absolute;
	top: 130px; 
	right: 270px;
       }
</style>
<div id="boton">
<?php


echo "<input type='button' value='Editar' onclick=window.location.href='edit/pelicula.php?id=".$_GET["id"]."' class='boton'>";
?>
</div>