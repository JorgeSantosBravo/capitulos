<?php

include "header/header.php";
include "conexion.php";




$consulta=$miconexion->query("SELECT * FROM lista"); 
while ($rows = $consulta->fetch_assoc()){
	echo "<a href=verlista.php?id=".$rows["id_lista"]."&t=".$rows["tipo"].">".$rows["nombre_lista"]."</a>";
	$consulta2=$miconexion->query("SELECT COUNT(id_elemento) as con FROM listaselementos WHERE id_lista=".$rows["id_lista"]); 
while ($rows2 = $consulta2->fetch_assoc()){
	echo " (".$rows2["con"];
	
}
if ($rows2["tipo"]==0){
	echo " personas";
}else{
	echo " títulos";
}
echo ")<br>";
}
?>