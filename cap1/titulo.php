<?php
include("header/header.php");
include "conexion.php";
$consulta=$miconexion->query("SELECT * FROM titulo WHERE id_titulo=".$_GET["id"]); 
while ($rows = $consulta->fetch_assoc()){
	$id=$_GET["id"];
	   $resultado=$miconexion->query("select * from titulocapitulo where id_capitulo=$id");
	 $filas=$miconexion->affected_rows;
     if($filas>=1){
		 include "capitulo.php";
	}
	
	 $resultado=$miconexion->query("select * from tituloserie where id_serie=$id");
	 $filas=$miconexion->affected_rows;
     if($filas>=1){
		 include "serie.php";
	 }
	$resultado=$miconexion->query("select * from titulopelicula where id_pelicula=$id");
	 $filas=$miconexion->affected_rows;
     if($filas>=1){
		 include "pelicula.php";
	 }
}
?>