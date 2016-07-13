<?php
	
include("id.php");
//include ("conexion.php");
if (!$_POST){
echo "
<form action='insertar.php' method=post>
<table border=1>
<tr>

<td>Fecha</td><td><input type='text' name='fecha'><br></td></tr>
<td>Medio</td><td><input type='text' name='medio'><br></td></tr>
<td>Formato</td><td><input type='text' name='formato'><br></td></tr>
<td>Serie</td><td><input type='text' name='serie'><br></td></tr>
<td>S</td><td><input type='text' name='S'><br></td></tr>
<td>E</td><td><input type='text' name='E'><br></td></tr>
<td>Título</td><td><input type='text' name='titulo'><br></td></tr>
<td>Director</td><td><input type='text' name='director'><br></td></tr>
<td>Duración</td><td><input type='text' name='duracion'><br></td></tr>
<td>Comentario</td><td><input type='text' name='comentario'><br></td></tr>
</table>
<input type=submit value='Enviar'>
</form>
";

}else{

$serie=$miconexion->query("SELECT ID_serie FROM series ORDER BY ID_serie");
while ($rows = $serie->fetch_assoc()) {

$ser=$rows["ID_serie"];

}

$ser+=1;
//PARA BUSCAR SERIES
$buscar="SELECT * from series WHERE Titulo LIKE '$_POST[serie]'";
$resultado=$miconexion->query($buscar);
$enc=false;
$idser=0;
$idcad=0;
while ($rows = $resultado->fetch_assoc()) {
	if ($rows["Titulo"]==$_POST["serie"]){
		$enc=true;
		$idser=$rows["ID_serie"];
		$idcad=$rows["ID_cadena"];
	}
}

include("id.php");
if ($enc==false){
if ($miconexion->query("INSERT INTO series VALUES ('$idser', '$_POST[serie]','','','','')")){
}
	else{
		echo $miconexion->error;
	}

	//PARA BUSCAR DIRECTORES
$dire="SELECT * from directores WHERE Nombre LIKE '$_POST[director]'";
$direc=$miconexion->query($dire);
$enci=false;
while ($rows = $direc->fetch_assoc()) {
	if ($rows["Nombre"]==$_POST["director"]){
		$enci=true;
		$iddir=$rows["ID_director"];
	}
}
if ($enci==false){
if ($miconexion->query("INSERT INTO directores VALUES ('$iddir', '$_POST[director]')")){
}
	else{
		echo $miconexion->error;
	}
if ($miconexion->query("INSERT INTO capitulos VALUES ('$idz' , '$_POST[fecha]' , '$_POST[medio]', '$_POST[formato]', '$ser', '$_POST[S]', '$_POST[E]', '$_POST[titulo]', '$iddir', '$_POST[duracion]','$_POST[comentario]')")){
}
	else{
		echo $miconexion->error;
	}

}
}

else{
if ($miconexion->query("INSERT INTO capitulos VALUES ('$idz' , '$_POST[fecha]' , '$_POST[medio]', '$_POST[formato]', '$ser', '$_POST[S]', '$_POST[E]', '$_POST[titulo]', '$iddir', '$_POST[duracion]', '$_POST[comentario]')") === TRUE) {
printf($miconexion->affected_rows." Filas afectadas");
echo "Correcto";
//header ("refresh:4;url=mostrar.php");
}
else{
echo "Error al ejecutar el comando:".$miconexion->error;
}
}

}


?>