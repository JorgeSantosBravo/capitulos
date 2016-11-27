<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<style type="text/css">
body{ background: #000 url('fondos/degradado.jpg') no-repeat top right fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;}
</style>
<title>Nuevo capítulo</title>
<?php
include "header/header.php";
include "conexion.php";

if (!isset($_POST["cap"])&&!isset($_POST["temp"])){
echo "<table>
<form action='' method=post>

<tr><td>Fecha</td><td><input type='date' name='fecha'>	</td></tr>
<tr><td>Visto en:</td><td> <input type='pc' size=2 name='pc'>	<input type='for' size=5 name='for'>	</td></tr>
<tr><td>Serie</td>
<td><select name='serie'>
<option selected>Elige serie...</option>
";

$stocke=$miconexion->query("SELECT * FROM tituloserie WHERE seguimiento=1 ORDER BY titulo_serie");
while ($rows = $stocke->fetch_assoc()){

echo "<option value ='".$rows['id_serie']."'>".$rows['titulo_serie']."</option>";

}
echo "</select>";

echo "</td><td><input type=button name='ns' value='Añadir nueva' onclick='dialogo()'></td></tr>
<tr><td></td><td> S<input type='text' name='s' size=1> E<input type='text' name='e' size=1>		</td></tr>
<tr><td>Título</td><td> <input type='text' name='titulo'>		</td></tr>
<tr><td>Director</td><td>";
include "director.php";
echo "</td></tr>

<tr><td>Duración</td><td> <input type='text' name='dur' size=1>		</td></tr>

<tr><td>Comentario</td><td><textarea name='com'></textarea></td></tr>

</table>
<input name=cap type=submit value='Enviar'>
</form>
";

?>

<script type="text/javascript">
function dialogo(){
	document.location.href='newserie.php'; 
}

</script>

<?php



}else{
	session_start();

	//DOY VALOR AL ARRAY DE SESIÓN CON LOS CAMPOS DEL FORMULARIO
	foreach($_POST as $campo => $valor) {
        $_SESSION["cap"][$campo] = $valor;
    }

	 
	
	
	
var_dump($_SESSION["cap"]);

	
	
	function maxid($nombreid, $tabla){
include "conexion.php";
$id=0;
$bid=$miconexion->query("SELECT MAX(".$nombreid.") as max FROM ".$tabla);
if ($rows = $bid->fetch_assoc()) {
$id=$rows["max"];
}
return $id+1;
}
 $idcap=maxid("id_titulo", "titulo");
	
function directores ($elemento){
	include "conexion.php";
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
		
		$miconexion->query("INSERT INTO titulosdirectores (id_titulo, id_director) VALUES ('".$GLOBALS['idcap']."', '".addslashes(buscarid($dir[$j], "persona", "Nombre_persona", "id_persona"))."')");
	}
	}else{
		
		$miconexion->query("INSERT INTO titulosdirectores (id_titulo, id_director) VALUES ('".$GLOBALS['idcap']."', '".addslashes(buscarid($elemento, "persona", "Nombre_persona", "id_persona"))."')");
	}
	 
}

function buscarid($campo, $tabla, $nombrecampo, $nombreid){
	include "conexion.php";
$miconsulta="SELECT * FROM ".$tabla." WHERE ".$nombrecampo." LIKE '".$campo."'";
	$resultado=$miconexion->query($miconsulta);
	 $filas=$miconexion->affected_rows;
	 $id=0;
	 
	 if($filas>=1){
		 while ($rows = $resultado->fetch_assoc()){

		 $id=$rows[$nombreid];
		 }
		 echo $campo." - ".$id; 
		 
		
		 
	 }else{
		 
		 $id=maxid("ID_persona", "persona");
		 $miconexion->query("INSERT INTO persona (ID_persona, Nombre_persona) VALUES ('".$id."', '".addslashes($campo)."')");
	 }
	return $id;
}

function buscartemp($serie, $s){
	$t=0;
	include "conexion.php";
	$consulta=$miconexion->query("SELECT * FROM temporada WHERE serie=".$serie." AND numero_temporada=".$s); 
while ($rows = $consulta->fetch_assoc()){
	$t=$rows["id_temporada"];
	
	
}
	
	
	return $t;
}


//PARA EL ID DE LA Serie
//$ids=buscarid($_POST["serie"], "serie", "Nombre", "id_serie");



	$consulta="SELECT * FROM temporada WHERE serie=".$_SESSION["cap"]["serie"]." AND numero_temporada=".$_SESSION["cap"]["s"]; 
$resultado=$miconexion->query($consulta);
	 $filas=$miconexion->affected_rows;
	 $id=0;
	 
	 if($filas>=1){
	
	
//INSERT NORMAL SI LA TEMPORADA YA EXISTE
if (!$miconexion->query("INSERT INTO titulo (id_titulo) VALUES ('".$idcap."')")){
	echo $miconexion->error;
}
if (!$miconexion->query("INSERT INTO titulocapitulo VALUES ('".$idcap."', '".addslashes($_SESSION["cap"]["titulo"])."', '".$_POST["serie"]."', '".buscartemp($_SESSION["cap"]["serie"], $_SESSION["cap"]["s"])."', '".$_POST['e']."', '".$_POST['dur']."')")){
	echo $miconexion->error;
}
directores ($_SESSION["cap"]["persona"]);
echo "<br>".$_SESSION["cap"]["persona"]."<br>";
if (!$miconexion->query("INSERT INTO fechastitulos (id_visionado, id_titulo, fecha, medio, formato, comentario) VALUES ('".maxid("id_visionado", "fechastitulos")."', '".$idcap."', '".$_SESSION["cap"]["fecha"]."', '".$_SESSION["cap"]['pc']."', '".$_SESSION["cap"]['for']."', '".$_SESSION["cap"]['com']."')")){
	echo $miconexion->error;
}
header ("Location:index.php");
	
}else if (!isset($_POST["temp"])){
	echo "	<form action='nuevocap.php' method=post>
<table>
<tr><td>Año</td><td><input type='text' size=2 name='anio'>	</td></tr>
<tr><td>Alias</td><td> <input type='text' size=2 name='alias'></td</tr></table>";
	
	
echo "<input name=temp type=submit value='Enviar'>
</form>";
}
else{
	$nuevoid=$idcap+1;
	$miconexion->query("INSERT INTO titulo (id_titulo) VALUES ('".$idcap."')");
	if (!$miconexion->query("INSERT INTO temporada VALUES ('".$idcap."', '".$_SESSION["cap"]["s"]."', '".$_SESSION["cap"]["serie"]."', '".$_POST["alias"]."', '".$_POST["anio"]."')")){
		echo $miconexion->error;
	}
//PARA LOS DIRECTORES
$idcap++;
directores ($_SESSION["cap"]["persona"]);
echo "<br>".$_SESSION["cap"]["persona"]."<br>";
	if (!$miconexion->query("INSERT INTO titulo (id_titulo) VALUES ('".($nuevoid)."')")){
	echo $miconexion->error;
}
if (!$miconexion->query("INSERT INTO titulocapitulo VALUES ('".($nuevoid)."', '".addslashes($_SESSION["cap"]["titulo"])."', '".$_SESSION["cap"]["serie"]."', '".buscartemp($_SESSION["cap"]["serie"], $_SESSION["cap"]["s"])."', '".$_SESSION["cap"]['e']."', '".$_SESSION["cap"]['dur']."')")){
	echo $miconexion->error;
}
if (!$miconexion->query("INSERT INTO fechastitulos (id_visionado, id_titulo, fecha, medio, formato, comentario) VALUES ('".maxid("id_visionado", "fechastitulos")."', '".$nuevoid."', '".$_SESSION["cap"]["fecha"]."', '".$_SESSION["cap"]['pc']."', '".$_SESSION["cap"]['for']."', '".$_SESSION["cap"]['com']."')")){
	echo $miconexion->error;
}
header ("Location:index.php");
}

$miconexion->query("DELETE FROM titulosdirectores WHERE id_director=127");


}
echo "<BR><br> - O - <br><br> <a href=rewatch.php>REWATCH</a>";

?>