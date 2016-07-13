<?php
include "../conexion.php";
$miconexion->query("DELETE FROM capitulo WHERE id_capitulo LIKE '".$_GET["id"]."'");
header ("Location:../index.php");
?>