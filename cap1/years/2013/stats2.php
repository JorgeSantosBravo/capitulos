<title>Estadísticas de 2013</title>
<?php
echo "<body><table border=1 align=center>";
echo "<th bgcolor=white>Serie</th>";
echo "<th bgcolor=white>Capítulos</th>";


$i=1;	//Contador para contar las filas impares y ponerlas de distinto color


$fech=$miconexion->query("SELECT serie.Nombre,COUNT(*) as con FROM titulo,serie,fechastitulos WHERE titulo.id_titulo=fechastitulos.id_titulo and titulo.serie=tituloserie.id_serie and YEAR(fechastitulos.fecha)=2013 GROUP BY titulo.serie ORDER BY con DESC");

while ($rows = $fech->fetch_assoc()) {
echo "<tr";
if ($i%2!=0)
{echo" bgcolor=#E6E6E6>";}
else{
	echo" bgcolor=white>";
}
echo '<td align=center>'.$rows["titulo_serie"].'</td>';
echo "<td align=center>".$rows["con"]."</td></tr>";
$i++;
}
echo "</table><br><br><br>";
include "formatos.php";


echo "<br><br><br><table border=1 align=center>";
echo "<th bgcolor=white>Día</th>";
echo "<th bgcolor=white>Capítulos</th>";


$i=1;	//Contador para contar las filas impares y ponerlas de distinto color


$fech=$miconexion->query("SELECT fechastitulos.fecha,COUNT(*) as con FROM titulo,fechastitulos WHERE titulo.id_titulo=fechastitulos.id_titulo and YEAR(fechastitulos.fecha)=2013 GROUP BY fechastitulos.fecha ORDER BY con DESC limit 10");

while ($rows = $fech->fetch_assoc()) {
echo "<tr";
if ($i%2!=0)
{echo" bgcolor=#E6E6E6>";}
else{
	echo" bgcolor=white>";
}

$fecha = explode("-",$rows["fecha"]); 

if ($fecha[2]=="00"){}else{
echo '<td>'.$fecha[2].'/'.$fecha[1].'/'.$fecha[0].'</td>';
echo "<td align=center>".$rows["con"]."</td></tr>";
$i++;
}
}
echo "</table><br><br><br>";


echo "<table border=1 align=center>";
echo "<th bgcolor=white>Día</th>";
echo "<th bgcolor=white>Minutos</th>";


$i=1;	//Contador para contar las filas impares y ponerlas de distinto color


$fech=$miconexion->query("SELECT fechastitulos.fecha,SUM(titulo.Duracion) as con FROM titulo,fechastitulos WHERE titulo.id_titulo=fechastitulos.id_titulo and YEAR(fechastitulos.fecha)=2013 GROUP BY fechastitulos.fecha ORDER BY con DESC limit 10");

while ($rows = $fech->fetch_assoc()) {
echo "<tr";
if ($i%2!=0)
{echo" bgcolor=#E6E6E6>";}
else{
	echo" bgcolor=white>";
}

$fecha = explode("-",$rows["fecha"]); 

if ($fecha[2]=="00"){}else{
echo '<td>'.$fecha[2].'/'.$fecha[1].'/'.$fecha[0].'</td>';
echo "<td align=center>".$rows["con"]."</td></tr>";
$i++;
}
}
echo "</table><br><br><br>";




echo "<table border=1 align=center>";
echo "<th bgcolor=white>Canal</th>";
echo "<th bgcolor=white>Capítulos</th>";


$i=1;
$fech=$miconexion->query("SELECT canal.Nomcanal,COUNT(*) as con FROM titulo,serie,canal,fechastitulos WHERE titulo.id_titulo=fechastitulos.id_titulo and titulo.serie=tituloserie.id_serie and serie.canal=canal.ID_canal and YEAR(fechastitulos.fecha)=2013 GROUP BY serie.canal ORDER BY con DESC");

while ($rows = $fech->fetch_assoc()) {
echo "<tr";
if ($i%2!=0)
{echo" bgcolor=#E6E6E6>";}
else{
	echo" bgcolor=white>";
}
echo '<td align=center>'.$rows["Nomcanal"].'</td>';
echo "<td align=center>".$rows["con"]."</td></tr>";
$i++;
}
echo "</table><br><br><br>";

$fech=$miconexion->query("SELECT COUNT(*) as con FROM fechastitulos WHERE YEAR(fechastitulos.fecha)=2013");

if ($rows = $fech->fetch_assoc()) {

echo "<b>Capítulos en total</b>: ".$rows["con"]."<br>";
}
$fech=$miconexion->query("SELECT COUNT(*)/365 as con FROM fechastitulos WHERE YEAR(fechastitulos.fecha)=2013");

if ($rows = $fech->fetch_assoc()) {

echo "<b>Capítulos/día</b>: ".$rows["con"]."<br>";
}
$fech=$miconexion->query("SELECT SUM(titulo.Duracion)*60 as con FROM titulo,fechastitulos WHERE titulo.id_titulo=fechastitulos.id_titulo and YEAR(fechastitulos.fecha)=2013");

if ($rows = $fech->fetch_assoc()) {
function conversorSegundosHoras($tiempo_en_segundos) {
	$horas = floor($tiempo_en_segundos / 3600);
	$minutos = floor(($tiempo_en_segundos - ($horas * 3600)) / 60);
	$segundos = $tiempo_en_segundos - ($horas * 3600) - ($minutos * 60);
 
	$hora_texto = "";
	if ($horas > 0 ) {
		$hora_texto .= $horas . "h ";
	}
 
	if ($minutos > 0 ) {
		$hora_texto .= $minutos . "m ";
	}
 
	if ($segundos > 0 ) {
		$hora_texto .= $segundos . "s";
	}
 
	return $hora_texto;
}

$p=($rows["con"]*100)/31536000;
echo "<b>Tiempo total</b>: ".conversorSegundosHoras($rows["con"])."(". number_format($p, 2)  ."%)<br>";
}

$fech=$miconexion->query("SELECT SUM(Duracion)/365 as con FROM titulo,fechastitulos WHERE titulo.id_titulo=fechastitulos.id_titulo and  YEAR(fechastitulos.fecha)=2013");

if ($rows = $fech->fetch_assoc()) {

echo "<b>Minutos/día</b>: ".$rows["con"]."<br>";
}
echo "<a href='visor.php?v=years/index.php'>Volver a anuarios</a><br>";
?>
