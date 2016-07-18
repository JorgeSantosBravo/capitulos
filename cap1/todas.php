<title>Todas las series </title>
<link rel="stylesheet" href="Estilos/animations.css">

<style type="text/css">
body{ background: #000 url('fondos/degradadooscuro.jpg') no-repeat top right fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;}
</style>
<?php
include ("header/header.php");
include ("conexion.php");

$cont=$miconexion->query("SELECT id_serie,Nombre,Poster,inicio FROM serie ORDER BY inicio ASC");

while ($rows = $cont->fetch_assoc()) {
echo ' <a href=serie.php?id='.$rows["id_serie"].'><img class="todas" title='.urlencode($rows["Nombre"]).' src=poster/'.$rows["Poster"].'></a>';
}
?>
