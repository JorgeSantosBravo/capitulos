<link rel="stylesheet" type="text/css" media="screen" href="Estilos/pelicula.css">
<head>
<style>
@import 'https://fonts.googleapis.com/css?family=Libre+Baskerville';
</style>
</head>
<?php

include "header/header.php";
include "conexion.php";
function colores ($puntuacion){
	$color="";
	if ($puntuacion>=0&&$puntuacion<1){
$color="F32A22";
}else if ($puntuacion>=1&&$puntuacion<2){
$color="F74B1B";
}else if ($puntuacion>=2&&$puntuacion<3){
$color="FA6815";
}else if ($puntuacion>=3&&$puntuacion<4){
$color="F2871F";
}else if ($puntuacion>=4&&$puntuacion<5){
$color="FE9B02";
}else if ($puntuacion>=5&&$puntuacion<6){
$color="F8B504";
}else if ($puntuacion>=6&&$puntuacion<7){
$color="FACE0B";
}else if ($puntuacion>=7&&$puntuacion<8){
$color="BFD207";
}else if ($puntuacion>=8&&$puntuacion<9){
$color="65C621";
}else if ($puntuacion>=9&&$puntuacion<10){
$color="4EC621";
}else if ($puntuacion==10){
$color="1BC621";
}


return $color;
}
$i=0;
$peli=$miconexion->query("SELECT * FROM titulo,titulopelicula WHERE titulo.id_titulo=titulopelicula.id_pelicula and id_pelicula=".$_GET["id"]); 

while ($rows = $peli->fetch_assoc()) {
/*TÍTULO:*/ echo "<title>".$rows["titulo"]."</title>";
echo "<table class=imagen><tr><td colspan=5>";
echo "<a href=titulo.php?id=".$_GET["id"]."><img class=poster src=poster/".$rows["poster"]." width=230 height=345></a></td></tr>";


echo "<style>td.puntuacion #pu{border-radius: 19px 19px 19px 19px;
-moz-border-radius: 19px 19px 19px 19px;
-webkit-border-radius: 19px 19px 19px 19px;
border: 0px solid #000000;background-color:#".colores($rows["puntuacion"])."}</style>";
if (!$rows["puntuacion"]==0){
echo "<tr><td colspan=6 class=puntuacion><div id=pu>";

echo $rows["puntuacion"]."</div></td></tr><tr>";
}
if (!is_null($rows["filmaffinity"])){
echo "<td  size=1 align=center width=1><img src=iconos/filmaffinity.png width=24 height=24>";
$i++;
}
if (!is_null($rows["imdb"])){
echo "<td  size=1 align=center><img src=iconos/imdb.png width=24 height=24>";
$i++;
}
if (is_null($rows["tomatometer"])){
	
}else if ($rows["tomatometer"]>=6.0&&$rows["tomatometer"]<=7.4){
echo "<td  size=1 align=center><img src=iconos/tomato.png width=24 height=24>";}
else if ($rows["tomatometer"]<=5.9){
echo "<td  size=1 align=center ><img src=iconos/rotten.png width=24 height=24>";}	
else if ($rows["tomatometer"]>7.4){
	echo "<td  size=1 align=center><img src=iconos/fresh.png width=24 height=24>";}
if (is_null($rows["audiencescore"])){
}else if ($rows["audiencescore"]>=5){
echo "<td size=1 align=center><img src=iconos/pc.png width=24 height=24>";}	
else{
	echo "<td  size=1 align=center><img src=iconos/badpc.png width=24 height=24>";}
if (!is_null($rows["letterboxd"])){
echo "<td  size=1 align=center><img src=iconos/lb.png width=24 height=24>";
$i++;	}

echo "</tr>";
if (!is_null($rows["filmaffinity"])){
	echo "<style>td.puntuacion #fa{border-radius: 19px 19px 19px 19px;
-moz-border-radius: 19px 19px 19px 19px;
-webkit-border-radius: 19px 19px 19px 19px;
border: 0px solid #000000;background-color:#".colores($rows["filmaffinity"])."}</style>";
echo "<td class='puntuacion'><div id=fa>";

echo $rows["filmaffinity"]."</div></td>";}
if (!is_null($rows["imdb"])){
echo "<style>td.puntuacion #imdb{border-radius: 19px 19px 19px 19px;
-moz-border-radius: 19px 19px 19px 19px;
-webkit-border-radius: 19px 19px 19px 19px;
border: 0px solid #000000;background-color:#".colores($rows["imdb"])."}</style>";
echo "<td class='puntuacion'><div id=imdb>";
echo $rows["imdb"]."</div></td>";
}
if (!is_null($rows["tomatometer"])){
echo "<style>td.puntuacion #to{border-radius: 19px 19px 19px 19px;
-moz-border-radius: 19px 19px 19px 19px;
-webkit-border-radius: 19px 19px 19px 19px;
border: 0px solid #000000;background-color:#".colores($rows["tomatometer"])."}</style>";
echo "<td class='puntuacion'><div id=to>";
echo $rows["tomatometer"]."</div></td>";
$i++;
}
if (!is_null($rows["audiencescore"])){
echo "<style>td.puntuacion #as{border-radius: 19px 19px 19px 19px;
-moz-border-radius: 19px 19px 19px 19px;
-webkit-border-radius: 19px 19px 19px 19px;
border: 0px solid #000000;background-color:#".colores($rows["audiencescore"])."}</style>";
echo "<td class='puntuacion'><div id=as>";
echo $rows["audiencescore"]."</div></td>";
$i++;
}
if (!is_null($rows["letterboxd"])){
echo "<style>td.puntuacion #lb{border-radius: 19px 19px 19px 19px;
-moz-border-radius: 19px 19px 19px 19px;
-webkit-border-radius: 19px 19px 19px 19px;
border: 0px solid #000000;background-color:#".colores($rows["letterboxd"])."}</style>";
echo "<td class='puntuacion'><div id=lb>";
echo $rows["letterboxd"]."</div></td>";
}
   echo "</td>";
   
   
   
echo "</td></tr>";

echo "<style>td.puntuacion #med{border-radius: 19px 19px 19px 19px;
-moz-border-radius: 19px 19px 19px 19px;
-webkit-border-radius: 19px 19px 19px 19px;
border: 0px solid #000000;background-color:#".colores($rows["mediaprof"])."}</style>";
if ($i>1){
if (!$rows["media"]==0){
echo "<tr><td class=puntuacion colspan=5><div id=med>".number_format($rows["mediaprof"],2)."</div></td></tr>";
}
}

echo "</table>";
 




if (!isset($_GET["v"])){
echo "<table class=datos>
<tr><th align=left colspan=3>".$rows["titulo"]."</th></tr>
<tr><td class=cabeza>Título orig.</td><td> </td><td>".$rows["titulo_original"]."</td></tr>
<tr><td class=cabeza>Año</td><td> </td><td><a href=year.php?a=".$rows["año"].">".$rows["año"]."</a></td></tr>
<tr><td class=cabeza>Duración</td><td> </td><td>".$rows["duracion"]."</td></tr>
<tr><td class=cabeza>País</td><td> </td><td><a href=allmovies.php?pais=".urlencode($rows["pais"]).">".$rows["pais"]."</a></td></tr>
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
else{
	$resultado=$miconexion->query("SELECT * FROM fechastitulos,titulopelicula WHERE titulopelicula.id_pelicula=fechastitulos.id_titulo and id_visionado=".$_GET["v"]);

   while ($rows=$resultado->fetch_assoc()){
	   $fe=explode("-", $rows["fecha"]);
	echo "<table class=critica>";
	echo "<tr><th align=left colspan=3>".$rows["titulo"]."</th></tr>";
	echo "<tr><td>Vista el ".$fe[2]."/".$fe[1]."/".$fe[0]." en ".$rows["medio"]." por ".$rows["formato"]."</td></tr>";
	echo "<tr><td>Audio: ".$rows["audio"]."</td></tr>";
	echo "<tr><td></td></tr>";
	echo "<tr><td>Crítica:</td></tr>";
	echo "<tr><td>".$rows["comentario"]."</td></tr>";
	echo "</table>";
}
}
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
 echo "<a href=titulo.php?id=".$_GET["id"]."&v=".$rows["id_visionado"].">".$fe[2]."/".$fe[1]."/".$fe[0]."</a>";
 echo "</td></tr>";
   }

echo "</table><br><br><br>";
?>
<style>
table.nube{
background-color:#B40404;
font-family: Trebuchet MS;
position:absolute;
right: 150px;
top:180px;
border-radius: 19px 19px 19px 19px;
-moz-border-radius: 19px 19px 19px 19px;
-webkit-border-radius: 19px 19px 19px 19px;
border: 2px solid black;
}
</style>
<?php
 $resultado=$miconexion->query("SELECT * FROM nube WHERE id_titulo=".$_GET["id"]);
	 $filas=$miconexion->affected_rows;
     if($filas>=1){
	 
echo "<table class=nube><tr><td>";
$numero=$miconexion->query("SELECT * FROM nube WHERE id_titulo=".$_GET["id"]);
while ($rows=$numero->fetch_assoc()){
echo "<a target='_blank' href=".$rows["link_archivo"].">Disponible</a></td></tr></table>";
}
	 }


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