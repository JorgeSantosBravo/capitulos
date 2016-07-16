	<link rel="stylesheet" type="text/css" media="screen" href="../Estilos/trebuchet.css">
<link rel="stylesheet" type="text/css" media="screen" href="../Estilos/serie.css">
<?php
session_start();
if (!$_POST){
	include "../conexion.php";

echo "
<form action='serie.php?id=".$_GET["id"]."' method=post>
<table>
<tr><td>
Nombre 
</td><td><input type='text' name='nombre' value='".$_SESSION["nombre"]."'></tr>
<tr><td>
Canal
</td>
<td>";



echo "<select name='c'>
";

$stocke=$miconexion->query("SELECT * FROM canal ORDER BY Nomcanal"); 
while ($rows = $stocke->fetch_assoc()){

echo "<option value ='".$rows['ID_canal']."' ";
if ($_SESSION["c"]==$rows["ID_canal"]){
	echo "selected=selected";
}
echo ">".$rows['Nomcanal']."</option>";

}
echo "</select> <input type=button name='nc' value='Añadir nuevo' onclick=window.location.href='../newcanal.php'>";


echo "</td></tr>";



echo "<tr><td>Inicio
</td><td><input type='text' name='ini' value='".$_SESSION["inicio"]."' size=1></tr>
<tr><td>Fin
</td><td><input type='text' name='fin' value='".$_SESSION["fin"]."' size=1></tr>
<tr><td>Estado
</td><td><select name='estado'>
";
switch ($_SESSION["estado"]){
default:
echo "<option value='hiato' selected='selected'>Hiato</option>
<option value='emisión'>Emisión</option>
<option value='finalizada'>Finalizada</option>"
;break;
case "hiato":
echo "<option value='hiato' selected='selected'>Hiato</option>
<option value='emisión'>Emisión</option>
<option value='finalizada'>Finalizada</option>"
;break;
case "emisión":
echo "<option value='hiato' >Hiato</option>
<option value='emisión' selected='selected'>Emisión</option>
<option value='finalizada'>Finalizada</option>"
;break;
case "finalizada":
echo "<option value='hiato' >Hiato</option>
<option value='emisión'>Emisión</option>
<option value='finalizada' selected='selected'>Finalizada</option>"
;break;
}

echo "</select></tr>
<tr><td>Creadores</td>";
$a = array();
$r2=$miconexion->query("SELECT * FROM serie,persona,creadoresserie WHERE serie.id_serie=creadoresserie.id_sserie and persona.id_persona=creadoresserie.id_ccreador and creadoresserie.id_sserie LIKE '$_GET[id]'");
while ($rows2 = $r2->fetch_assoc()) {

array_push($a, $rows2["Nombre_persona"]);
}
$final= implode(', ', $a);

echo "<td><input type='text' name='creadores' value='$final' </td></tr>

<tr><td>Poster</td><td><input name='poster' type=file></td></tr>
<tr><td>Intro</td><td><input name='intro' type=text value='".$_SESSION["intro"]."'></td></tr>
<tr><td>";

if ($_SESSION["seg"]==1){
echo "Dejar de seguir</td><td><input name='seg' type=checkbox value='0'>";
}else{
	echo "Seguir</td><td><input name='seg' type=checkbox value='1'>";
}
echo "</td></tr>
</table>
<input type=submit value='Enviar'><input type=button value='Volver atrás' onclick=window.location.href='../serie.php?id=".$_GET["id"]."'>
</form>


";
}else{
session_start();
include "../conexion.php";
//AQUÍ HAGO LO DEL Poster
if (!$_POST["poster"]==""){
$_SESSION["poster"]=$_POST["poster"];

}else{

}

if (!isset($_POST["seg"])){
	$_POST["seg"]=$_SESSION["seg"];
}


if (!$miconexion->query("UPDATE serie SET Nombre='".addslashes($_POST["nombre"])."', canal='".$_POST["c"]."', inicio='".$_POST["ini"]."', fin='".$_POST["fin"]."', estado='".$_POST["estado"]."', Poster='".$_SESSION["poster"]."', Intro='".$_POST["intro"]."', Seguimiento='".$_POST["seg"]."' WHERE id_serie LIKE '".$_GET["id"]."' ")){
	echo $miconexion->error;
}

//AQUÍ HAGO TODO LO DE CREADORES


	
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
		
		if (!$miconexion->query("INSERT INTO creadoresserie VALUES ('".$_GET['id']."', '".buscarid($dir[$j], "persona", "Nombre_persona", "id_persona")."')")){
			echo buscarid($dir[$j], "persona", "Nombre_persona", "id_persona");
			echo "uno";
			echo $miconexion->error;
		}
	}
	}else{
		
		if (!$miconexion->query("INSERT INTO creadoresserie VALUES ('".$_GET['id']."', '".buscarid($elemento, "persona", "Nombre_persona", "id_persona")."')")){
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
		 $miconexion->query("INSERT INTO persona (id_persona, Nombre_persona) VALUES ('".$id."', '".$campo."')");
	 }
	return $id;
}


if (!$miconexion->query("DELETE FROM creadoresserie WHERE id_sserie LIKE '".$_GET["id"]."'")){
	echo $miconexion->error;
}
directores($_POST["creadores"]);
header ("Location:../serie.php?id=".$_GET["id"]."");

}


?>