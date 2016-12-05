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
$caps="SELECT * FROM titulocapitulo,fechastitulos,tituloserie WHERE titulocapitulo.serie=tituloserie.id_serie and titulocapitulo.id_capitulo=fechastitulos.id_titulo and fecha='$fecha'";
$resultado=$miconexion->query($caps);
	 $filas=$miconexion->affected_rows;
     if($filas>=1){
	 echo "<strong>Capítulos</strong>:<br>";
$consulta=$miconexion->query($caps); 
while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_titulo"].">".$rows["titulo_serie"]." - ".$rows["titulo_capitulo"]."</a><br>";
$i++;
}
echo "<br>";
}
$pelis="SELECT * FROM fechastitulos,titulopelicula WHERE titulopelicula.id_pelicula=fechastitulos.id_titulo and fecha='$fecha'";
$resultado=$miconexion->query($pelis);
	 $filas=$miconexion->affected_rows;
     if($filas>=1){
	 echo "<strong>Películas</strong>:<br>";
$consulta=$miconexion->query($pelis); 
while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_titulo"].">".$rows["titulo"]."</a><br>";

$i++;
}
}

if ($i==0){
	echo "No se encontró ningún capítulo ni película";
}

}
?>