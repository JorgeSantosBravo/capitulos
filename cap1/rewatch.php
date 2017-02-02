<!DOCTYPE HTML>
<html lang="en-US">
<head>
<?php include "header/header.php";


if (!$_POST){

 ?>
	<meta charset="UTF-8">
	<title></title>
<script type="text/javascript" language="javascript" src="js/ajax.js"></script>	

</head>
<body>
<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<form name="form1" action="" method="post">
<?php include ("conexion.php");

echo "
<table>


<tr><td>Fecha</td><td><input type='date' name='fecha'>	</td></tr>
<tr><td>Visto en:</td><td> <input type='pc' size=2 name='pc'>	<input type='for' size=5 name='for'>	</td></tr>
";
   ?>
<tr><td>

	
		<div>
			Serie:</td><td>
			<select name="cliente" id="" onchange="from1(document.form1.cliente.value,'midiv','[Combo]temporadas.php')">
				<option value="0">Seleccione</option>
				<?php   $consulta = $miconexion->query("SELECT * FROM tituloserie ORDER BY titulo_serie");
  while ($rows = $consulta->fetch_assoc()){
	  
	  echo '<option value="'.$rows['id_serie'].'">'.$rows['titulo_serie'].'</option>';
	  
}?>
							
			</select>	
		</div>
		</td></tr>
		<tr><td>
		Temporada:</td><td>
		<div id="midiv">
		
		</div>
		</td></tr><td>
		Capítulos:</td><td>
		<div id="miotrodiv">

		</div>
		</td></tr>
	</td></tr>

	
<?php
echo "<tr><td>Comentario</td><td><textarea name='com'></textarea></td></tr>

</table>
<input name=cap type=submit value='Enviar'>
</form>";
}else{
include "conexion.php";
		function maxid($nombreid, $tabla){
include "conexion.php";
$id=0;
$bid=$miconexion->query("SELECT MAX(".$nombreid.") as max FROM ".$tabla);
if ($rows = $bid->fetch_assoc()) {
$id=$rows["max"];
}
return $id+1;
}
	
	if (!$miconexion->query("INSERT INTO fechastitulos (id_visionado, id_titulo, fecha, medio, formato, comentario) VALUES ('".maxid("id_visionado", "fechastitulos")."', '".$_POST["capitulos"]."', '".$_POST["fecha"]."', '".$_POST['pc']."', '".$_POST['for']."', '".$_POST['com']."')")){
	echo $miconexion->error;
}else{
	header("Location:index.php");
}
}
?>
</body>
</html>