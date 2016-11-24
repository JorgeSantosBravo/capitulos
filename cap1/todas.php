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

$cont=$miconexion->query("SELECT * FROM tituloserie,titulo WHERE titulo.id_titulo=tituloserie.id_serie and seguimiento=1 ORDER BY inicio,id_serie ASC");

while ($rows = $cont->fetch_assoc()) {
echo ' <a href=titulo.php?id='.$rows["id_serie"].'><img class="todas" title='.urlencode($rows["titulo_serie"]).' src=poster/'.$rows["poster"].'></a>';
}
?>
