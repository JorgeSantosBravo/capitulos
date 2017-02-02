<?php
if (!$_POST){

echo "<table>
<title>Nuevo correo</title>
<form action='' method=post>

<tr><td>Nombre</td><td><input type='text' name='nombre'></td></tr>
<tr><td>Contraseña</td><td><input type='password' name='password'></td></tr>
<tr><td></td><td><input type=submit value='Enviar'></td></tr>
</form>
</table>
";
}else{

$id=0;
$bid=$miconexion->query("SELECT MAX(id_correo) as max FROM correo");
if ($rows = $bid->fetch_assoc()) {
$id=$rows["max"];
}
$id++;

if ($miconexion->query("INSERT INTO correo VALUES ('$id', '".$_POST["nombre"]."', '".$_POST["password"]."')")){
	header("Location:visor.php?v=archivos/index.php	");
}else{
echo $miconexion->error;
}
}