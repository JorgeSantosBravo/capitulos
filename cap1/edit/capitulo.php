﻿<link rel="stylesheet" type="text/css" media="screen" href="../Estilos/trebuchet.css">
<script type="text/javascript">
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}


function eliminar() {

if(confirm("¿Estás seguro de que deseas eliminar el capítulo?")) {
var id = getParameterByName('id');
location.href="delete.php?id="+id;

}


} 
</script>


<?php
//session_start();
include "../conexion.php";
if (!$_POST){
$consulta=$miconexion->query("SELECT * FROM titulocapitulo,temporada WHERE titulocapitulo.ns=temporada.id_temporada and id_capitulo=".$_GET["id"]); 
while ($rows = $consulta->fetch_assoc()){

echo "
<form action='capitulo.php?id=".$_GET["id"]."' method=post>
<table>
<tr><td>
Título</td><td><input type='text' name='titulo' value=\"".$rows["titulo_capitulo"]."\"></td></tr>
<tr><td>
Temporada</td><td><input type='text' name='s' value='".$rows["numero_temporada"]."' size=1></td></tr>
<tr><td>
Episodio</td><td><input type='text' name='e' value='".$rows["e"]."' size=1></td></tr>
<tr><td>";

//INPUT CON EL VALOR DEL ID DE LA SERIE
echo "<input type='hidden' value='".$rows["serie"]."' name='serie'>";
//INPUT CON EL VALOR DEL ID DE LA TEMPORADA
echo "<input type='hidden' value='".$rows["ns"]."' name='temp'>";




$a = array();
$r2=$miconexion->query("SELECT * FROM titulo,persona,titulosdirectores WHERE titulo.id_titulo=titulosdirectores.id_titulo and titulosdirectores.id_director=persona.id_persona and titulosdirectores.id_titulo LIKE  '$_GET[id]'");
while ($rows2 = $r2->fetch_assoc()) {

array_push($a, $rows2["Nombre_persona"]);
}
$final= implode(', ', $a);
echo "Director</td><td><input type='text' name=dire value=\"".$final."\"</td></tr>
<tr><td>
Duración</td><td><input type='text' name=dur value='".$rows["duracion"]."' size=1></td></tr>

</table>
<input type=submit value='Enviar'><input type=button value='Volver atrás' onclick=window.location.href='../titulo.php?id=".$_GET["id"]."'>

</form>";

}
echo "<input type=button value='Borrar capítulo' onclick=eliminar()>
";
//PARA EDITAR LA FECHA PODRÍA HACER UN CALENDARIO 
}else{
	include "../conexion.php";
	
	$consulta="SELECT * FROM temporada WHERE serie=".$_POST["serie"]." AND numero_temporada=".$_POST["temp"]; 
	 
	
	
if (!$miconexion->query("UPDATE titulocapitulo SET titulo_capitulo='".addslashes($_POST["titulo"])."', ns='".$_POST["temp"]."', e='".$_POST["e"]."', duracion='".$_POST["dur"]."' WHERE id_capitulo LIKE '".$_GET["id"]."'")){
	echo $miconexion->error;
}
$miconexion->query("DELETE FROM titulosdirectores WHERE id_titulo LIKE '".$_GET["id"]."'");

function bid($nombreid, $tabla){
include "../conexion.php";

$id=0;
$bid=$miconexion->query("SELECT MAX(".$nombreid.") as max FROM ".$tabla);
if ($rows = $bid->fetch_assoc()) {
$id=$rows["max"];
}
return $id+1;
}
 $idcap=bid("id_serie", "tituloserie");
 
function directores ($elemento){
	include "../conexion.php";
	if (strpos($elemento, ",")){
	$con=0;
	for ($i=0;$i<strlen($elemento);$i++){
		if ($elemento[$i]==","){
			$con++;
		}
	}
	$dir=explode(', ', $elemento);
	for ($j=0;$j<=$con;$j++){
		
		$dir[$j];
		
		if (!$miconexion->query("INSERT INTO titulosdirectores VALUES ('".$_GET['id']."', '".addslashes(buscarid($dir[$j], "persona", "Nombre_persona", "id_persona"))."')")){
			echo buscarid($dir[$j], "persona", "Nombre_persona", "ID_persona");
			echo "uno";
			echo $miconexion->error;
		}
	}
	}else{
		
		if (!$miconexion->query("INSERT INTO titulosdirectores VALUES ('".$_GET['id']."', '".addslashes(buscarid($elemento, "persona", "Nombre_persona", "id_persona"))."')")){
			echo buscarid($elemento, "persona", "Nombre_persona", "id_persona")."<br>";
			echo "otro";
			echo $miconexion->error;
		}
	}
	 
}
function buscarid($campo, $tabla, $nombrecampo, $nombreid){
	include "../conexion.php";
$miconsulta="SELECT * FROM ".$tabla." WHERE ".$nombrecampo." LIKE '".$campo."'";
	$resultado=$miconexion->query($miconsulta);
	 $filas=$miconexion->affected_rows;
	 $id=0;
	 
	 if($filas>=1){
		 while ($rows = $resultado->fetch_assoc()){

		 $id=$rows[$nombreid];
		 }
		 //echo $campo." - ".$id; 
		 
		
		 
	 }else{
		 
		 $id=bid("ID_persona", "persona");
		 $miconexion->query("INSERT INTO persona (ID_persona, Nombre_persona) VALUES ('".$id."', '".addslashes($campo)."')");
	 }
	return $id;
}
$_POST["dire"]=addslashes($_POST["dire"]);
directores($_POST["dire"]);
session_destroy();
header ("Location:../titulo.php?id=".$_GET["id"]."");

}

?>