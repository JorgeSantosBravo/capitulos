<link rel="stylesheet" type="text/css" media="screen" href="Estilos/enlace.css">
<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<?php
include "header/header.php";
include "conexion.php";


$img=$miconexion->query("SELECT * FROM canal WHERE ID_canal LIKE '".$_GET["id"]."'"); 
while ($rows = $img->fetch_assoc())
{
echo "<title>".$rows["Nomcanal"]."</title>";
echo "<img width=240 height=140 src=poster/logos/".$rows["Logo"]."><br>";
}

$stocke=$miconexion->query("SELECT * FROM tituloserie,canal WHERE tituloserie.canal=canal.ID_canal and canal.ID_canal LIKE '".$_GET["id"]."' ORDER BY tituloserie.titulo_serie ASC"); 
while ($rows = $stocke->fetch_assoc()){


echo "<a href=titulo.php?id=".$rows["id_serie"].">".$rows["titulo_serie"]."</a><br>";
	
}


?>