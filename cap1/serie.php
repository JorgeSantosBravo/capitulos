<link rel="stylesheet" type="text/css" media="screen" href="enlace.css">
<link rel="stylesheet" type="text/css" media="screen" href="trebuchet.css">
<link rel="stylesheet" type="text/css" media="screen" href="serie.css">

<?php
session_start();
include("conexion.php");
$selec=$miconexion->query("SELECT * FROM serie,canal WHERE serie.canal=canal.id_canal and id_serie LIKE '$_GET[id]'");
while ($rows = $selec->fetch_assoc()) {
echo "<title>".$rows["Nombre"]." (".$rows["inicio"].")</title>";
$_SESSION["inicio"]=$rows["inicio"];
echo "<h3>".$rows["Nombre"]."</h3><hr>";
$_SESSION["nombre"]=$rows["Nombre"];
echo "<strong>Canal:</strong> ".$rows["Nomcanal"]."<br>";
$_SESSION["c"]=$rows["ID_canal"];
echo "<strong>Inicio</strong>: ".$rows["inicio"]."<br>";
if ($rows["fin"]==0){
}else{
echo "<strong>Fin</strong>: ".$rows["fin"]."<br>";
}
$_SESSION["fin"]=$rows["fin"];
echo "<strong>Estado</strong>: ".$rows["estado"]."<br>";
$_SESSION["estado"]=$rows["estado"];
$dur=$miconexion->query("SELECT SUM(Duracion) as sum FROM capitulo,serie WHERE capitulo.serie=serie.id_serie and serie.id_serie LIKE '$_GET[id]'");
while ($rows2 = $dur->fetch_assoc()) {

echo "<strong>Duración total</strong>: ".$rows2["sum"]." minutos";

}
$_SESSION["poster"]=$rows["Poster"];
echo '<img witdh=160 height=237 title='.urlencode($rows["Nombre"]).' src=poster/'.$rows["Poster"].'><br>';
echo "<div id=debajo>";
if (!$rows["Intro"]==""){
echo "<iframe width='400' height='300' 
src='https://www.youtube.com/embed/".$rows["Intro"]."'  
allowfullscreen></iframe>";	

}
$_SESSION["intro"]=$rows["Intro"];
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
	top: 50px; 
	right: 270px;
       }
</style>
<div id="boton">
<?php


echo "<input type='button' value='Editar' onclick=window.location.href='edit/serie.php?id=".$_GET["id"]."' class='boton'>";
?>
</div>
<?php
$_SESSION["seg"]=$rows["Seguimiento"];
}
$resultado=$miconexion->query("SELECT Nomdir FROM serie,director,creadoresserie WHERE serie.id_serie=creadoresserie.id_sserie and id_director=creadoresserie.id_ccreador and serie.id_serie LIKE '$_GET[id]'");
echo "<strong>Creadores</strong>: ";
$a = array();
while ($rows = $resultado->fetch_assoc()) {
   array_push($a, $rows["Nomdir"]);
}
$_SESSION["creador"]=$a;
echo implode(', ', $a);
echo "<br>";
echo "Capítulos:<br>";
$caps=$miconexion->query("SELECT * FROM capitulo WHERE serie in (SELECT id_serie FROM serie WHERE id_serie LIKE '$_GET[id]')");
echo "<table>";
while ($rows = $caps->fetch_assoc()) {
echo "<tr><td>".$rows["s"]." ".$rows["e"]."</td><td><a href=capitulo.php?id=".$rows["id_capitulo"].">".$rows["Titulo"]."</a></td></tr>";
	
}
echo "</table>";
echo "</table><br></font>";
echo "<a href='index.php'>Volver a inicio</a>";
?>