<title>Todas las películas </title>
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

$cont=$miconexion->query("SELECT * FROM peliculas ORDER BY año,id_pelicula ASC");

while ($rows = $cont->fetch_assoc()) {
echo ' <a href=pelicula.php?id='.$rows["id_pelicula"].'><img class="todas" title='.urlencode($rows["titulo"]).' src=poster/'.$rows["poster"].'></a>';
}
?>
