<?php
include "../conexion.php";
$miconexion->query("DELETE FROM titulo WHERE id_titulo LIKE '".$_GET["id"]."'");
$miconexion->query("DELETE FROM titulocapitulo WHERE id_capitulo LIKE '".$_GET["id"]."'");
$miconexion->query("DELETE FROM titulosdirectores WHERE id_titulo LIKE '".$_GET["id"]."'");
$miconexion->query("DELETE FROM fechastitulos WHERE id_titulo LIKE '".$_GET["id"]."'");

header ("Location:../index.php");
?>