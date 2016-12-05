<?php
include "header/header.php";
include "conexion.php";
if ($_GET["t"]==0){
$consulta=$miconexion->query("SELECT * FROM lista,listaselementos,persona WHERE lista.id_lista=listaselementos.id_lista and listaselementos.id_elemento=persona.id_persona and lista.id_lista=".$_GET["id"]); 
while ($rows = $consulta->fetch_assoc()){

echo "<a href=persona.php?id=".$rows["id_persona"].">".$rows["Nombre_persona"]."</a><br>";


	
}


}
?>