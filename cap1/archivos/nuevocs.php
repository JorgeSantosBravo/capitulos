<?php
if (!$_POST){
?>
<title>Nuevo servidor-correo</title>
<h2>Nuevo servidor-correo</h2>
<table>
<th>Correo</th><th>Servidor</th>
<form action="" method=post>

<tr><td>

<select id='correo' name='correo'>
<?php
echo "<option selected=on>Elige un correo</option>";
$consulta=$miconexion->query("SELECT * FROM correo"); 
while ($rows = $consulta->fetch_assoc()){
echo "<option value=".$rows["id_correo"].">".$rows["nombre_correo"]."</option>";
}
?>
</select>
</td><td>

<select id='serv' name='serv'>
<?php
echo "<option selected=on>Elige un servidor</option>";
$consulta=$miconexion->query("SELECT * FROM servidor"); 
while ($rows = $consulta->fetch_assoc()){
echo "<option value=".$rows["id_servidor"].">".$rows["nombre_servidor"]."</option>";
}
?>
</select>
</td>

<td><input type='submit' value='OK'></td></tr>
</table>

	</form>

<?php
}else{
		function maxid($nombreid, $tabla){
include "conexion.php";
$id=0;
$bid=$miconexion->query("SELECT MAX(".$nombreid.") as max FROM ".$tabla);
if ($rows = $bid->fetch_assoc()) {
$id=$rows["max"];
}
return $id+1;
}


if (!$miconexion->query("INSERT INTO servidorescorreos VALUES ('".maxid("id_sc","servidorescorreos")."', '".$_POST["serv"]."', '".$_POST["correo"]."', 0)")){
	echo $miconexion->error;
}else{
	header("Location:visor.php?v=archivos/index.php	");
}
	
}

?>