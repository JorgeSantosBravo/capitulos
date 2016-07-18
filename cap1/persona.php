<link rel="stylesheet" type="text/css" media="screen" href="Estilos/enlace.css">
<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<?php
include "header/header.php";
include "conexion.php";

$stocke=$miconexion->query("SELECT * FROM persona WHERE id_persona LIKE '".$_GET["id"]."'"); 
while ($rows = $stocke->fetch_assoc()){
echo "<title>".$rows["Nombre_persona"]."</title>";
echo "<h2>".$rows["Nombre_persona"]."</h2><br>";
}
$resultado=$miconexion->query("SELECT * FROM capitulosdirectores,persona,capitulo,serie WHERE capitulo.serie=serie.id_serie and capitulosdirectores.id_capitulo=capitulo.id_capitulo and capitulosdirectores.id_director=persona.id_persona and id_director LIKE '".$_GET["id"]."'");
	 $filas=$miconexion->affected_rows;
     if($filas>=1){
	 
$stocke=$miconexion->query("SELECT * FROM capitulosdirectores,persona,capitulo,serie WHERE capitulo.serie=serie.id_serie and capitulosdirectores.id_capitulo=capitulo.id_capitulo and capitulosdirectores.id_director=persona.id_persona and id_director LIKE '".$_GET["id"]."' ORDER BY capitulo.fecha ASC"); 
echo "Director ($filas):<br>";
while ($rows = $stocke->fetch_assoc()){
echo "<a href=capitulo.php?id=".$rows["id_capitulo"].">".$rows["Nombre"]." - ".$rows["Titulo"]." #".$rows["s"].".".$rows["e"]."</a><br>";

}

echo "<br>";
	 }
	 $resultado=$miconexion->query("SELECT * FROM creadoresserie,serie,persona WHERE creadoresserie.id_sserie=serie.id_serie and creadoresserie.id_ccreador=persona.id_persona and id_ccreador LIKE '".$_GET["id"]."'");
	 $filas=$miconexion->affected_rows;
     if($filas>=1){
$stocke=$miconexion->query("SELECT * FROM creadoresserie,serie,persona WHERE creadoresserie.id_sserie=serie.id_serie and creadoresserie.id_ccreador=persona.id_persona and id_ccreador LIKE '".$_GET["id"]."'"); 
echo "Creador ($filas):<br>";
while ($rows = $stocke->fetch_assoc()){
echo "<a href=serie.php?id=".$rows["id_serie"].">".$rows["Nombre"]."</a><br>";

}
	 }


?>