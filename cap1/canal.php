<?php
include "conexion.php";


$img=$miconexion->query("SELECT * FROM canal WHERE ID_canal LIKE '".$_GET["id"]."'"); 
while ($rows = $img->fetch_assoc())
{
echo "<img width=240 height=140 src=poster/logos/".$rows["Logo"]."><br>";
}

$stocke=$miconexion->query("SELECT * FROM serie,canal WHERE serie.canal=canal.ID_canal and canal.ID_canal LIKE '".$_GET["id"]."' ORDER BY serie.Nombre ASC"); 
while ($rows = $stocke->fetch_assoc()){


echo "<a href=serie.php?id=".$rows["id_serie"].">".$rows["Nombre"]."</a><br>";
	
}


?>