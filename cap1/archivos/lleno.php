<?php
if (!$_POST){
	
?>
<title>Servidor lleno</title>
<form action='' method=post>
<tr><td>¿Qué servidor está lleno?</td><td>
<?php
echo "<select id='lugar' name='lugar'>";
echo "<option selected=on>Elige</option>";
$consulta=$miconexion->query("SELECT * FROM servidorescorreos,servidor,correo WHERE servidorescorreos.id_sservidor=servidor.id_servidor and servidorescorreos.id_ccorreo=correo.id_correo and lleno=0"); 
while ($rows = $consulta->fetch_assoc()){
echo "<option value=".$rows["id_sc"].">".$rows["nombre_servidor"]."  (".$rows["nombre_correo"].")</option>";
}

echo "</select>
<tr><td></td><td><input type=submit value='Enviar'></td></tr>
</form>
";


?>
</td></tr>
<?php
}else{


if ($miconexion->query("UPDATE servidorescorreos SET Lleno=1 WHERE id_sc=".$_POST["lugar"])){
	header("Location:visor.php?v=archivos/index.php	");
}else{
echo $miconexion->error;
}
}