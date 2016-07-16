<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<style type="text/css">
body{ background: #000 url('fondos/degradado.jpg') no-repeat top right fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;}
</style>
<?php
include "conexion.php";

if (!$_POST){
echo "<table>
<form action='nuevocap.php' method=post>

<tr><td>Fecha</td><td>Hoy: <input type='checkbox' default=off name='hoy'>	Ayer: <input type='checkbox' default=off name='ayer'>
<br><input type='text' name='fecha' size=10>	</td></tr>
<tr><td>Visto en:</td><td> <input type='pc' size=2 name='pc'>	<input type='for' size=5 name='for'>	</td></tr>
<tr><td>Serie</td><td>";
include "serieauto.php";
echo "</td><td><input type=button name='ns' value='Añadir nueva' onclick='dialogo()'></td></tr>
<tr><td></td><td> S<input type='text' name='s' size=1> E<input type='text' name='e' size=1>		</td></tr>
<tr><td>Título</td><td> <input type='text' name='titulo'>		</td></tr>
<tr><td>Director</td><td>";
include "director.php";
echo "</td></tr>

<tr><td>Duración</td><td> <input type='text' name='dur' size=1>		</td></tr>

<tr><td>Comentario</td><td><textarea name='com'></textarea></td></tr>

</table>
<input type=submit value='Enviar'>
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
	function maxid($nombreid, $tabla){
include "conexion.php";
$id=0;
$bid=$miconexion->query("SELECT MAX(".$nombreid.") as max FROM ".$tabla);
if ($rows = $bid->fetch_assoc()) {
$id=$rows["max"];
}
return $id+1;
}
 $idcap=maxid("id_capitulo", "capitulo");
	
	
	if(isset($_POST['hoy'])){
$fecha= date("Y")."/".date("n")."/".date("j");
}else if(isset($_POST['ayer'])){
	$date = date("y-m-d");
$fecha = date( "Y-m-d", strtotime( "-1 day", strtotime( $date ) ) ); 
}else{
$f=explode('/', $_POST["fecha"]);
$fecha=$f[2].'/'.$f[1].'/'.$f[0];
}
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
		
		$miconexion->query("INSERT INTO capitulosdirectores (id_capitulo, id_director) VALUES ('".$GLOBALS['idcap']."', '".buscarid($dir[$j], "persona", "Nombre_persona", "id_persona")."')");
	}
	}else{
		
		$miconexion->query("INSERT INTO capitulosdirectores (id_capitulo, id_director) VALUES ('".$GLOBALS['idcap']."', '".buscarid($elemento, "persona", "Nombre_persona", "id_persona")."')");
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
		 $miconexion->query("INSERT INTO persona (ID_persona, Nombre_persona) VALUES ('".$id."', '".$campo."')");
	 }
	return $id;
}


//PARA LOS DIRECTORES
directores ($_POST["persona"]);
echo "<br>".$_POST["persona"]."<br>";

//PARA EL ID DE LA Serie
$ids=buscarid($_POST["serie"], "serie", "Nombre", "id_serie");

//FINALMENTE INSERTA
if (!$miconexion->query("INSERT INTO capitulo VALUES ('".$idcap."', '".$fecha."', '".$_POST['pc']."', '".$_POST['for']."', '".$ids."', '".$_POST['s']."', '".$_POST['e']."', '".addslashes($_POST['titulo'])."', '".$_POST['dur']."', '".$_POST['com']."')")){
	echo $miconexion->error;
}
header ("Location:index.php");
}
?>