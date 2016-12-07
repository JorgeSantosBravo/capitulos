<link rel="stylesheet" type="text/css" media="screen" href="Estilos/enlace.css">
<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<link rel="stylesheet" type="text/css" media="screen" href="Estilos/serie.css">
<?php
session_start();
include("conexion.php");
$selec=$miconexion->query("SELECT * FROM titulo,tituloserie,canal WHERE titulo.id_titulo=tituloserie.id_serie and tituloserie.canal=canal.id_canal and id_serie LIKE '$_GET[id]'");
while ($rows = $selec->fetch_assoc()) {
echo "<title>".$rows["titulo_serie"]." (".$rows["inicio"].")</title>";
$_SESSION["inicio"]=$rows["inicio"];
echo "<h3>".$rows["titulo_serie"];
if ($rows["miniserie"]==1){
	echo " (Miniserie)";
}
echo "</h3><hr>";
$_SESSION["nombre"]=$rows["titulo_serie"];
echo "<strong>Canal:</strong> <a href='canal.php?id=".$rows["ID_canal"]."'>".$rows["Nomcanal"]."</a><br>";
$_SESSION["c"]=$rows["ID_canal"];
echo "<strong>Inicio</strong>: ".$rows["inicio"]."<br>";
if ($rows["fin"]==0 ||$rows["miniserie"]==1){
}else{
echo "<strong>Fin</strong>: ".$rows["fin"]."<br>";
}
$_SESSION["fin"]=$rows["fin"];
if ($rows["miniserie"]==0){
echo "<strong>Estado</strong>: ".$rows["estado"]."<br>";}
$_SESSION["estado"]=$rows["estado"];

$temp=$miconexion->query("SELECT count(*) as con from temporada WHERE serie=".$_GET["id"]);
while ($rows2 = $temp->fetch_assoc()) {

echo "<strong>Temporadas</strong>: ".$rows2["con"]."<br>";

}
$caps=$miconexion->query("SELECT count(*) as con from titulocapitulo WHERE serie=".$_GET["id"]);
while ($rows2 = $caps->fetch_assoc()) {

echo "<strong>Capítulos</strong>: ".$rows2["con"]."<br>";

}
$dur=$miconexion->query("SELECT DISTINCT duracion, count(duracion) as con from titulocapitulo,tituloserie WHERE titulocapitulo.serie=tituloserie.id_serie and id_serie LIKE '$_GET[id]' group by duracion order by con DESC LIMIT 1");
while ($rows2 = $dur->fetch_assoc()) {

echo "<strong>Duración cap.</strong>: ".$rows2["duracion"]." minutos";

}

$_SESSION["poster"]=$rows["poster"];

if (strpos($rows["titulo_serie"], " ")){
  $nueva=str_replace(" ", "&nbsp;", $rows["titulo_serie"]);}else{
    $nueva=$rows["titulo_serie"];
  }

echo '<img witdh=160 height=237 class="poster" title='.$nueva.' src=poster/'.$rows["poster"].'><br>';
echo "<div id=debajo>";
if (!$rows["intro"]==""){
echo "<iframe width='400' height='300' 
src='https://www.youtube.com/embed/".$rows["intro"]."'  
allowfullscreen></iframe>";	

}
$_SESSION["intro"]=$rows["intro"];
echo "</div>";
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
	top: 105px; 
	right: 270px;
       }
</style>
<div id="boton">
<?php


echo "<input type='button' value='Editar' onclick=window.location.href='edit/serie.php?id=".$_GET["id"]."' class='boton'>";
?>
</div>
<?php
$_SESSION["seg"]=$rows["seguimiento"];
}
$resultado=$miconexion->query("SELECT * FROM tituloserie,persona,creadoresserie WHERE tituloserie.id_serie=creadoresserie.id_sserie and persona.id_persona=creadoresserie.id_ccreador and tituloserie.id_serie LIKE '$_GET[id]'");
echo "<strong>Creadores</strong>: ";
$a = array();
while ($rows = $resultado->fetch_assoc()) {
   array_push($a, "<a href=persona.php?id=".$rows["id_persona"].">".$rows["Nombre_persona"]."</a>");
}
echo implode(', ', $a);
echo "<br><br>";
$temp=$miconexion->query("SELECT * FROM temporada WHERE serie in (SELECT id_serie FROM tituloserie WHERE id_serie LIKE '$_GET[id]')");
while ($rows = $temp->fetch_assoc()) {
	if ($rows["alias_temporada"]!=""){
		echo $rows["alias_temporada"];
	}else{
	echo "Temporada ".$rows["numero_temporada"];}
echo 	" (".$rows["año_temporada"].")";
//ESTO SERÁ UN DESPLEGABLE	
echo "<br>";
$caps=$miconexion->query("SELECT * FROM titulocapitulo,temporada WHERE temporada.id_temporada=titulocapitulo.ns AND temporada.id_temporada=".$rows["id_temporada"]);
echo "<table>";
while ($rows2 = $caps->fetch_assoc()) {
echo "<tr><td><a href=titulo.php?id=".$rows2["id_capitulo"].">".$rows2["numero_temporada"]." ".$rows2["e"]."</a></td><td><a href=titulo.php?id=".$rows2["id_capitulo"]."> ".$rows2["titulo_capitulo"]."</a></td></tr>";
	
}
echo "</table><br>";
}
echo "</table><br></font>";
echo "<a href='todas.php'>Volver a todas las series</a><br>";
?>