<html>
<head>
<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<link rel="stylesheet" type="text/css" media="screen" href="Estilos/enlace.css">
<link rel="stylesheet" type="text/css" media="screen" href="Estilos/serie.css">
<link rel="shortcut icon" type="image/x-icon" href="icono.ico" />
<title>Inicio</title>

<style type="text/css" media="screen">
  <?php 
//PARA FONDOS ALEATORIOS
  /*$imagenes = array("imagen1.jpg" , "imagen2.jpg" , "imagen3.jpg" , "imagen4.jpg");
       $valor = rand(0, count($imagenes)-1); // Uso de rand(): rand(Valor minimo, Valor maximo);
	echo "body{ background: #000 url('fondos/".$imagenes[$valor]."') no-repeat top right fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;}";
*/

?> 
body{ background: #000 url('fondos/imagen4.jpg') no-repeat top right fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;}
</style>
</head>
<body >
<?php
include "header/header.php";
include ("conexion.php");
?>
<div id="izquierda">

<?php
include("hace.php");
echo "<br><a href =visor.php?v=years/index.php>Anuarios</a><br>";
echo "<a href =visor.php?v=Stats/index.php>Estadísticas</a><br>";
echo "<a href =buscafecha.php>Buscar por fecha</a><br>";
echo "<a href=mislistas.php>Mis listas</a><br>";
echo "<a href=rankingactores.php>Ránking de actores</a><br>";
$consulta=$miconexion->query("SELECT * FROM titulopelicula order by rand() limit 1"); 
while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">Película aleatoria</a><br>";
}
echo "<br><input type=button value='Nuevo capítulo' onclick=window.location.href='nuevocap.php'>";
echo "<br><br><input type=button value='Nueva lista' onclick=window.location.href='lista.php'>";
echo "<br><br><input type=button value='Nueva película' onclick=window.location.href='nuevapelicula.php'>";
?>
</div>
<style type="text/css">
#d{height:98%;
float:right;}
</style>
<div id="d">
<strong>Últimos capítulos introducidos <br> </strong>
<?php

$stocke=$miconexion->query("SELECT * FROM fechastitulos,titulocapitulo,tituloserie,temporada WHERE temporada.id_temporada=titulocapitulo.ns and tituloserie.id_serie=titulocapitulo.serie and titulocapitulo.id_capitulo=fechastitulos.id_titulo ORDER BY fechastitulos.id_titulo DESC limit 5"); 
while ($rows = $stocke->fetch_assoc()){
$fe=explode("-", $rows["fecha"]);

echo $fe[2]."/".$fe[1]." - <a href=titulo.php?id=".$rows["id_titulo"].">".$rows["titulo_serie"]." ".$rows["numero_temporada"]."x".$rows["e"]."</a><br>";
	
}
echo "<br><strong>Últimas películas introducidas</strong><br>";

$stocke=$miconexion->query("SELECT * FROM fechastitulos,titulopelicula WHERE titulopelicula.id_pelicula=fechastitulos.id_titulo ORDER BY fechastitulos.id_visionado DESC limit 5"); 
while ($rows = $stocke->fetch_assoc()){
$fe=explode("-", $rows["fecha"]);

echo $fe[2]."/".$fe[1]." - <a href=titulo.php?id=".$rows["id_titulo"].">".substr($rows["titulo"],0,23);

echo "</a><br>";
	
}

echo "<br><table>";
$con=$miconexion->query("SELECT COUNT(*) as con FROM titulocapitulo"); 

while ($rows = $con->fetch_assoc()){

echo "<tr><td>Capítulos: </td><td><strong>".$rows["con"]."</strong></td></tr>";
	
}
echo "<tr><td>";
$con=$miconexion->query("SELECT COUNT(*) as con FROM titulopelicula"); 

while ($rows = $con->fetch_assoc()){

echo "Películas: </td><td><strong>".$rows["con"]."</strong></td></tr>";
	
}
echo "<tr><td>";
$con=$miconexion->query("SELECT COUNT(*) as con FROM tituloserie"); 

while ($rows = $con->fetch_assoc()){

echo "Series: </td><td><strong><a href=todas.php>".$rows["con"]."</a></strong></td></tr>";
	
}
echo "<tr><td>";
$con=$miconexion->query("SELECT COUNT(*) as con FROM temporada"); 

while ($rows = $con->fetch_assoc()){

echo "Temporadas: </td><td><strong>".$rows["con"]."</strong></td></tr>";
	
}
echo "<tr><td>";
$con=$miconexion->query("SELECT COUNT(*) as con FROM persona"); 

while ($rows = $con->fetch_assoc()){

echo "Personas: </td><td><strong>".$rows["con"]."</strong></td></tr>";
	
}
echo "</table>";
function conversorSegundosHoras($minutos) {
	$meses= floor($minutos / 43200);
	$dias= floor(($minutos - ($meses * 43200) ) / 1440);
	$horas = floor(($minutos - ($meses * 43200) - ($dias * 1440)) / 60);
 
	$hora_texto = "";
	if ($meses > 0 ) {
		$hora_texto .= $meses . " m ";
	}
	if ($dias > 0 ) {
		$hora_texto .= $dias . " d ";
	}
	
	if ($horas > 0 ) {
		$hora_texto .= $horas . " h ";
	}
 
	return $hora_texto;
}

echo "<br>";
$con=$miconexion->query("SELECT SUM(duracion) as con FROM titulocapitulo"); 

while ($rows = $con->fetch_assoc()){

echo "Tiempo total: ".conversorSegundosHoras($rows["con"]);
	
}



echo "<br><br>";
$con=$miconexion->query("SELECT COUNT(*) as con FROM titulocapitulo,fechastitulos WHERE titulocapitulo.id_capitulo=fechastitulos.id_titulo and YEAR(fechastitulos.fecha)=".date ("Y").""); 
$caps=0;
while ($rows = $con->fetch_assoc()){
$caps=$rows["con"];
echo " Este año <strong><a href=visor.php?v=years/2016/m2016.php#final>".$rows["con"]."</a></strong> capítulos <br> en ";
	
}

$datetime1 = new DateTime(date('Y').'-01-01');
$datetime2 = new DateTime(date('Y-m-d'));
$interval = $datetime1->diff($datetime2);
$dias=substr($interval->format('%R%a días'),1);
echo $dias." (".substr(($caps/$dias),0,4)."c/d)";
echo "<br><br>";
$con=$miconexion->query("SELECT COUNT(*) as con FROM titulopelicula,fechastitulos WHERE titulopelicula.id_pelicula=fechastitulos.id_titulo and YEAR(fechastitulos.fecha)=".date ("Y").""); 

while ($rows = $con->fetch_assoc()){
echo "  <strong><a href=visor.php?v=years/2016/p2016.php#final>".$rows["con"]."</a></strong> películas";
	
}


?>

</div>
</body>
</html>
