<title>General</title>
<style type="text/css">
img.p{
border-radius: 15px 15px 15px 15px;
-moz-border-radius: 15px 15px 15px 15px;
-webkit-border-radius: 15px 15px 15px 15px;
border: 0px solid #000000;
}
</style>

<h3>Mejores puntuadas</h3><hr>

<table border=1><tr><th></th><th>Película</th><th>Nota</th></tr>
<tr><td>Media prof.</td><td>
<?php

$que="SELECT * FROM titulopelicula ORDER BY mediaprof DESC LIMIT 1";
$consulta=$miconexion->query($que);
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td><td>".number_format($rows["mediaprof"],2)."</td></tr>";
 }
?>
<tr><td>Media</td><td>
<?php

$que="SELECT * FROM titulopelicula ORDER BY media DESC LIMIT 1";
$consulta=$miconexion->query($que);
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td><td>".number_format($rows["media"],2)."</td></tr>";
 }
?>
<tr><td>Yo</td><td>
<?php

$que="SELECT * FROM titulopelicula ORDER BY puntuacion DESC,filmaffinity DESC, imdb DESC LIMIT 1";
$consulta=$miconexion->query($que);
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td><td>".number_format($rows["puntuacion"],2)."</td></tr>";
 }
?>
<tr><td>FilmAffinity</td><td>
<?php

$que="SELECT * FROM titulopelicula ORDER BY filmaffinity DESC LIMIT 1";
$consulta=$miconexion->query($que);
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td><td>".number_format($rows["filmaffinity"],2)."</td></tr>";
 }
?>
<tr><td>IMDB</td><td>
<?php

$que="SELECT * FROM titulopelicula ORDER BY imdb DESC LIMIT 1";
$consulta=$miconexion->query($que);
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td><td>".number_format($rows["imdb"],2)."</td></tr>";
 }
?>
<tr><td>RottenTomatoes</td><td>
<?php

$que="SELECT * FROM titulopelicula ORDER BY tomatometer DESC,filmaffinity DESC, imdb DESC LIMIT 1";
$consulta=$miconexion->query($que);
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td><td>".number_format($rows["tomatometer"],2)."</td></tr>";
 }
?>
<tr><td>AudienceScore</td><td>
<?php

$que="SELECT * FROM titulopelicula ORDER BY audiencescore DESC,filmaffinity DESC, imdb DESC LIMIT 1";
$consulta=$miconexion->query($que);
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td><td>".number_format($rows["audiencescore"],2)."</td></tr>";
 }
?>
<tr><td>Letterboxd</td><td>
<?php

$que="SELECT * FROM titulopelicula ORDER BY letterboxd DESC LIMIT 1";
$consulta=$miconexion->query($que);
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td><td>".number_format($rows["letterboxd"],2)."</td></tr>";
 }
?>
</table>

<h3>Mejores puntuadas por género</h3><hr><table border=1><th>Género</th><th>Película</th><th>Puntuación</th>
<?php

$consulta=$miconexion->query("SELECT * FROM genero WHERE id_genero!=5 ORDER BY nombre_genero"); 
while ($rows = $consulta->fetch_assoc()){
	echo "<tr><td><a href=genero.php?id=".$rows["id_genero"]."&dec=&orderby=mediaprof_desc>".$rows["nombre_genero"]."</a></td><td>";
	$consulta2=$miconexion->query("SELECT * FROM titulopelicula,genero,peliculasgeneros WHERE peliculasgeneros.id_genero=genero.id_genero and peliculasgeneros.id_pelicula=titulopelicula.id_pelicula and genero.id_genero=".$rows["id_genero"]." ORDER BY mediaprof DESC LIMIT 1");
while ($rows2 = $consulta2->fetch_assoc()){
	echo "<a href=titulo.php?id=".$rows2["id_pelicula"].">".$rows2["titulo"]."</a></td><td>".number_format($rows2["mediaprof"],2)."</td></tr>";

}

}


?>
</table>
<h3>Mejores puntuadas por tema</h3><hr><table border=1><th>Tema</th><th>Película</th><th>Puntuación</th>
<?php

$consulta=$miconexion->query("SELECT * FROM tema WHERE id_tema!=8 ORDER BY nombre_tema"); 
while ($rows = $consulta->fetch_assoc()){
	echo "<tr><td><a href=tema.php?id=".$rows["id_tema"]."&dec=&orderby=mediaprof_desc>".$rows["nombre_tema"]."</a></td><td>";
	$consulta2=$miconexion->query("SELECT * FROM titulopelicula,tema,peliculastemas WHERE peliculastemas.id_tema=tema.id_tema and peliculastemas.id_pelicula=titulopelicula.id_pelicula and tema.id_tema=".$rows["id_tema"]." ORDER BY mediaprof DESC LIMIT 1");
while ($rows2 = $consulta2->fetch_assoc()){
	echo "<a href=titulo.php?id=".$rows2["id_pelicula"].">".$rows2["titulo"]."</a></td><td>".number_format($rows2["mediaprof"],2)."</td></tr>";

}

}


?>
</table>
<h3>Por década</h3><hr><table border=1><th>Década</th><th>Película</th><th>Puntuación</th>
<?php
$da=(DATE('Y')+10);


for ($i=1910;$i<=$da;$i+=10){
	echo "<tr><td><a href=allmovies.php?orderby=mediaprof_desc&dec=".$i.">".$i."-".($i+9)."</a></td><td>";
	$consulta2=$miconexion->query("SELECT * FROM titulopelicula WHERE año>=".$i." and año <=".($i+9)." ORDER BY mediaprof DESC LIMIT 1");
while ($rows2 = $consulta2->fetch_assoc()){
	echo "<a href=titulo.php?id=".$rows2["id_pelicula"].">".$rows2["titulo"]."</a></td><td>".number_format($rows2["mediaprof"],2)."</td></tr>";

}

}
?>
</table>
<h3>Por año</h3><hr><table border=1><th>Año</th><th>Película</th><th>Puntuación</th>
<?php

$consulta=$miconexion->query("SELECT DISTINCT(año) FROM titulopelicula ORDER BY año ASC"); 
while ($rows = $consulta->fetch_assoc()){
	echo "<tr><td><a href=allmovies.php?orderby=mediaprof_desc&a=".$rows["año"].">".$rows["año"]."</a></td><td>";
	$consulta2=$miconexion->query("SELECT * FROM titulopelicula WHERE año=".$rows["año"]." ORDER BY mediaprof DESC LIMIT 1");
while ($rows2 = $consulta2->fetch_assoc()){
	echo "<a href=titulo.php?id=".$rows2["id_pelicula"].">".$rows2["titulo"]."</a></td><td>".number_format($rows2["mediaprof"],2)."</td></tr>";

}

}
?>
</table>
<h3>Por país</h3><hr><table border=1><th>País</th><th>Película</th><th>Puntuación</th>
<?php

$consulta=$miconexion->query("SELECT DISTINCT(pais) FROM titulopelicula ORDER BY pais ASC"); 
while ($rows = $consulta->fetch_assoc()){
	echo "<tr><td><a href=allmovies.php?orderby=mediaprof_desc&pais=".$rows["pais"].">".$rows["pais"]."</a></td><td>";
	$consulta2=$miconexion->query("SELECT * FROM titulopelicula WHERE pais LIKE '".$rows["pais"]."' ORDER BY mediaprof DESC LIMIT 1");
while ($rows2 = $consulta2->fetch_assoc()){
	echo "<a href=titulo.php?id=".$rows2["id_pelicula"].">".$rows2["titulo"]."</a></td><td>".number_format($rows2["mediaprof"],2)."</td></tr>";

}

}
?>
</table>
<h3>Peores puntuadas</h3><hr>

<table border=1><tr><th></th><th>Película</th><th>Nota</th></tr>
<tr><td>Media prof.</td><td>
<?php

$que="SELECT * FROM titulopelicula WHERE mediaprof>0 ORDER BY mediaprof ASC LIMIT 1";
$consulta=$miconexion->query($que);
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td><td>".number_format($rows["mediaprof"],2)."</td></tr>";
 }
?>
<tr><td>Media</td><td>
<?php

$que="SELECT * FROM titulopelicula WHERE media>0 ORDER BY media ASC LIMIT 1";
$consulta=$miconexion->query($que);
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td><td>".number_format($rows["media"],2)."</td></tr>";
 }
?>
<tr><td>Yo</td><td>
<?php

$que="SELECT * FROM titulopelicula WHERE puntuacion>0 ORDER BY puntuacion ASC,filmaffinity ASC, imdb ASC LIMIT 1";
$consulta=$miconexion->query($que);
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td><td>".number_format($rows["puntuacion"],2)."</td></tr>";
 }
?>
<tr><td>FilmAffinity</td><td>
<?php

$que="SELECT * FROM titulopelicula WHERE filmaffinity>0 ORDER BY filmaffinity ASC LIMIT 1";
$consulta=$miconexion->query($que);
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td><td>".number_format($rows["filmaffinity"],2)."</td></tr>";
 }
?>
<tr><td>IMDB</td><td>
<?php

$que="SELECT * FROM titulopelicula WHERE imdb>0 ORDER BY imdb ASC LIMIT 1";
$consulta=$miconexion->query($que);
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td><td>".number_format($rows["imdb"],2)."</td></tr>";
 }
?>
<tr><td>RottenTomatoes</td><td>
<?php

$que="SELECT * FROM titulopelicula WHERE tomatometer>0 ORDER BY tomatometer ASC,filmaffinity ASC, imdb ASC LIMIT 1";
$consulta=$miconexion->query($que);
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td><td>".number_format($rows["tomatometer"],2)."</td></tr>";
 }
?>
<tr><td>AudienceScore</td><td>
<?php

$que="SELECT * FROM titulopelicula WHERE audiencescore>0 ORDER BY audiencescore ASC,filmaffinity ASC, imdb ASC LIMIT 1";
$consulta=$miconexion->query($que);
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td><td>".number_format($rows["audiencescore"],2)."</td></tr>";
 }
?>
<tr><td>Letterboxd</td><td>
<?php

$que="SELECT * FROM titulopelicula WHERE letterboxd>0 ORDER BY letterboxd ASC LIMIT 1";
$consulta=$miconexion->query($que);
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td><td>".number_format($rows["letterboxd"],2)."</td></tr>";
 }
?>
</table>
<h3>Peores puntuadas por género</h3><hr><table border=1><th>Género</th><th>Película</th><th>Puntuación</th>
<?php

$consulta=$miconexion->query("SELECT * FROM genero WHERE id_genero!=5 ORDER BY nombre_genero"); 
while ($rows = $consulta->fetch_assoc()){
	echo "<tr><td><a href=genero.php?id=".$rows["id_genero"]."&dec=&orderby=mediaprof_ASC>".$rows["nombre_genero"]."</a></td><td>";
	$consulta2=$miconexion->query("SELECT * FROM titulopelicula,genero,peliculasgeneros WHERE peliculasgeneros.id_genero=genero.id_genero and peliculasgeneros.id_pelicula=titulopelicula.id_pelicula and genero.id_genero=".$rows["id_genero"]." and mediaprof>0 ORDER BY mediaprof ASC LIMIT 1");
while ($rows2 = $consulta2->fetch_assoc()){
	echo "<a href=titulo.php?id=".$rows2["id_pelicula"].">".$rows2["titulo"]."</a></td><td>".number_format($rows2["mediaprof"],2)."</td></tr>";

}

}


?>
</table>
<h3>Por década</h3><hr><table border=1><th>Década</th><th>Película</th><th>Puntuación</th>
<?php
$da=(DATE('Y')+10);


for ($i=1910;$i<=$da;$i+=10){
	echo "<tr><td><a href=allmovies.php?orderby=mediaprof_ASC&dec=".$i.">".$i."-".($i+9)."</a></td><td>";
	$consulta2=$miconexion->query("SELECT * FROM titulopelicula WHERE año>=".$i." and año <=".($i+9)." and mediaprof>0 ORDER BY mediaprof ASC LIMIT 1");
while ($rows2 = $consulta2->fetch_assoc()){
	echo "<a href=titulo.php?id=".$rows2["id_pelicula"].">".$rows2["titulo"]."</a></td><td>".number_format($rows2["mediaprof"],2)."</td></tr>";

}

}
?>
</table>
<h3>Por año</h3><hr><table border=1><th>Año</th><th>Película</th><th>Puntuación</th>
<?php

$consulta=$miconexion->query("SELECT DISTINCT(año) FROM titulopelicula ORDER BY año ASC"); 
while ($rows = $consulta->fetch_assoc()){
	echo "<tr><td><a href=allmovies.php?orderby=mediaprof_ASC&a=".$rows["año"].">".$rows["año"]."</a></td><td>";
	$consulta2=$miconexion->query("SELECT * FROM titulopelicula WHERE año=".$rows["año"]."  and mediaprof>0 ORDER BY mediaprof ASC LIMIT 1");
while ($rows2 = $consulta2->fetch_assoc()){
	echo "<a href=titulo.php?id=".$rows2["id_pelicula"].">".$rows2["titulo"]."</a></td><td>".number_format($rows2["mediaprof"],2)."</td></tr>";

}

}
?>
</table>