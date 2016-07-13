<link rel="stylesheet" type="text/css" media="screen" href="../trebuchet.css">
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
//IMPORTANTE: HACE UNA COSA MUY RARA CON LOS DIRECTORES EN LOS NUEVOS CAPÍTULOS Y NO PIDE CONFIRMACIÓN. AL PULSAR EL BOTÓN HACE LA FUNCIÓN
session_start();
if (!$_POST){

echo "
<form action='capitulo.php?id=".$_GET["id"]."' method=post>
<table>
<tr><td>
Título</td><td><input type='text' name='titulo' value='".$_SESSION["titulo"]."'></td></tr>
<tr><td>
Temporada</td><td><input type='text' name='s' value='".$_SESSION["s"]."' size=1></td></tr>
<tr><td>
Episodio</td><td><input type='text' name='e' value='".$_SESSION["e"]."' size=1></td></tr>
<tr><td>
Director</td><td><input type='text' name=dire value='".$_SESSION["dire"]."'</td></tr>
<tr><td>
Duración</td><td><input type='text' name=dur value='".$_SESSION["dur"]."' size=1></td></tr>

</table>
<input type=submit value='Enviar'><input type=button value='Volver atrás' onclick=window.location.href='../capitulo.php?id=".$_GET["id"]."'>

</form>
<input type=button value='Borrar capítulo' onclick=eliminar()>
";
//PARA EDITAR LA FECHA PODRÍA HACER UN CALENDARIO 
}else{
	include "../conexion.php";
if (!$miconexion->query("UPDATE capitulo SET Titulo='".$_POST["titulo"]."', s='".$_POST["s"]."', e='".$_POST["e"]."', Duracion='".$_POST["dur"]."' WHERE id_capitulo LIKE '".$_GET["id"]."'")){
	echo $miconexion->error;
}
$miconexion->query("DELETE FROM capitulosdirectores WHERE id_capitulo LIKE '".$_GET["id"]."'");

function bid($nombreid, $tabla){
include "../conexion.php";

$id=0;
$bid=$miconexion->query("SELECT MAX(".$nombreid.") as max FROM ".$tabla);
if ($rows = $bid->fetch_assoc()) {
$id=$rows["max"];
}
return $id+1;
}
 $idcap=bid("id_serie", "serie");
 
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
		
		if (!$miconexion->query("INSERT INTO capitulosdirectores VALUES ('".$_GET['id']."', '".buscarid($dir[$j], "director", "Nomdir", "ID_director")."')")){
			echo buscarid($dir[$j], "director", "Nomdir", "ID_director");
			echo "uno";
			echo $miconexion->error;
		}
	}
	}else{
		
		if (!$miconexion->query("INSERT INTO capitulosdirectores VALUES ('".$_GET['id']."', '".buscarid($elemento, "director", "Nomdir", "ID_director")."')")){
			echo buscarid($elemento, "director", "Nomdir", "ID_director")."<br>";
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
		 
		 $id=bid("ID_director", "director");
		 $miconexion->query("INSERT INTO director (ID_director, Nomdir) VALUES ('".$id."', '".$campo."')");
	 }
	return $id;
}
directores($_POST["dire"]);
session_destroy();
header ("Location:../capitulo.php?id=".$_GET["id"]."");

}

?>