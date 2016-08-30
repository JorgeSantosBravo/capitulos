<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<link rel="stylesheet" type="text/css" media="screen" href="Estilos/enlace.css">
<title>Buscar por fecha</title>
<?php
include "header/header.php";
include "conexion.php";

if (!$_POST){

echo "
<form action='buscafecha.php' method=post>

Día
<select name='dia'>";
for ($i=1;$i<=31;$i++){
echo "<option value=".$i.">".$i."</option>";
}
echo "</select>";
echo "Mes
<select name='mes'>";
for ($j=1;$j<=12;$j++){
echo "<option value=".$j.">".$j."</option>";
}
echo "</select>";
echo "Año
<select name='ano'>";
for ($k=2013;$k<=date("Y");$k++){
echo "<option value=".$k.">".$k."</option>";
}
echo "</select>";
echo "<input type=submit value='Enviar'>
</form>

";
}else{
	$i=0;
$fecha=$_POST["ano"]."-".$_POST["mes"]."-".$_POST["dia"];
$caps="SELECT * FROM capitulo,capitulosfecha,serie WHERE capitulo.serie=serie.id_serie and capitulo.serie=serie.id_serie and capitulo.id_capitulo=capitulosfecha.id_capitulo and fecha='$fecha'";
$resultado=$miconexion->query($caps);
	 $filas=$miconexion->affected_rows;
     if($filas>=1){
	 echo "<strong>Capítulos</strong>:<br>";
$consulta=$miconexion->query($caps); 
while ($rows = $consulta->fetch_assoc()){
echo "<a href=capitulo.php?id=".$rows["id_capitulo"].">".$rows["Nombre"]." - ".$rows["Titulo"]."</a><br>";
$i++;
}
echo "<br>";
}
$pelis="SELECT * FROM fechaspeliculas,peliculas WHERE peliculas.id_pelicula=fechaspeliculas.id_pelicula and fecha='$fecha'";
$resultado=$miconexion->query($pelis);
	 $filas=$miconexion->affected_rows;
     if($filas>=1){
	 echo "<strong>Películas</strong>:<br>";
$consulta=$miconexion->query($pelis); 
while ($rows = $consulta->fetch_assoc()){
echo "<a href=pelicula.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a><br>";

$i++;
}
}

if ($i==0){
	echo "No se encontró ningún capítulo ni película";
}

}
?>