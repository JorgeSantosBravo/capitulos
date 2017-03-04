<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<link rel="stylesheet" type="text/css" media="screen" href="Estilos/enlace.css">
<style type="text/css">
img.p{
border-radius: 15px 15px 15px 15px;
-moz-border-radius: 15px 15px 15px 15px;
-webkit-border-radius: 15px 15px 15px 15px;
border: 0px solid #000000;
}
</style>
<div align=center>
<?php
include "header/header.php";
/*$consulta=$miconexion->query("SELECT COUNT(*) as con FROM titulopelicula WHERE año=$anio"); 
while ($rows = $consulta->fetch_assoc()){

echo "Películas vistas: ".$rows["con"];

}
echo "<br><br>";
$consulta=$miconexion->query("SELECT COUNT(*) as con FROM titulocapitulo,fechastitulos WHERE titulocapitulo.id_capitulo=fechastitulos.id_tituloand año=$anio"); 
while ($rows = $consulta->fetch_assoc()){

echo "Capítulos vistos: ".$rows["con"];

}
*/
$url=$_SERVER['HTTP_HOST'].":".$_SERVER['REQUEST_URI'];
?>
<h2><a href="visor.php?v=years/2013/stats.php&ver=movies">Películas</a> | <a href="visor.php?v=years/2013/stats.php&ver=series">Series</a></h2>
<?php
include "conexion.php";

$anio=$_GET["a"];

echo "<title>$anio</title>

<h1>$anio</h1>
";

$total=0;
if (!isset($_GET["ver"])||$_GET["ver"]=="movies"){


$consulta=$miconexion->query("SELECT COUNT(*) as con FROM titulopelicula WHERE año=$anio"); 
while ($rows = $consulta->fetch_assoc()){

echo $rows["con"]." vistas";
$total=$rows["con"];
}
echo " de las cuales <br>";
 $consulta=$miconexion->query("SELECT COUNT(*) as con FROM titulopelicula WHERE año=$anio and documental=1"); 
while ($rows = $consulta->fetch_assoc()){

echo $rows["con"]." eran documentales";

}
echo "<br>";

echo "</table><h3>Por países</h3>";
 $consulta=$miconexion->query("SELECT *,COUNT(*) as con FROM titulopelicula WHERE año=$anio GROUP BY pais ORDER BY con DESC LIMIT 10"); 
echo "<table>";
 while ($rows = $consulta->fetch_assoc()){
echo "<tr><td>".$rows["pais"]."</td><td>".$rows["con"]."</td></tr>";
}
echo "</table>";

echo "<h3>Puntuaciones</h3>";
 $consulta=$miconexion->query("SELECT titulopelicula.puntuacion,COUNT(*) as con FROM titulopelicula WHERE año=$anio GROUP BY titulopelicula.puntuacion ORDER BY titulopelicula.puntuacion DESC"); 
echo "<table>";
 while ($rows = $consulta->fetch_assoc()){
echo "<tr><td>".$rows["puntuacion"]."</td><td></td><td>".$rows["con"]."</td></tr>";
}
echo "</table><table>";

 $consulta=$miconexion->query("SELECT titulopelicula.puntuacion,COUNT(*) as con FROM titulopelicula WHERE año=$anio  and puntuacion>=5"); 
 while ($rows = $consulta->fetch_assoc()){

echo "<tr><td>Aprobados</td><td>".$rows["con"]."</td><td>".number_format(($rows["con"]*100/$total),2)."%</td></tr>";
 }
 $consulta=$miconexion->query("SELECT titulopelicula.puntuacion,COUNT(*) as con FROM titulopelicula WHERE año=$anio  and puntuacion<5"); 
 while ($rows = $consulta->fetch_assoc()){

echo "<tr><td>Suspensos</td><td>".$rows["con"]."</td><td>".number_format(($rows["con"]*100/$total),2)."%</td></tr>";
 }
echo "</table>";
echo "<h3>Por géneros</h3>";
 $consulta=$miconexion->query("SELECT *, COUNT(*) as con FROM titulopelicula,genero,peliculasgeneros WHERE peliculasgeneros.id_genero=genero.id_genero and peliculasgeneros.id_pelicula=titulopelicula.id_pelicula and año=$anio GROUP BY genero.id_genero ORDER BY con DESC"); 
echo "<table>";
 while ($rows = $consulta->fetch_assoc()){
echo "<tr><td>".$rows["nombre_genero"]."</td><td></td><td>".$rows["con"]."</td></tr>";
}
echo "</table>";
echo "<h3>Por temas</h3>";
 $consulta=$miconexion->query("SELECT *, COUNT(*) as con FROM titulopelicula,tema,peliculastemas WHERE peliculastemas.id_tema=tema.id_tema and peliculastemas.id_pelicula=titulopelicula.id_pelicula and año=$anio GROUP BY tema.id_tema ORDER BY con DESC LIMIT 10"); 
echo "<table>";
 while ($rows = $consulta->fetch_assoc()){
echo "<tr><td>".$rows["nombre_tema"]."</td><td></td><td>".$rows["con"]."</td></tr>";
}
echo "</table>";

echo "<h3>Mejores puntuadas</h3><hr>";
$que="SELECT * FROM titulopelicula,titulo WHERE titulo.id_titulo=titulopelicula.id_pelicula and año=$anio ORDER BY titulopelicula.puntuacion DESC, titulopelicula.mediaprof DESC LIMIT 10";
 $consulta=$miconexion->query($que); 

echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=130 height=192.5  src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["puntuacion"]."</td>";
 }

echo "</tr></table>";

echo "<h3>Mejores puntuadas según Filmaffinity</h3><hr>";
$que="SELECT * FROM titulopelicula,titulo WHERE titulo.id_titulo=titulopelicula.id_pelicula and año=$anio ORDER BY titulopelicula.filmaffinity DESC, titulopelicula.mediaprof DESC LIMIT 10";
 $consulta=$miconexion->query($que); 

echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=130 height=192.5  src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["filmaffinity"]."</td>";
 }

echo "</tr></table>";

echo "<h3>Mejores puntuadas según IMDB</h3><hr>";
 $que="SELECT * FROM titulopelicula,titulo WHERE titulo.id_titulo=titulopelicula.id_pelicula and año=$anio ORDER BY titulopelicula.imdb DESC, titulopelicula.mediaprof DESC LIMIT 10"; 
 $consulta=$miconexion->query($que); 

echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=130 height=192.5  src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["imdb"]."</td>";
 }

echo "</tr></table>";

echo "<h3>Mejores puntuadas según RottenTomatoes</h3><hr>";
 $que="SELECT * FROM titulopelicula,titulo WHERE titulo.id_titulo=titulopelicula.id_pelicula and año=$anio ORDER BY titulopelicula.tomatometer DESC,titulopelicula.mediaprof DESC LIMIT 10"; 
 $consulta=$miconexion->query($que); 

echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=130 height=192.5  src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["tomatometer"]."</td>";
 }

echo "</tr></table>";

echo "<h3>Mejores puntuadas según AudienceScore</h3><hr>";
 $que="SELECT * FROM titulopelicula,titulo WHERE titulo.id_titulo=titulopelicula.id_pelicula and año=$anio ORDER BY titulopelicula.audiencescore DESC,titulopelicula.mediaprof DESC LIMIT 10"; 
$consulta=$miconexion->query($que); 

echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=130 height=192.5  src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["audiencescore"]."</td>";
 }

echo "</tr></table>";

echo "<h3>Mejores puntuadas según Letterboxd</h3><hr>";
 $que="SELECT * FROM titulopelicula,titulo WHERE titulo.id_titulo=titulopelicula.id_pelicula and año=$anio ORDER BY titulopelicula.letterboxd DESC, titulopelicula.mediaprof DESC LIMIT 10"; 
$consulta=$miconexion->query($que); 

echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=130 height=192.5  src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["letterboxd"]."</td>";
 }

echo "</tr></table>";

echo "<h3>Mejores puntuadas según media profesional</h3><hr>";
 $que="SELECT * FROM titulopelicula,titulo WHERE titulo.id_titulo=titulopelicula.id_pelicula and mediaprof>0 and año=$anio ORDER BY mediaprof DESC LIMIT 10"; 
$consulta=$miconexion->query($que); 

echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=130 height=192.5  src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".number_format($rows2["mediaprof"],2)."</td>";
 }

echo "</tr></table>";


echo "<h3>Peores puntuadas</h3><hr>";
$que="SELECT * FROM titulopelicula,titulo WHERE titulo.id_titulo=titulopelicula.id_pelicula and año=$anio ORDER BY titulopelicula.puntuacion ASC, titulopelicula.mediaprof ASC LIMIT 10"; 
$consulta=$miconexion->query($que); 

echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=130 height=192.5  src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["puntuacion"]."</td>";
 }

echo "</tr></table>";
echo "<h3>Peores puntuadas según Filmaffinity</h3><hr>";
 $que="SELECT * FROM titulopelicula,titulo WHERE titulo.id_titulo=titulopelicula.id_pelicula and año=$anio and titulopelicula.filmaffinity>0 ORDER BY titulopelicula.filmaffinity ASC, titulopelicula.mediaprof ASC LIMIT 10";
 $consulta=$miconexion->query($que); 

echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=130 height=192.5  src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["filmaffinity"]."</td>";
 }

echo "</tr></table>";
echo "<h3>Peores puntuadas según IMDB</h3><hr>";
  $que="SELECT * FROM titulopelicula,titulo WHERE titulo.id_titulo=titulopelicula.id_pelicula and año=$anio and imdb>0 ORDER BY titulopelicula.imdb ASC, titulopelicula.mediaprof ASC LIMIT 10"; 
 $consulta=$miconexion->query($que); 

echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=130 height=192.5  src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["imdb"]."</td>";
 }

echo "</tr></table>";
echo "<h3>Peores puntuadas según RottenTomatoes</h3><hr>";
 $que=("SELECT * FROM titulopelicula,titulo WHERE  titulo.id_titulo=titulopelicula.id_pelicula and año=$anio and titulopelicula.tomatometer>0 ORDER BY titulopelicula.tomatometer ASC, titulopelicula.mediaprof ASC LIMIT 10"); 
$consulta=$miconexion->query($que); 

echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=130 height=192.5  src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["tomatometer"]."</td>";
 }

echo "</tr></table>";
echo "<h3>Peores puntuadas según AudienceScore</h3><hr>";
 $que=("SELECT * FROM titulopelicula,titulo WHERE titulo.id_titulo=titulopelicula.id_pelicula and año=$anio and titulopelicula.audiencescore>0 ORDER BY titulopelicula.audiencescore ASC, titulopelicula.mediaprof ASC LIMIT 10"); 
$consulta=$miconexion->query($que); 

echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=130 height=192.5  src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["audiencescore"]."</td>";
 }

echo "</tr></table>";
echo "<h3>Peores puntuadas según Letterboxd</h3><hr>";
 $que=("SELECT * FROM titulopelicula,titulo WHERE titulo.id_titulo=titulopelicula.id_pelicula and año=$anio and titulopelicula.letterboxd>0 ORDER BY titulopelicula.letterboxd ASC, titulopelicula.mediaprof ASC LIMIT 10"); 
$consulta=$miconexion->query($que); 

echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=130 height=192.5  src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["letterboxd"]."</td>";
 }

echo "</tr></table>";

echo "<h3>Peores puntuadas según media profesional</h3><hr>";
 $que="SELECT * FROM titulopelicula,titulo WHERE titulo.id_titulo=titulopelicula.id_pelicula and mediaprof>0 and año=$anio ORDER BY titulopelicula.mediaprof ASC LIMIT 10"; 
$consulta=$miconexion->query($que); 

echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=130 height=192.5  src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".number_format($rows2["mediaprof"],2)."</td>";
 }

echo "</tr></table>";


echo "<h3>Españolas mejor puntuadas</h3><hr>";
 $que="SELECT * FROM titulopelicula,titulo WHERE  titulo.id_titulo=titulopelicula.id_pelicula and año=$anio AND pais='España' ORDER BY titulopelicula.puntuacion DESC, titulopelicula.mediaprof DESC LIMIT 5"; 
 $consulta=$miconexion->query($que); 
echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=156 height=231  src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["puntuacion"]."</td>";
 }

echo "</tr></table>";

echo "<h3>Extranjeras mejor puntuadas</h3><hr>";
 $que="SELECT * FROM titulopelicula,titulo WHERE  titulo.id_titulo=titulopelicula.id_pelicula and año=$anio AND pais NOT LIKE 'España' AND pais NOT LIKE 'Estados Unidos' AND pais NOT LIKE 'Reino Unido' ORDER BY titulopelicula.puntuacion DESC, titulopelicula.mediaprof DESC LIMIT 5"; 
 $consulta=$miconexion->query($que); 
echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=156 height=231  src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["puntuacion"]."</td>";
 }

echo "</tr></table>";



echo "<h3>Documentales mejor puntuados</h3><hr>";
 $que=("SELECT * FROM titulopelicula,titulo WHERE  titulo.id_titulo=titulopelicula.id_pelicula and año=$anio AND documental=1 ORDER BY titulopelicula.puntuacion DESC, titulopelicula.mediaprof DESC LIMIT 5"); 
 $consulta=$miconexion->query($que); 
echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=156 height=231  src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["puntuacion"]."</td>";
 }

echo "</tr></table>";

echo "<h3>Dramas mejor puntuados</h3><hr>";
 $que=("SELECT * FROM titulopelicula,genero,peliculasgeneros,titulo WHERE  titulo.id_titulo=titulopelicula.id_pelicula and peliculasgeneros.id_genero=genero.id_genero and peliculasgeneros.id_pelicula=titulopelicula.id_pelicula and año=$anio and genero.id_genero=2 ORDER BY titulopelicula.puntuacion DESC, titulopelicula.mediaprof DESC LIMIT 5"); 
$consulta=$miconexion->query($que); 
echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=156 height=231  src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["puntuacion"]."</td>";
 }

echo "</tr></table>";
echo "<h3>Películas de animación mejor puntuadas</h3><hr>";
 $que=("SELECT * FROM titulopelicula,genero,peliculasgeneros,titulo WHERE  titulo.id_titulo=titulopelicula.id_pelicula and peliculasgeneros.id_genero=genero.id_genero and peliculasgeneros.id_pelicula=titulopelicula.id_pelicula and año=$anio and genero.id_genero=14 ORDER BY titulopelicula.puntuacion DESC, titulopelicula.mediaprof DESC LIMIT 5"); 
$consulta=$miconexion->query($que); 
echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=156 height=231  src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["puntuacion"]."</td>";
 }

echo "</tr></table>";
echo "<h3>Películas de ciencia ficción mejor puntuadas</h3><hr>";
 $que=("SELECT * FROM titulopelicula,genero,peliculasgeneros,titulo WHERE  titulo.id_titulo=titulopelicula.id_pelicula and peliculasgeneros.id_genero=genero.id_genero and peliculasgeneros.id_pelicula=titulopelicula.id_pelicula and año=$anio and genero.id_genero=7 ORDER BY titulopelicula.puntuacion DESC, titulopelicula.mediaprof DESC LIMIT 5"); 
$consulta=$miconexion->query($que); 
echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=156 height=231  src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["puntuacion"]."</td>";
 }

echo "</tr></table>";
echo "<h3>Películas de terror mejor puntuadas</h3><hr>";
 $que=("SELECT * FROM titulopelicula,genero,peliculasgeneros,titulo WHERE  titulo.id_titulo=titulopelicula.id_pelicula and peliculasgeneros.id_genero=genero.id_genero and peliculasgeneros.id_pelicula=titulopelicula.id_pelicula and año=$anio and genero.id_genero=6 ORDER BY titulopelicula.puntuacion DESC, titulopelicula.mediaprof DESC LIMIT 5"); 
$consulta=$miconexion->query($que); 
echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=156 height=231  src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["puntuacion"]."</td>";
 }

echo "</tr></table>";
echo "<h3>Películas de acción mejor puntuadas</h3><hr>";
 $que=("SELECT * FROM titulopelicula,genero,peliculasgeneros,titulo WHERE  titulo.id_titulo=titulopelicula.id_pelicula and peliculasgeneros.id_genero=genero.id_genero and peliculasgeneros.id_pelicula=titulopelicula.id_pelicula and año=$anio and genero.id_genero=3 ORDER BY titulopelicula.puntuacion DESC, titulopelicula.mediaprof DESC LIMIT 5"); 
$consulta=$miconexion->query($que); 
echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=156 height=231  src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["puntuacion"]."</td>";
 }

echo "</tr></table>";
$consulta=$miconexion->query("SELECT * FROM titulopelicula WHERE año=$anio ORDER BY titulopelicula.duracion DESC LIMIT 1"); 
while ($rows = $consulta->fetch_assoc()){

echo "<strong>Película más larga</strong>: <a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]. " (".$rows["duracion"]." mins)</a>";

}
}else{
	$consulta=$miconexion->query("SELECT COUNT(*) as con FROM titulocapitulo,fechastitulos WHERE titulocapitulo.id_capitulo=fechastitulos.id_tituloand año=$anio"); 
while ($rows = $consulta->fetch_assoc()){

echo $rows["con"]." vistos";

}
echo "<br>";
$consulta=$miconexion->query("SELECT COUNT(*) as con FROM temporada,titulocapitulo,fechastitulos WHERE temporada.id_temporada=titulocapitulo.ns AND titulocapitulo.id_capitulo=fechastitulos.id_tituloand año=$anio AND numero_temporada=1 AND e=1"); 
while ($rows = $consulta->fetch_assoc()){

echo $rows["con"]." series empezadas";

}
}

?>
</div>