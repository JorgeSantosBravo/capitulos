<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>

<script type="text/javascript" language="javascript" src="js/ajax.js">

</script>	
</head>
<body>
<?php include ("conexion.php");   ?>
	<form name="form2" action="">


<select name="maquinas" id="" onchange="from2(this.value,'miotrodiv','[Combo]capitulos.php')">	

	<option value="0">Seleccione</option>
	<?php  
	
	$consulta = $miconexion->query("select * from temporada where serie=".$_GET['id_serie']);
	
  while ($rows = $consulta->fetch_assoc()){
	  
	  echo '<option value="'.$rows['id_temporada'].'">'.$rows['numero_temporada'].' ('.$rows["año_temporada"].')</option>';
	  
}?>
</select>


</form>
</body>
</html>