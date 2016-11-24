<?php
include "../conexion.php";
$miconexion->query("DELETE FROM titulo WHERE id_titulo LIKE '".$_GET["id"]."'");
$miconexion->query("DELETE FROM titulopelicula WHERE id_pelicula LIKE '".$_GET["id"]."'");
$miconexion->query("DELETE FROM titulosdirectores WHERE id_titulo LIKE '".$_GET["id"]."'");
$miconexion->query("DELETE FROM peliculasguionistas WHERE id_pelicula LIKE '".$_GET["id"]."'");
$miconexion->query("DELETE FROM peliculasmusicos WHERE id_pelicula LIKE '".$_GET["id"]."'");
$miconexion->query("DELETE FROM peliculasfotografos WHERE id_pelicula LIKE '".$_GET["id"]."'");
$miconexion->query("DELETE FROM peliculasactores WHERE id_pelicula LIKE '".$_GET["id"]."'");
$miconexion->query("DELETE FROM peliculasproductoras WHERE id_pelicula LIKE '".$_GET["id"]."'");
$miconexion->query("DELETE FROM peliculasgeneros WHERE id_pelicula LIKE '".$_GET["id"]."'");
$miconexion->query("DELETE FROM peliculastemas WHERE id_pelicula LIKE '".$_GET["id"]."'");
$miconexion->query("DELETE FROM fechastitulos WHERE id_titulo LIKE '".$_GET["id"]."'");
header ("Location:../index.php");
?>