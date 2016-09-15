<?php
include "../conexion.php";
$miconexion->query("DELETE FROM capitulosfecha WHERE id_visionado LIKE '".$_GET["id"]."'");
header ("Location:../index.php");
?>