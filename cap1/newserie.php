<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<?php

include "conexion.php";


if (!$_POST){
	echo "<table >
<form action='newserie.php' method=post>
<tr><td>Nombre</td><td> <input type='text' name='nombre'>		</td></tr>

<tr ><td>Canal</td>

<td><select name='c'>
";

$stocke=$miconexion->query("SELECT * FROM canal ORDER BY Nomcanal"); 
while ($rows = $stocke->fetch_assoc()){

echo "<option value ='".$rows['ID_canal']."'>".$rows['Nomcanal']."</option>";

}
echo "</select> <input type=button name='nc' value='Añadir nuevo' onclick='dialogo()'></td></tr>


<tr><td>Inicio</td><td> <input type='text' name='ini'>		</td></tr>
<tr><td>Fin</td><td> <input type='text' name='fin'>		</td></tr>

<tr><td>Estado</td><td><select name='estado'>
<option value='hiato' selected='selected'>Hiato</option>
<option value='emisión'>Emisión</option>
<option value='finalizada'>Finalizada</option>
</select>
	</td></tr>		
<tr><td>Poster</td><td> <input type='file' name='poster'>		</td></tr>
<tr><td>Seguimiento</td><td> <input type='radio' name='seg' value=1>Sí<br><input type='radio' name='seg' value=0>No		</td></tr>
<tr><td>Intro</td><td> <input type='text' name='intro'>		</td></tr>
<tr><td>Creador(es)</td><td> ";		

include "director.php";

echo "</td></tr></table>
<input type=submit value='Enviar'>
</form>
";

?>
<script type="text/javascript">
function dialogo(){
	document.location.href='newcanal.php'; 
}

</script>
<?php
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
 $idcap=bid("id_serie", "serie");
 
function personaes ($elemento){
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
		
		if (!$miconexion->query("INSERT INTO creadoresserie VALUES ('".$GLOBALS['idcap']."', '".buscarid($dir[$j], "persona", "Nombre_persona", "ID_persona")."')")){
			echo $GLOBALS["idcap"];
			echo buscarid($dir[$j], "persona", "Nombre_persona", "ID_persona");
			echo "uno";
			echo $miconexion->error;
		}
	}
	}else{
		
		if (!$miconexion->query("INSERT INTO creadoresserie VALUES ('".$GLOBALS['idcap']."', '".buscarid($elemento, "persona", "Nombre_persona", "ID_persona")."')")){
			echo $GLOBALS["idcap"]."<br>";
			echo buscarid($elemento, "persona", "Nombre_persona", "ID_persona")."<br>";
			echo "otro";
			echo $miconexion->error;
		}
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
		 //echo $campo." - ".$id; 
		 
		
		 
	 }else{
		 
		 $id=bid("ID_persona", "persona");
		 $miconexion->query("INSERT INTO persona (ID_persona, Nombre_persona) VALUES ('".$id."', '".$campo."')");
	 }
	return $id;
}



if (!$miconexion->query("INSERT INTO serie VALUES ('".$GLOBALS['idcap']."', '".$_POST['nombre']."', '".$_POST['c']."', '".$_POST['ini']."', '".$_POST['fin']."', '".$_POST['estado']."', '".$_POST['poster']."', '".$_POST['intro']."', '".$_POST['seg']."')")){
	echo $miconexion->error;
}else{
	header ("Location:nuevocap.php");
//	header ("Location:serie.php?id=".$GLOBALS['idcap']."");

}
personaes ($_POST["persona"]);

}


?>