<?php
include "../conexion.php";
$miconexion->query("DELETE FROM fechastitulos WHERE id_visionado LIKE '".$_GET["id"]."'");
header ("Location:../index.php");
?>