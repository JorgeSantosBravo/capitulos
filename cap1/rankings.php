<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<link rel="stylesheet" type="text/css" media="screen" href="Estilos/enlace.css">
<style>
#barra{
	background-color: #A9D7EF;;
border-radius: 21px 21px 21px 21px;
-moz-border-radius: 21px 21px 21px 21px;
-webkit-border-radius: 21px 21px 21px 21px;
border: 0px solid #000000;
text-align:center;
	}
h2{
	text-align:center;
}
</style>
<div id="barra">
<a href="rankings.php?r=cast">Reparto</a> | 
<a href="rankings.php?r=direc">Directores</a> | 
<a href="rankings.php?r=guion">Guionistas</a> | 
<a href="rankings.php?r=bso">Banda sonora</a> | 
<a href="rankings.php?r=foto">Direc. foto.</a>
</div>
<title>Ránkings</title>
<?php
include "header/header.php";
include "conexion.php";
$tabla="peliculasactores";$persona="id_actor";$primaria="id_pelicula";$palabra="Actores";;
if (isset($_GET["r"])){
	switch ($_GET["r"]){
		case "cast": $tabla="peliculasactores"; $persona="id_actor"; break;
		case "direc": $tabla="titulosdirectores"; $persona="id_director"; $primaria="id_titulo"; $palabra="Directores"; break;
		case "guion": $tabla="peliculasguionistas"; $persona="id_guionista"; $palabra="Guionistas"; break;
		case "bso": $tabla="peliculasmusicos"; $persona="id_musico"; $palabra="Banda sonora";break;
		case "foto": $tabla="peliculasfotografos"; $persona="id_foto"; $palabra="Directores de fotografía"; break;
		default: $tabla="peliculasactores"; $persona="id_actor"; $primaria="id_pelicula"; break;
	}
}
$i=1;
$consulta=$miconexion->query("SELECT COUNT(DISTINCT($persona)) as con FROM $tabla"); 
if ($rows = $consulta->fetch_assoc()){

echo "<h2>$palabra (".$rows["con"].")</h2>";

}
$consulta=$miconexion->query("SELECT *,COUNT(*) as con FROM persona,titulopelicula,$tabla WHERE persona.id_persona=$tabla.$persona and titulopelicula.id_pelicula=$tabla.$primaria GROUP BY persona.id_persona ORDER BY con DESC LIMIT 100"); 
echo "<table align=center><tr><th>Pos.</th><th>Nombre</th><th>Num</th></tr>";
while ($rows = $consulta->fetch_assoc()){
	if ($rows[$persona]!=681){
	echo "<tr><td>".$i."</td><td><a href=persona.php?id=".$rows["id_persona"].">".$rows["Nombre_persona"]."</a></td><td>".$rows["con"]."</td></tr>";
	$i++;
	}
	}
echo "</table>";
?>