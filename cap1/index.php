<html>
<head>
<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<link rel="stylesheet" type="text/css" media="screen" href="Estilos/enlace.css">
<link rel="stylesheet" type="text/css" media="screen" href="Estilos/serie.css">
<link rel="shortcut icon" type="image/x-icon" href="icono.ico" />
<title>Inicio - BdSeries</title>

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

echo "<br><a href =todas.php>Todas las series</a><br>";
echo "<a href =visor.php?v=years/index.php>Anuarios</a>";
echo "<br><br><input type=button value='Nuevo capítulo' onclick=window.location.href='nuevocap.php'>";
echo "<br><br><input type=button value='Nueva serie' onclick=window.location.href='newserie.php'>";
//include "nuevocap.php";
?>
</div>
<style type="text/css">
#d{height:98%;
float:right;}
</style>
<div id="d">
<strong>Últimos capítulos introducidos <br> </strong>
<?php

$stocke=$miconexion->query("SELECT * FROM capitulo,serie WHERE capitulo.serie=serie.id_serie ORDER BY id_capitulo DESC limit 5"); 
while ($rows = $stocke->fetch_assoc()){
$fe=explode("-", $rows["fecha"]);

echo $fe[2]."/".$fe[1]." - <a href=capitulo.php?id=".$rows["id_capitulo"].">".$rows["Nombre"].": ".$rows["s"]."x".$rows["e"]."</a><br>";
	
}

echo "<br><table>";
$con=$miconexion->query("SELECT COUNT(*) as con FROM capitulo"); 

while ($rows = $con->fetch_assoc()){

echo "<tr><td>Capítulos: </td><td><strong>".$rows["con"]."</strong></td></tr>";
	
}
echo "<tr><td>";
$con=$miconexion->query("SELECT COUNT(*) as con FROM serie"); 

while ($rows = $con->fetch_assoc()){

echo "Series: </td><td><strong>".$rows["con"]."</strong></td></tr>";
	
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
$con=$miconexion->query("SELECT SUM(Duracion) as con FROM capitulo"); 

while ($rows = $con->fetch_assoc()){

echo "Tiempo total: ".conversorSegundosHoras($rows["con"]);
	
}



echo "<br><br>";
$con=$miconexion->query("SELECT COUNT(*) as con FROM capitulo WHERE YEAR(fecha)=".date ("Y").""); 

while ($rows = $con->fetch_assoc()){

echo " Este año <strong><a href=visor.php?v=years/2016/m2016.php>".$rows["con"]."</a></strong> capítulos
";
	
}



?>

</div>
</body>
</html>
