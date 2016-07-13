<?php

include "conexion.php";

$stocke=$miconexion->query("SELECT * FROM capitulo"); 
while ($rows = $stocke->fetch_assoc()){
if (strpos($rows["Titulo"], "+")){
$nueva=str_replace("+", "'", $rows["Titulo"]);
if (!$miconexion->query ("UPDATE capitulo SET Titulo ='".addslashes($nueva)."' WHERE id_capitulo LIKE '".$rows["id_capitulo"]."'")){
	echo $miconexion->error;
}
}
}

?>