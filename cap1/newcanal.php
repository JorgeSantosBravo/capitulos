<link rel="stylesheet" type="text/css" media="screen" href="trebuchet.css">
<?php
include "conexion.php";
if (!$_POST){
	echo "<table >
<form action='newcanal.php' method=post>
<tr><td>Nombre</td><td> <input type='text' name='nombre'>		</td></tr>
<tr><td>País</td><td> <input type='text' name='pais'>		</td></tr>	
<tr><td>Logo</td><td> <input type='file' name='logo'>		</td></tr>
</table>
<input type=submit value='Enviar'>
</form>
";
}else{
function bid($nombreid, $tabla){
include "conexion.php";

$id=0;
$bid=$miconexion->query("SELECT MAX(".$nombreid.") as max FROM ".$tabla);
if ($rows = $bid->fetch_assoc()) {
$id=$rows["max"];
}
return $id+1;
}	
	
	
if (!$miconexion->query("INSERT INTO canal VALUES ('".bid("ID_canal", "canal")."', '".$_POST['nombre']."', '".$_POST['pais']."', '".$_POST['logo']."')")){
	echo $miconexion->error;
}else{
	header ("Location:newserie.php");
}
}
?>