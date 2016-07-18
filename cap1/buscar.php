<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<link rel="stylesheet" type="text/css" media="screen" href="Estilos/enlace.css">
<?php
include "header/header.php";
include "conexion.php";
$c=0;	//CONTADOR CUYO OBJETIVO ES DECIR SI NO HAY NINGÚN RESULTADO.
$capitulos="SELECT * FROM capitulo,serie WHERE capitulo.serie=serie.id_serie and (Titulo LIKE '%".$_GET["b"]."%' or Titulo LIKE '".$_GET["b"]."')";
$resultado=$miconexion->query($capitulos);
	 $filas=$miconexion->affected_rows;
     if($filas>=1){
		 
echo "<strong>Capítulos:</strong><br>";
$consulta=$miconexion->query($capitulos); 
while ($rows = $consulta->fetch_assoc()){
	echo "<a href=capitulo.php?id=".$rows["id_capitulo"].">".$rows["Nombre"]." - ".$rows["Titulo"]." #".$rows["s"].".".$rows["e"]."</a><br>";
}
$c++;
	 }
$series="SELECT * FROM serie WHERE Nombre LIKE '%".$_GET["b"]."%' or Nombre LIKE '".$_GET["b"]."'";
$resultado=$miconexion->query($series);
	 $filas=$miconexion->affected_rows;
     if($filas>=1){
echo "<br><strong>Series:</strong><br>";
$consulta=$miconexion->query($series); 
while ($rows = $consulta->fetch_assoc()){
	echo "<a href=serie.php?id=".$rows["id_serie"].">".$rows["Nombre"]."</a><br>";
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