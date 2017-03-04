<title>General</title>
<style type="text/css">
img.p{
border-radius: 15px 15px 15px 15px;
-moz-border-radius: 15px 15px 15px 15px;
-webkit-border-radius: 15px 15px 15px 15px;
border: 0px solid #000000;
}
</style>


<h3>Global</h3>
<table border=1><tr><th rowspan="2">Año</th><th colspan="7">Mejores</th><th colspan="7">Peores</th><th colspan="8">Mejores</th><th rowspan="2">País más visto</th><th rowspan="2">Películas</th><th rowspan="2">Aprobadas</th><th rowspan="2">Suspensas</th><th rowspan="2">Media</th><th rowspan="2">Media prof.</th><th rowspan="2">Género más visto</th><th rowspan="2">Tema más visto</th><th rowspan="2">Más larga</th><th rowspan="2">Más corta</th></tr>
<tr><th>Yo</th><th>FilmAffinity</th><th>IMDB</th><th>RottenTomatoes</th><th>AudienceScore</th><th>Letterboxd</th><th>Media prof.</th><th>Yo</th><th>FilmAffinity</th><th>IMDB</th><th>RottenTomatoes</th><th>AudienceScore</th><th>Letterboxd</th><th>Media prof.</th><th>Española</th><th>Extranjera</th><th>Documental</th><th>Drama</th><th>Animación</th><th>Ciencia ficción</th><th>Terror</th><th>Acción</th></tr>
<?php
$i=0;

$consulta2=$miconexion->query("SELECT DISTINCT(año) FROM titulopelicula ORDER BY año asc"); 
while ($rows2 = $consulta2->fetch_assoc()){
echo "<tr";
if ($i%2!=0)
{echo" bgcolor=#E6E6E6>";}
else{
	echo" bgcolor=white>";
}


echo "<td>".$rows2["año"]."</td>";
$anio=$rows2["año"];
$que="SELECT * FROM titulopelicula WHERE año=$anio and puntuacion>0 ORDER BY puntuacion DESC, mediaprof DESC LIMIT 1";
 $consulta=$miconexion->query($que); 
 echo "<td>";
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a>";

}
echo "</td>";
$que="SELECT * FROM titulopelicula WHERE año=$anio and filmaffinity>0 ORDER BY filmaffinity DESC, mediaprof DESC LIMIT 1";
 $consulta=$miconexion->query($que); 
 echo "<td>";
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a>";

}
echo "</td>";
$que="SELECT * FROM titulopelicula WHERE año=$anio and imdb>0 ORDER BY imdb DESC, mediaprof DESC LIMIT 1";
 $consulta=$miconexion->query($que); 
 echo "<td>";
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a>";

}
echo "</td>";
$que="SELECT * FROM titulopelicula WHERE año=$anio and tomatometer>0 ORDER BY tomatometer DESC, mediaprof DESC LIMIT 1";
 $consulta=$miconexion->query($que); 
 echo "<td>";
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a>";

}
echo "</td>";


$que="SELECT * FROM titulopelicula WHERE año=$anio and audiencescore>0 ORDER BY audiencescore DESC, mediaprof DESC LIMIT 1";
 $consulta=$miconexion->query($que); 
 echo "<td>";
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a>";

}
echo "</td>";
$que="SELECT * FROM titulopelicula WHERE año=$anio and letterboxd>0 ORDER BY letterboxd DESC, mediaprof DESC LIMIT 1";
 $consulta=$miconexion->query($que); 
 echo "<td>";
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a>";

}
echo "</td>";

$que="SELECT * FROM titulopelicula WHERE año=$anio and mediaprof>0 ORDER BY mediaprof DESC, mediaprof DESC LIMIT 1";
 $consulta=$miconexion->query($que); 
 echo "<td>";
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a>";

}
echo "</td>";

$que="SELECT * FROM titulopelicula WHERE año=$anio and puntuacion>0 ORDER BY puntuacion ASC, mediaprof ASC LIMIT 1";
 $consulta=$miconexion->query($que); 
 echo "<td>";
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a>";

}
echo "</td>";


$que="SELECT * FROM titulopelicula WHERE año=$anio and filmaffinity>0 ORDER BY filmaffinity ASC, mediaprof ASC LIMIT 1";
 $consulta=$miconexion->query($que); 
 echo "<td>";
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a>";

}
echo "</td>";


$que="SELECT * FROM titulopelicula WHERE año=$anio and imdb>0 ORDER BY imdb ASC, mediaprof ASC LIMIT 1";
 $consulta=$miconexion->query($que); 
 echo "<td>";
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a>";

}
echo "</td>";


$que="SELECT * FROM titulopelicula WHERE año=$anio and tomatometer>0 ORDER BY tomatometer ASC, mediaprof ASC LIMIT 1";
 $consulta=$miconexion->query($que); 
 echo "<td>";
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a>";

}
echo "</td>";


$que="SELECT * FROM titulopelicula WHERE año=$anio and audiencescore>0 ORDER BY audiencescore ASC, mediaprof ASC LIMIT 1";
 $consulta=$miconexion->query($que); 
 echo "<td>";
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a>";

}
echo "</td>";


$que="SELECT * FROM titulopelicula WHERE año=$anio and letterboxd>0 ORDER BY letterboxd ASC, mediaprof ASC LIMIT 1";
 $consulta=$miconexion->query($que); 
 echo "<td>";
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a>";

}
echo "</td>";


$que="SELECT * FROM titulopelicula WHERE año=$anio and mediaprof>0 ORDER BY mediaprof ASC LIMIT 1";
 $consulta=$miconexion->query($que); 
 echo "<td>";
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a>";

}
echo "</td>";


$que="SELECT * FROM titulopelicula WHERE año=$anio and puntuacion>0 and pais='España' ORDER BY puntuacion DESC,mediaprof DESC LIMIT 1";
 $consulta=$miconexion->query($que); 
 echo "<td>";
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a>";

}
echo "</td>";

$que="SELECT * FROM titulopelicula WHERE año=$anio and puntuacion>0 and pais NOT LIKE 'España' AND pais NOT LIKE 'Estados Unidos' AND pais NOT LIKE 'Reino Unido' ORDER BY puntuacion DESC,mediaprof DESC LIMIT 1";
 $consulta=$miconexion->query($que); 
 echo "<td>";
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a>";

}
echo "</td>";


$que="SELECT * FROM titulopelicula WHERE año=$anio and puntuacion>0 and documental=1 ORDER BY puntuacion DESC,mediaprof DESC LIMIT 1";
 $consulta=$miconexion->query($que); 
 echo "<td>";
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a>";

}
echo "</td>";


$que="SELECT * FROM titulopelicula,genero,peliculasgeneros,titulo WHERE  titulo.id_titulo=titulopelicula.id_pelicula and peliculasgeneros.id_genero=genero.id_genero and peliculasgeneros.id_pelicula=titulopelicula.id_pelicula and año=$anio and genero.id_genero=2 ORDER BY titulopelicula.puntuacion DESC, titulopelicula.mediaprof DESC LIMIT 1";
 $consulta=$miconexion->query($que); 
 echo "<td>";
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a>";

}
echo "</td>";


$que="SELECT * FROM titulopelicula,genero,peliculasgeneros,titulo WHERE  titulo.id_titulo=titulopelicula.id_pelicula and peliculasgeneros.id_genero=genero.id_genero and peliculasgeneros.id_pelicula=titulopelicula.id_pelicula and año=$anio and genero.id_genero=14 ORDER BY titulopelicula.puntuacion DESC, titulopelicula.mediaprof DESC LIMIT 1";
 $consulta=$miconexion->query($que); 
 echo "<td>";
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a>";

}
echo "</td>";


$que="SELECT * FROM titulopelicula,genero,peliculasgeneros,titulo WHERE  titulo.id_titulo=titulopelicula.id_pelicula and peliculasgeneros.id_genero=genero.id_genero and peliculasgeneros.id_pelicula=titulopelicula.id_pelicula and año=$anio and genero.id_genero=7 ORDER BY titulopelicula.puntuacion DESC, titulopelicula.mediaprof DESC LIMIT 1";
 $consulta=$miconexion->query($que); 
 echo "<td>";
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a>";

}
echo "</td>";


$que="SELECT * FROM titulopelicula,genero,peliculasgeneros,titulo WHERE  titulo.id_titulo=titulopelicula.id_pelicula and peliculasgeneros.id_genero=genero.id_genero and peliculasgeneros.id_pelicula=titulopelicula.id_pelicula and año=$anio and genero.id_genero=6 ORDER BY titulopelicula.puntuacion DESC, titulopelicula.mediaprof DESC LIMIT 1";
 $consulta=$miconexion->query($que); 
 echo "<td>";
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a>";

}
echo "</td>";

$que="SELECT * FROM titulopelicula,genero,peliculasgeneros,titulo WHERE  titulo.id_titulo=titulopelicula.id_pelicula and peliculasgeneros.id_genero=genero.id_genero and peliculasgeneros.id_pelicula=titulopelicula.id_pelicula and año=$anio and genero.id_genero=3 ORDER BY titulopelicula.puntuacion DESC, titulopelicula.mediaprof DESC LIMIT 1";
 $consulta=$miconexion->query($que); 
 echo "<td>";
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a>";

}
echo "</td>";


 $consulta=$miconexion->query("SELECT *,COUNT(*) as con FROM titulopelicula WHERE puntuacion>0 and año=$anio GROUP BY pais ORDER BY con DESC LIMIT 1"); 
echo "<td>";
 while ($rows = $consulta->fetch_assoc()){
echo $rows["pais"];
}
echo "</td>";
$consulta=$miconexion->query("SELECT COUNT(*) as con FROM titulopelicula WHERE puntuacion>0 and año=$anio"); 

echo "<td>";
while ($rows = $consulta->fetch_assoc()){

echo $rows["con"];
}
echo "</td>";
$consulta=$miconexion->query("SELECT titulopelicula.puntuacion,COUNT(*) as con FROM titulopelicula WHERE año=$anio  and puntuacion>=5"); 
echo "<td>";
while ($rows = $consulta->fetch_assoc()){
	echo $rows["con"];
}
echo "</td>";

$consulta=$miconexion->query("SELECT titulopelicula.puntuacion,COUNT(*) as con FROM titulopelicula WHERE año=$anio  and puntuacion<5"); 
echo "<td>";
while ($rows = $consulta->fetch_assoc()){
	echo $rows["con"];
}
echo "</td>";


$consulta=$miconexion->query("SELECT AVG(puntuacion) as con FROM titulopelicula WHERE año=$anio and puntuacion>0"); 
echo "<td>";
while ($rows = $consulta->fetch_assoc()){
	echo number_format($rows["con"],2);
}
echo "</td>";

$consulta=$miconexion->query("SELECT AVG(mediaprof) as con FROM titulopelicula WHERE año=$anio and mediaprof>0"); 
echo "<td>";
while ($rows = $consulta->fetch_assoc()){
	echo number_format($rows["con"],2);
}
echo "</td>";


$consulta=$miconexion->query("SELECT *, COUNT(*) as con FROM titulopelicula,genero,peliculasgeneros WHERE peliculasgeneros.id_genero=genero.id_genero and peliculasgeneros.id_pelicula=titulopelicula.id_pelicula and año=$anio GROUP BY genero.id_genero ORDER BY con DESC LIMIT 1"); 
echo "<td>";
while ($rows = $consulta->fetch_assoc()){
	echo $rows["nombre_genero"];
}
echo "</td>";

$consulta=$miconexion->query("SELECT *, COUNT(*) as con FROM titulopelicula,tema,peliculastemas WHERE peliculastemas.id_tema=tema.id_tema and peliculastemas.id_pelicula=titulopelicula.id_pelicula and año=$anio GROUP BY tema.id_tema ORDER BY con DESC LIMIT 1"); 
echo "<td>";
while ($rows = $consulta->fetch_assoc()){
	echo $rows["nombre_tema"];
}
echo "</td>";


$consulta=$miconexion->query("SELECT * FROM titulopelicula WHERE año=$anio ORDER BY titulopelicula.duracion DESC LIMIT 1"); 

echo "<td>";
while ($rows = $consulta->fetch_assoc()){
	echo $rows["titulo"];
}
echo "</td>";

$consulta=$miconexion->query("SELECT * FROM titulopelicula WHERE año=$anio ORDER BY titulopelicula.duracion ASC LIMIT 1"); 

echo "<td>";
while ($rows = $consulta->fetch_assoc()){
	echo $rows["titulo"];
}
echo "</td>";

$i++;
echo "</tr>";
}


?>



</table>

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

<h3>Mejores puntuadas por género</h3><hr><table border=1><th>Género</th><th>Película</th><th>Puntuación</th><th>Películas</th>
<?php

$consulta=$miconexion->query("SELECT * FROM genero WHERE id_genero!=5 ORDER BY nombre_genero"); 
while ($rows = $consulta->fetch_assoc()){
	echo "<tr><td><a href=genero.php?id=".$rows["id_genero"]."&dec=&orderby=mediaprof_desc>".$rows["nombre_genero"]."</a></td><td>";
	$consulta2=$miconexion->query("SELECT * FROM titulopelicula,genero,peliculasgeneros WHERE peliculasgeneros.id_genero=genero.id_genero and peliculasgeneros.id_pelicula=titulopelicula.id_pelicula and genero.id_genero=".$rows["id_genero"]." ORDER BY mediaprof DESC LIMIT 1");
while ($rows2 = $consulta2->fetch_assoc()){
	echo "<a href=titulo.php?id=".$rows2["id_pelicula"].">".$rows2["titulo"]."</a></td><td>".number_format($rows2["mediaprof"],2)."</td>";

}
	$consulta2=$miconexion->query("SELECT COUNT(*) as con FROM peliculasgeneros WHERE id_genero=".$rows["id_genero"]."");
while ($rows2 = $consulta2->fetch_assoc()){

echo "<td>".$rows2["con"]."</td>";

}

	echo "</tr>";
}


?>
</table>
<h3>Mejores géneros</h3><hr><table border=1><th>Género</th><th>Media</th>
<?php

$consulta=$miconexion->query("SELECT *,AVG(mediaprof) as mediai FROM titulopelicula,genero,peliculasgeneros WHERE peliculasgeneros.id_genero=genero.id_genero and peliculasgeneros.id_pelicula=titulopelicula.id_pelicula and genero.id_genero!=5 GROUP BY genero.id_genero ORDER BY mediai DESC"); 
while ($rows = $consulta->fetch_assoc()){
	echo "<tr><td><a href=genero.php?id=".$rows["id_genero"]."&dec=&orderby=mediaprof_desc>".$rows["nombre_genero"]."</a></td><td>".number_format($rows["mediai"],2)."</td></tr>";



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
<h3>Mejores temas</h3><hr><table border=1><th>Tema</th><th>Media</th>
<?php



$consulta=$miconexion->query("SELECT *,AVG(mediaprof) as mediai FROM titulopelicula,tema,peliculastemas WHERE peliculastemas.id_tema=tema.id_tema and peliculastemas.id_pelicula=titulopelicula.id_pelicula and tema.id_tema!=8 GROUP BY tema.id_tema ORDER BY mediai DESC"); 
while ($rows = $consulta->fetch_assoc()){
	
	$consulta3=$miconexion->query("SELECT COUNT(*) as con FROM peliculastemas WHERE id_tema=".$rows["id_tema"]); 
while ($rows3 = $consulta3->fetch_assoc()){
	if ($rows3["con"]>=5){
	echo "<tr><td><a href=tema.php?id=".$rows["id_tema"]."&dec=&orderby=mediaprof_desc>".$rows["nombre_tema"]."</a></td><td>".number_format($rows["mediai"],2)."</td></tr>";


	}
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
<h3>Por año</h3><hr><table border=1><th>Año</th><th>Película</th><th>Puntuación</th><th>Películas</th>
<?php

$consulta=$miconexion->query("SELECT DISTINCT(año) FROM titulopelicula ORDER BY año asc"); 
while ($rows = $consulta->fetch_assoc()){
	echo "<tr><td><a href=allmovies.php?orderby=mediaprof_desc&a=".$rows["año"].">".$rows["año"]."</a></td><td>";
	$consulta2=$miconexion->query("SELECT * FROM titulopelicula WHERE año=".$rows["año"]." ORDER BY mediaprof DESC LIMIT 1");
while ($rows2 = $consulta2->fetch_assoc()){
	echo "<a href=titulo.php?id=".$rows2["id_pelicula"].">".$rows2["titulo"]."</a></td><td>".number_format($rows2["mediaprof"],2)."</td>";
	
	
	


}
	$consulta2=$miconexion->query("SELECT COUNT(*) as con FROM titulopelicula WHERE año=".$rows["año"]."");
while ($rows2 = $consulta2->fetch_assoc()){

echo "<td>".$rows2["con"]."</td>";

}

	echo "</tr>";
}
?>
</table>
<h3>Por país</h3><hr><table border=1><th>País</th><th>Película</th><th>Puntuación</th>
<?php

$consulta=$miconexion->query("SELECT DISTINCT(pais) FROM titulopelicula ORDER BY pais asc"); 
while ($rows = $consulta->fetch_assoc()){
	echo "<tr><td><a href=allmovies.php?orderby=mediaprof_desc&pais=".urlencode($rows["pais"]).">".$rows["pais"]."</a></td><td>";
	$consulta2=$miconexion->query("SELECT * FROM titulopelicula WHERE pais LIKE '".$rows["pais"]."' ORDER BY mediaprof DESC LIMIT 1");
while ($rows2 = $consulta2->fetch_assoc()){
	echo "<a href=titulo.php?id=".$rows2["id_pelicula"].">".$rows2["titulo"]."</a></td><td>".number_format($rows2["mediaprof"],2)."</td></tr>";

}

}
?>
</table>
<h3></h3><hr><table border=1><th>País</th><th>Puntuación</th><th>Total</th>
<?php

$consulta=$miconexion->query("SELECT pais,AVG(mediaprof) as mediai FROM titulopelicula GROUP BY pais ORDER BY mediai DESC"); 
while ($rows = $consulta->fetch_assoc()){
	$consulta3=$miconexion->query("SELECT COUNT(*) as con FROM titulopelicula WHERE pais LIKE '".$rows["pais"]."'"); 
while ($rows3 = $consulta3->fetch_assoc()){
	if ($rows3["con"]>=5){
	echo "<tr><td><a href=allmovies.php?orderby=mediaprof_desc&pais=".urlencode($rows["pais"]).">".$rows["pais"]."</a></td><td>".number_format($rows["mediai"],2)."</td><td>".$rows3["con"]."</tr>";

}
	}
}


?>
</table>
<h3>Peores puntuadas</h3><hr>

<table border=1><tr><th></th><th>Película</th><th>Nota</th></tr>
<tr><td>Media prof.</td><td>
<?php

$que="SELECT * FROM titulopelicula WHERE mediaprof>0 ORDER BY mediaprof asc LIMIT 1";
$consulta=$miconexion->query($que);
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td><td>".number_format($rows["mediaprof"],2)."</td></tr>";
 }
?>
<tr><td>Media</td><td>
<?php

$que="SELECT * FROM titulopelicula WHERE media>0 ORDER BY media asc LIMIT 1";
$consulta=$miconexion->query($que);
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td><td>".number_format($rows["media"],2)."</td></tr>";
 }
?>
<tr><td>Yo</td><td>
<?php

$que="SELECT * FROM titulopelicula WHERE puntuacion>0 ORDER BY puntuacion asc,filmaffinity asc, imdb asc LIMIT 1";
$consulta=$miconexion->query($que);
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td><td>".number_format($rows["puntuacion"],2)."</td></tr>";
 }
?>
<tr><td>FilmAffinity</td><td>
<?php

$que="SELECT * FROM titulopelicula WHERE filmaffinity>0 ORDER BY filmaffinity asc LIMIT 1";
$consulta=$miconexion->query($que);
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td><td>".number_format($rows["filmaffinity"],2)."</td></tr>";
 }
?>
<tr><td>IMDB</td><td>
<?php

$que="SELECT * FROM titulopelicula WHERE imdb>0 ORDER BY imdb asc LIMIT 1";
$consulta=$miconexion->query($que);
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td><td>".number_format($rows["imdb"],2)."</td></tr>";
 }
?>
<tr><td>RottenTomatoes</td><td>
<?php

$que="SELECT * FROM titulopelicula WHERE tomatometer>0 ORDER BY tomatometer asc,filmaffinity asc, imdb asc LIMIT 1";
$consulta=$miconexion->query($que);
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td><td>".number_format($rows["tomatometer"],2)."</td></tr>";
 }
?>
<tr><td>AudienceScore</td><td>
<?php

$que="SELECT * FROM titulopelicula WHERE audiencescore>0 ORDER BY audiencescore asc,filmaffinity asc, imdb asc LIMIT 1";
$consulta=$miconexion->query($que);
 while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a></td><td>".number_format($rows["audiencescore"],2)."</td></tr>";
 }
?>
<tr><td>Letterboxd</td><td>
<?php

$que="SELECT * FROM titulopelicula WHERE letterboxd>0 ORDER BY letterboxd asc LIMIT 1";
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
	echo "<tr><td><a href=genero.php?id=".$rows["id_genero"]."&dec=&orderby=mediaprof_asc>".$rows["nombre_genero"]."</a></td><td>";
	$consulta2=$miconexion->query("SELECT * FROM titulopelicula,genero,peliculasgeneros WHERE peliculasgeneros.id_genero=genero.id_genero and peliculasgeneros.id_pelicula=titulopelicula.id_pelicula and genero.id_genero=".$rows["id_genero"]." and mediaprof>0 ORDER BY mediaprof asc LIMIT 1");
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
	echo "<tr><td><a href=allmovies.php?orderby=mediaprof_asc&dec=".$i.">".$i."-".($i+9)."</a></td><td>";
	$consulta2=$miconexion->query("SELECT * FROM titulopelicula WHERE año>=".$i." and año <=".($i+9)." and mediaprof>0 ORDER BY mediaprof asc LIMIT 1");
while ($rows2 = $consulta2->fetch_assoc()){
	echo "<a href=titulo.php?id=".$rows2["id_pelicula"].">".$rows2["titulo"]."</a></td><td>".number_format($rows2["mediaprof"],2)."</td></tr>";

}

}
?>
</table>
<h3>Por año</h3><hr><table border=1><th>Año</th><th>Película</th><th>Puntuación</th>
<?php

$consulta=$miconexion->query("SELECT DISTINCT(año) FROM titulopelicula ORDER BY año asc"); 
while ($rows = $consulta->fetch_assoc()){
	echo "<tr><td><a href=allmovies.php?orderby=mediaprof_asc&a=".$rows["año"].">".$rows["año"]."</a></td><td>";
	$consulta2=$miconexion->query("SELECT * FROM titulopelicula WHERE año=".$rows["año"]."  and mediaprof>0 ORDER BY mediaprof asc LIMIT 1");
while ($rows2 = $consulta2->fetch_assoc()){
	echo "<a href=titulo.php?id=".$rows2["id_pelicula"].">".$rows2["titulo"]."</a></td><td>".number_format($rows2["mediaprof"],2)."</td></tr>";

}

}
?>
</table>