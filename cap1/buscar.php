<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<link rel="stylesheet" type="text/css" media="screen" href="Estilos/enlace.css">
<title>Buscar</title>
<?php
include "header/header.php";
include "conexion.php";
$c=0;	//CONTADOR CUYO OBJETIVO ES DECIR SI NO HAY NINGÚN RESULTADO.
$_GET["b"]=addslashes($_GET["b"]);
$capitulos="SELECT * FROM titulocapitulo,tituloserie WHERE titulocapitulo.serie=tituloserie.id_serie and (titulo_capitulo LIKE '%".$_GET["b"]."%' or titulo_capitulo LIKE '".$_GET["b"]."')";
$resultado=$miconexion->query($capitulos);
	 $filas=$miconexion->affected_rows;
     if($filas>=1){
		 
echo "<strong>Capítulos:</strong><br>";
$consulta=$miconexion->query($capitulos); 
while ($rows = $consulta->fetch_assoc()){
	echo "<a href=titulo.php?id=".$rows["id_capitulo"].">".$rows["titulo_serie"]." - ".$rows["titulo_capitulo"]." #".$rows["s"].".".$rows["e"]."</a><br>";
}
$c++;
	 }
	 
$peliculas="SELECT * FROM titulo,titulopelicula WHERE titulo.id_titulo=titulopelicula.id_pelicula and (titulo LIKE '%".$_GET["b"]."%' or titulo LIKE '".$_GET["b"]."' or titulo_original LIKE '%".$_GET["b"]."%' or titulo_original LIKE '".$_GET["b"]."')";
$resultado=$miconexion->query($peliculas);
	 $filas=$miconexion->affected_rows;
     if($filas>=1){
		 
echo "<br><strong>Películas:</strong><br>";
$consulta=$miconexion->query($peliculas); 
while ($rows = $consulta->fetch_assoc()){
echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["año"]." - ".$rows["titulo"]."</a><br>";
}
$c++;
	 }
$series="SELECT * FROM tituloserie WHERE titulo_serie LIKE '%".$_GET["b"]."%' or titulo_serie LIKE '".$_GET["b"]."'";
$resultado=$miconexion->query($series);
	 $filas=$miconexion->affected_rows;
     if($filas>=1){
echo "<br><strong>Series:</strong><br>";
$consulta=$miconexion->query($series); 
while ($rows = $consulta->fetch_assoc()){
	echo "<a href=titulo.php?id=".$rows["id_serie"].">".$rows["titulo_serie"]."</a><br>";
}
$c++;
	 }
	 $personas="SELECT * FROM persona WHERE Nombre_persona LIKE '%".$_GET["b"]."%' or Nombre_persona LIKE '".$_GET["b"]."'";
$resultado=$miconexion->query($personas);
	 $filas=$miconexion->affected_rows;
     if($filas>=1){
	 echo "<br><strong>Personas:</strong><br>";
$consulta=$miconexion->query($personas); 
while ($rows = $consulta->fetch_assoc()){
	echo "<a href=persona.php?id=".$rows["id_persona"].">".$rows["Nombre_persona"]."</a><br>";
}
$c++;
	 }
	 	 $canales="SELECT * FROM canal WHERE Nomcanal LIKE '%".$_GET["b"]."%' or Nomcanal LIKE '".$_GET["b"]."'";
$resultado=$miconexion->query($canales);
	 $filas=$miconexion->affected_rows;
     if($filas>=1){
	 echo "<br><strong>Canales:</strong><br>";
$consulta=$miconexion->query($canales); 
while ($rows = $consulta->fetch_assoc()){
	echo "<a href=canal.php?id=".$rows["ID_canal"].">".$rows["Nomcanal"]."</a><br>";
}
$c++;
	 }
	 if ($c==0){
		 echo "No se encontró ningún resultado";
	 }
?>