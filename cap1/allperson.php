<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<link rel="stylesheet" type="text/css" media="screen" href="Estilos/enlace.css">
<?php

include "conexion.php";
$stocke=$miconexion->query("SELECT * FROM persona ORDER BY Nombre_persona ASC"); 
while ($rows = $stocke->fetch_assoc()){
	echo "<a href=persona.php?id=".$rows["id_persona"].">".$rows["Nombre_persona"]."</a><br>";
}



?>