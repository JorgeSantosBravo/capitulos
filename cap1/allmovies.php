<title>Todas las películas </title>
<style type="text/css">
#barra{
	background-color: #333;;
border-radius: 21px 21px 21px 21px;
-moz-border-radius: 21px 21px 21px 21px;
-webkit-border-radius: 21px 21px 21px 21px;
border: 0px solid #000000;
color:white;
text-align:right;

	}
	
	#cuenta{
		color:white;
text-align:center;

	}
	a{
		font-size:20px;
		text-decoration:none;
		color:white;
text-align:center;
	}
	a.borrar{
		font:menu;
		
	}
img.poster{

border-radius: 15px 15px 15px 15px;
-moz-border-radius: 15px 15px 15px 15px;
-webkit-border-radius: 15px 15px 15px 15px;
border: 1px solid #000000;
border-color:white;
height:111px;
width:76px;
margin: 10px;
-webkit-box-shadow: 3px 3px 5px 0px rgba(117,116,117,1);
-moz-box-shadow: 3px 3px 5px 0px rgba(117,116,117,1);
box-shadow: 3px 3px 5px 0px rgba(117,116,117,1);

}

img.poster:hover{
	border-color:green;
}
#centro{
left: 25%;
 top: 75%;
  margin: 15px 0 30px 28px;
}
body{ background: #000 url('fondos/degradadooscuro.jpg') no-repeat top right fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
font:menu;
}


select{
 font:menu;
color:white;
  overflow: hidden;
  background: grey;
  border-radius: 21px 21px 21px 21px;
-moz-border-radius: 21px 21px 21px 21px;
-webkit-border-radius: 21px 21px 21px 21px;
border: 0px solid #000000;
}
#textocentrado{
	text-align:center;
}
</style>
<script type="text/javascript">
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function cambiar(op){
var dec = getParameterByName('dec');
if (dec==""){
	dec=0000;
}
var a = getParameterByName('a');
if (a==""){
	a=0;
}
var pais = getParameterByName('pais');
if (pais==""){
	pais=0;
}
var opcion=document.getElementById(op);
location.href="allmovies.php?dec="+dec+"&orderby="+opcion.value+"&a="+a+"&pais="+pais;

}

function decada(op){
var o = getParameterByName('orderby');
if (o==""){
	o=0000;
}

var pais = getParameterByName('pais');
if (pais==""){
	pais=0;
}
var opcion=document.getElementById(op);

location.href="allmovies.php?dec="+opcion.value+"&orderby="+o+"&pais="+pais;

}
function paises(op){
	var dec = getParameterByName('dec');
if (dec==""){
	dec=0000;
}
var a = getParameterByName('a');
if (a==""){
	a=0;
}
var o = getParameterByName('orderby');
if (o==""){
	o=0000;
}

var opcion=document.getElementById(op);

location.href="allmovies.php?dec="+dec+"&orderby="+o+"&a="+a+"&pais="+opcion.value;

}
</script>
<?php

function hacermedia($id){
	
}

$orden="año DESC, id_pelicula DESC";
if (isset($_GET["orderby"])){
switch($_GET["orderby"]){
	case "dur_desc":$orden="duracion DESC";break;
	case "dur_asc":$orden="duracion ASC";break;
	case "año_asc":$orden="año ASC";break;
	case "año_desc":$orden="año DESC";break;
	case "title":$orden="titulo ASC";break;
	case "media_desc":$orden="media DESC";break;
	case "media_asc":$orden="media ASC";break;
	case "mediaprof_desc":$orden="mediaprof DESC";break;
	case "mediaprof_asc":$orden="mediaprof ASC";break;
	default: $orden="año DESC";
}
}
$plus="";
if (isset($_GET["dec"])&&!$_GET["dec"]==0){
switch($_GET["dec"]){

	case "1910":$plus="AND año>=1910 AND año<=1919";break;
	case "1920":$plus="AND año>=1920 AND año<=1929";break;
	case "1930":$plus="AND año>=1930 AND año<=1939";break;
	case "1940":$plus="AND año>=1940 AND año<=1949";break;
	case "1950":$plus="AND año>=1950 AND año<=1959";break;
	case "1960":$plus="AND año>=1960 AND año<=1969";break;
	case "1970":$plus="AND año>=1970 AND año<=1979";break;
	case "1980":$plus="AND año>=1980 AND año<=1989";break;
	case "1990":$plus="AND año>=1990 AND año<=1999";break;
	case "2000":$plus="AND año>=2000 AND año<=2009";break;
	case "2010":$plus="AND año>=2010 AND año<=2020";break;
	default: $plus="AND año>1910";
}
}
if (isset($_GET["a"])&&!$_GET["a"]==0){

$plus="AND año=".$_GET["a"];

}

if (isset($_GET["pais"])&&!$_GET["pais"]==0){
	$plus.= " AND pais LIKE '".urldecode($_GET["pais"])."'";
}
?>
<div id="barra">
Ordenar por:

<select id="opciones" name="opciones" onchange="cambiar(this.id)">

<option value=""></option>

<option value="title">Título</option>
<option value="ano" disabled="disabled">Nota media</option>
<option value="media_desc">Mejores primero</option>
<option value="media_asc">Peores primero</option>
<option value="ano" disabled="disabled">Nota media prof.</option>
<option value="mediaprof_desc">Mejores según prof. primero</option>
<option value="mediaprof_asc">Peores según prof. primero</option>
<option value="año" disabled="disabled">Año</option>
<option value="año_desc">Nuevas primero</option>
<option value="año_asc">Antiguas primero</option>
<option disabled="disabled">Duración</option>
<option value="dur_desc">Largas primero</option>
<option value="dur_asc">Cortas primero</option>
</select>
Décadas:

<select id="decada" name="decada" onchange="decada(this.id)">

<option value=""></option>
<?php
include "conexion.php";
$da=(DATE('Y')+10);


for ($i=1910;$i<=$da;$i+=10){
echo "<option value='".$i."'>".$i."</option>";

}


?>


</select>
Países:

<select id="pais" name="pais" onchange="paises(this.id)">

<option value=""></option>
<?php

$cont=$miconexion->query("SELECT DISTINCT(pais) FROM titulopelicula ORDER BY pais ASC");
while ($rows = $cont->fetch_assoc()) {
	echo "<option value='".$rows["pais"]."'>".$rows["pais"]."</option>";
}


?>


</select>
<a class="borrar" href="allmovies.php">Borrar filtros </a>
</div>
<?php
include "header/header.php";
echo "<div id='cuenta'>";
if (isset($_GET["dec"])&&$_GET["dec"]>=1910){
for ($j=$_GET["dec"];$j<($_GET["dec"]+10);$j++){
	if (!isset($_GET["pais"]))
	{
		$_GET["pais"]="";
};
	echo "<a href=allmovies.php?dec=".$_GET["dec"]."&orderby=".$_GET["orderby"]."&a=".$j."&pais=".$_GET["pais"].">".$j."</a> ";
}
}
echo "</div>";

$cont=$miconexion->query("SELECT COUNT(*) as con FROM titulo,titulopelicula WHERE titulo.id_titulo=titulopelicula.id_pelicula ".$plus);
while ($rows = $cont->fetch_assoc()) {
	echo "<div id='textocentrado'>".$rows["con"]." películas</div>";
}
$cont=$miconexion->query("SELECT * FROM titulo,titulopelicula WHERE titulo.id_titulo=titulopelicula.id_pelicula ".$plus." ORDER BY ".$orden);
echo "<div id='centro'>";
while ($rows = $cont->fetch_assoc()) {
echo ' <a href=titulo.php?id='.$rows["id_titulo"].' >
<img class="poster" title='.urlencode($rows["titulo"]).' src=poster/'.$rows["poster"].'>
</a>';
}
echo "</div>";
?>
