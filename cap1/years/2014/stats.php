<title>2014 - Resumen</title>
<div align=center><h1>2014</h1>
<h2>Películas</h2>
<?php
$consulta=$miconexion->query("SELECT COUNT(*) as con FROM titulopelicula,fechastitulos WHERE titulopelicula.id_pelicula=fechastitulos.id_titulo and YEAR(fechastitulos.fecha)=2014"); 
while ($rows = $consulta->fetch_assoc()){

echo $rows["con"]." vistas";

}
?>
 de las cuales...<br> 
 <?php
 $consulta=$miconexion->query("SELECT COUNT(*) as con FROM titulopelicula,fechastitulos WHERE titulopelicula.id_pelicula=fechastitulos.id_titulo and YEAR(fechastitulos.fecha)=2014 and documental=1"); 
while ($rows = $consulta->fetch_assoc()){

echo $rows["con"]." eran documentales";

}
echo "<br>";
 $consulta=$miconexion->query("SELECT COUNT(*) as con FROM titulopelicula,fechastitulos WHERE titulopelicula.id_pelicula=fechastitulos.id_titulo and YEAR(fechastitulos.fecha)=2014 and año=2014"); 
while ($rows = $consulta->fetch_assoc()){

echo $rows["con"]." eran del 2014";

}
echo "<br>";
 $consulta=$miconexion->query("SELECT COUNT(*) as con FROM titulopelicula,fechastitulos WHERE titulopelicula.id_pelicula=fechastitulos.id_titulo and YEAR(fechastitulos.fecha)=2014 and formato LIKE 'Cine%'"); 
while ($rows = $consulta->fetch_assoc()){

echo $rows["con"]." fueron vistas en el cine";

}
echo "<br><br>";
 $consulta=$miconexion->query("SELECT SUM(duracion) as con FROM titulopelicula,fechastitulos WHERE titulopelicula.id_pelicula=fechastitulos.id_titulo and YEAR(fechastitulos.fecha)=2014"); 
while ($rows = $consulta->fetch_assoc()){
	$mins=$rows["con"]/60;
echo "Minutos: ".$rows["con"]. " (".number_format($mins,2)." horas)";

}
echo "<br><h3>Por meses</h3><table>";
 $consulta=$miconexion->query("SELECT COUNT(*) as con, MONTH(fecha) as mes FROM fechastitulos,titulopelicula WHERE fechastitulos.id_titulo=titulopelicula.id_pelicula and YEAR(fechastitulos.fecha)=2014 GROUP BY MONTH(fecha) ORDER BY MONTH(fecha) ASC"); 
while ($rows = $consulta->fetch_assoc()){
	echo "<tr><td>";
switch ($rows["mes"]){
	case 1: echo "Enero";break;
	case 2: echo "Febrero ";break;
	case 3: echo "Marzo ";break;
	case 4: echo "Abril ";break;
	case 5: echo "Mayo";break;
	case 6: echo "Junio ";break;
	case 7: echo "Julio ";break;
	case 8: echo "Agosto ";break;
	case 9: echo "Septiembre ";break;
	case 10: echo "Octubre ";break;
	case 11: echo "Noviembre ";break;
	case 12: echo "Diciembre ";break;
}
echo "</td><td>";
echo $rows["con"]."</td></tr>";
}

echo "</table><h3>Por países</h3>";
 $consulta=$miconexion->query("SELECT *,COUNT(*) as con FROM fechastitulos,titulopelicula WHERE fechastitulos.id_titulo=titulopelicula.id_pelicula and YEAR(fechastitulos.fecha)=2014 GROUP BY pais ORDER BY con DESC LIMIT 10"); 
echo "<table>";
 while ($rows = $consulta->fetch_assoc()){
echo "<tr><td>".$rows["pais"]."</td><td>".$rows["con"]."</td></tr>";
}
echo "</table>";

echo "<h3>Por directores</h3>";
 $consulta=$miconexion->query("SELECT *,COUNT(*) as con FROM fechastitulos,titulopelicula,persona,titulosdirectores WHERE fechastitulos.id_titulo=titulopelicula.id_pelicula and persona.id_persona=titulosdirectores.id_director and titulosdirectores.id_titulo=titulopelicula.id_pelicula and YEAR(fechastitulos.fecha)=2014 GROUP BY id_persona ORDER BY con DESC LIMIT 10"); 
echo "<table>";
 while ($rows = $consulta->fetch_assoc()){
echo "<tr><td><a href=persona.php?id=".$rows["id_persona"].">".$rows["Nombre_persona"]."</a></td><td>".$rows["con"]."</td></tr>";
}
echo "</table>";
echo "<h3>Por actores</h3>";
 $consulta=$miconexion->query("SELECT *,COUNT(*) as con FROM fechastitulos,titulopelicula,persona,peliculasactores WHERE fechastitulos.id_titulo=titulopelicula.id_pelicula and persona.id_persona=peliculasactores.id_actor and peliculasactores.id_pelicula=titulopelicula.id_pelicula and YEAR(fechastitulos.fecha)=2014 GROUP BY id_persona ORDER BY con DESC LIMIT 25"); 
echo "<table>";
 while ($rows = $consulta->fetch_assoc()){
echo "<tr><td><a href=persona.php?id=".$rows["id_persona"].">".$rows["Nombre_persona"]."</a></td><td>".$rows["con"]."</td></tr>";
}
echo "</table>";
echo "<h3>Puntuaciones</h3>";
 $consulta=$miconexion->query("SELECT puntuacion,COUNT(*) as con FROM fechastitulos,titulopelicula WHERE fechastitulos.id_titulo=titulopelicula.id_pelicula and YEAR(fechastitulos.fecha)=2014 GROUP BY puntuacion ORDER BY puntuacion DESC"); 
echo "<table>";
 while ($rows = $consulta->fetch_assoc()){
echo "<tr><td>".$rows["puntuacion"]."</td><td></td><td>".$rows["con"]."</td></tr>";
}
echo "</table>";
/*
echo "<h3>Por géneros</h3>";
 $consulta=$miconexion->query("SELECT *, COUNT(*) as con FROM fechastitulos,titulopelicula,genero,peliculasgeneros WHERE fechastitulos.id_titulo=titulopelicula.id_pelicula and peliculasgeneros.id_genero=genero.id_genero and peliculasgeneros.id_pelicula=titulopelicula.id_pelicula and YEAR(fechastitulos.fecha)=2014 GROUP BY genero.id_genero ORDER BY con DESC"); 
echo "<table>";
 while ($rows = $consulta->fetch_assoc()){
echo "<tr><td>".$rows["nombre_genero"]."</td><td></td><td>".$rows["con"]."</td></tr>";
}
echo "</table>";
echo "<h3>Por temas</h3>";
 $consulta=$miconexion->query("SELECT *, COUNT(*) as con FROM fechastitulos,titulopelicula,tema,peliculastemas WHERE fechastitulos.id_titulo=titulopelicula.id_pelicula and peliculastemas.id_tema=tema.id_tema and peliculastemas.id_pelicula=titulopelicula.id_pelicula and YEAR(fechastitulos.fecha)=2014 GROUP BY tema.id_tema ORDER BY con DESC LIMIT 10"); 
echo "<table>";
 while ($rows = $consulta->fetch_assoc()){
echo "<tr><td>".$rows["nombre_tema"]."</td><td></td><td>".$rows["con"]."</td></tr>";
}
echo "</table>";
*/
echo "<h3>Mejores puntuadas</h3><hr>";
$que="SELECT * FROM fechastitulos,titulopelicula,titulo WHERE titulo.id_titulo=titulopelicula.id_pelicula and fechastitulos.id_titulo=titulopelicula.id_pelicula and YEAR(fechastitulos.fecha)=2014 GROUP BY id_pelicula ORDER BY puntuacion DESC,filmaffinity DESC,imdb DESC LIMIT 10";
 $consulta=$miconexion->query($que); 

echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=130 height=192.5 title=".$rows["titulo"]." src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["puntuacion"]."</td>";
 }

echo "</tr></table>";

echo "<h3>Peores puntuadas</h3><hr>";
$que="SELECT * FROM fechastitulos,titulopelicula,titulo WHERE  titulo.id_titulo=titulopelicula.id_pelicula and fechastitulos.id_titulo=titulopelicula.id_pelicula and YEAR(fechastitulos.fecha)=2014 ORDER BY puntuacion ASC,filmaffinity ASC,imdb ASC LIMIT 10"; 
$consulta=$miconexion->query($que); 

echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=130 height=192.5 title=".$rows["titulo"]." src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["puntuacion"]."</td>";
 }

echo "</tr></table>";

echo "<h3>Españolas mejor puntuadas</h3><hr>";
 $que="SELECT * FROM fechastitulos,titulopelicula,titulo WHERE  titulo.id_titulo=titulopelicula.id_pelicula and fechastitulos.id_titulo=titulopelicula.id_pelicula and YEAR(fechastitulos.fecha)=2014 and puntuacion>0 AND pais='España' ORDER BY puntuacion DESC,filmaffinity DESC,imdb DESC LIMIT 5"; 
 $consulta=$miconexion->query($que); 
echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=156 height=231 title=".$rows["titulo"]." src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["puntuacion"]."</td>";
 }

echo "</tr></table>";
echo "<h3>Documentales mejor puntuados</h3><hr>";
 $que=("SELECT * FROM fechastitulos,titulopelicula,titulo WHERE  titulo.id_titulo=titulopelicula.id_pelicula and fechastitulos.id_titulo=titulopelicula.id_pelicula and YEAR(fechastitulos.fecha)=2014 and puntuacion>0 AND documental=1 ORDER BY puntuacion DESC,filmaffinity DESC,imdb DESC LIMIT 5"); 
 $consulta=$miconexion->query($que); 
echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=156 height=231 title=".$rows["titulo"]." src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["puntuacion"]."</td>";
 }

echo "</tr></table>";
/*
echo "<h3>Dramas mejor puntuados</h3><hr>";
 $que=("SELECT * FROM fechastitulos,titulopelicula,genero,peliculasgeneros,titulo WHERE  titulo.id_titulo=titulopelicula.id_pelicula and  fechastitulos.id_titulo=titulopelicula.id_pelicula and peliculasgeneros.id_genero=genero.id_genero and peliculasgeneros.id_pelicula=titulopelicula.id_pelicula and YEAR(fechastitulos.fecha)=2014 and genero.id_genero=2 GROUP BY titulopelicula.id_pelicula ORDER BY puntuacion DESC,filmaffinity DESC,imdb DESC LIMIT 5"); 
$consulta=$miconexion->query($que); 
echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=156 height=231 title=".$rows["titulo"]." src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["puntuacion"]."</td>";
 }

echo "</tr></table>";
echo "<h3>Películas de animación mejor puntuadas</h3><hr>";
 $que=("SELECT * FROM fechastitulos,titulopelicula,genero,peliculasgeneros,titulo WHERE  titulo.id_titulo=titulopelicula.id_pelicula and fechastitulos.id_titulo=titulopelicula.id_pelicula and peliculasgeneros.id_genero=genero.id_genero and peliculasgeneros.id_pelicula=titulopelicula.id_pelicula and YEAR(fechastitulos.fecha)=2014 and genero.id_genero=14  GROUP BY titulopelicula.id_pelicula ORDER BY puntuacion DESC,filmaffinity DESC,imdb DESC LIMIT 5"); 
$consulta=$miconexion->query($que); 
echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=156 height=231 title=".$rows["titulo"]." src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["puntuacion"]."</td>";
 }

echo "</tr></table>";
echo "<h3>Películas de ciencia ficción mejor puntuadas</h3><hr>";
 $que=("SELECT * FROM fechastitulos,titulopelicula,genero,peliculasgeneros,titulo WHERE  titulo.id_titulo=titulopelicula.id_pelicula and fechastitulos.id_titulo=titulopelicula.id_pelicula and peliculasgeneros.id_genero=genero.id_genero and peliculasgeneros.id_pelicula=titulopelicula.id_pelicula and YEAR(fechastitulos.fecha)=2014 and genero.id_genero=7 ORDER BY puntuacion DESC,filmaffinity DESC,imdb DESC LIMIT 5"); 
$consulta=$miconexion->query($que); 
echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=156 height=231 title=".$rows["titulo"]." src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["puntuacion"]."</td>";
 }

echo "</tr></table>";
echo "<h3>Películas de terror mejor puntuadas</h3><hr>";
 $que=("SELECT * FROM fechastitulos,titulopelicula,genero,peliculasgeneros ,titulo WHERE  titulo.id_titulo=titulopelicula.id_pelicula and fechastitulos.id_titulo=titulopelicula.id_pelicula and peliculasgeneros.id_genero=genero.id_genero and peliculasgeneros.id_pelicula=titulopelicula.id_pelicula and YEAR(fechastitulos.fecha)=2014 and genero.id_genero=6 ORDER BY puntuacion DESC,filmaffinity DESC,imdb DESC LIMIT 5"); 
$consulta=$miconexion->query($que); 
echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=156 height=231 title=".$rows["titulo"]." src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["puntuacion"]."</td>";
 }

echo "</tr></table>";
echo "<h3>Películas de acción mejor puntuadas</h3><hr>";
 $que=("SELECT * FROM fechastitulos,titulopelicula,genero,peliculasgeneros ,titulo WHERE  titulo.id_titulo=titulopelicula.id_pelicula and  fechastitulos.id_titulo=titulopelicula.id_pelicula and peliculasgeneros.id_genero=genero.id_genero and peliculasgeneros.id_pelicula=titulopelicula.id_pelicula and YEAR(fechastitulos.fecha)=2014 and genero.id_genero=3 ORDER BY puntuacion DESC,filmaffinity DESC,imdb DESC LIMIT 5"); 
$consulta=$miconexion->query($que); 
echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=156 height=231 title=".$rows["titulo"]." src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["puntuacion"]."</td>";
 }

echo "</tr></table>";
*/
for ($i=1;$i<=12;$i++){

echo "<h3>Mejor puntuadas en ";
?>
<style type="text/css">
img.p{
border-radius: 15px 15px 15px 15px;
-moz-border-radius: 15px 15px 15px 15px;
-webkit-border-radius: 15px 15px 15px 15px;
border: 0px solid #000000;
}
</style>

<?php

switch ($i){
	case 1: echo "enero ";break;
	case 2: echo "febrero ";break;
	case 3: echo "marzo ";break;
	case 4: echo "abril ";break;
	case 5: echo "mayo ";break;
	case 6: echo "junio ";break;
	case 7: echo "julio ";break;
	case 8: echo "agosto ";break;
	case 9: echo "septiembre ";break;
	case 10: echo "octubre ";break;
	case 11: echo "noviembre ";break;
	case 12: echo "diciembre ";break;
}
echo "</h3><hr>";
 $consulta=$miconexion->query("SELECT * FROM fechastitulos,titulopelicula,titulo WHERE titulo.id_titulo=titulopelicula.id_pelicula and fechastitulos.id_titulo=titulopelicula.id_pelicula and YEAR(fechastitulos.fecha)=2014 AND MONTH(fecha)=$i GROUP BY titulopelicula.id_pelicula ORDER BY puntuacion DESC,filmaffinity DESC,imdb DESC LIMIT 5 "); 
echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=156 height=231 title=".$rows["titulo"]." src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query("SELECT * FROM fechastitulos,titulopelicula,titulo WHERE titulo.id_titulo=titulopelicula.id_pelicula and fechastitulos.id_titulo=titulopelicula.id_pelicula and YEAR(fechastitulos.fecha)=2014 AND MONTH(fecha)=$i GROUP BY titulopelicula.id_pelicula ORDER BY puntuacion DESC,filmaffinity DESC,imdb DESC LIMIT 5 "); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["puntuacion"]."</td>";
 }

echo "</tr></table>";
}
echo "<h3>Más veces vistas</h3>";

$que=("SELECT *,COUNT(*) as con FROM fechastitulos,titulopelicula,titulo WHERE titulo.id_titulo=titulopelicula.id_pelicula and fechastitulos.id_titulo=titulopelicula.id_pelicula and YEAR(fechastitulos.fecha)=2014 GROUP BY titulopelicula.id_pelicula ORDER BY con DESC LIMIT 10"); 
$consulta=$miconexion->query($que); 
echo "<table><tr>";
 while ($rows = $consulta->fetch_assoc()){

echo "<td><a href=titulo.php?id=".$rows["id_titulo"]."><img class=p width=130 height=192.5 title=".$rows["titulo"]." src=poster/".$rows["poster"]."></a></td>";

}
echo "</tr><tr>";
 $consulta2=$miconexion->query($que); 

 while ($rows2 = $consulta2->fetch_assoc()){
	echo "<td align=center>".$rows2["con"]."</td>";
 }

echo "</tr></table>";
echo "<br><br>";
$consulta=$miconexion->query("SELECT * FROM fechastitulos,titulopelicula WHERE fechastitulos.id_titulo=titulopelicula.id_pelicula and YEAR(fechastitulos.fecha)=2014 ORDER BY titulopelicula.año ASC LIMIT 1"); 
while ($rows = $consulta->fetch_assoc()){

echo "<strong>Película más antigua</strong>: <a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]. " (".$rows["año"].")</a>";

}
echo "<br><br>";
$consulta=$miconexion->query("SELECT * FROM fechastitulos,titulopelicula WHERE fechastitulos.id_titulo=titulopelicula.id_pelicula and YEAR(fechastitulos.fecha)=2014 ORDER BY titulopelicula.duracion DESC LIMIT 1"); 
while ($rows = $consulta->fetch_assoc()){

echo "<strong>Película más larga</strong>: <a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]. " (".$rows["duracion"]." mins)</a>";

}


?>
</div>