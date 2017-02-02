
<?php include ("conexion.php");   ?>
	
<select name="maquinas" id="">	

	<option value="0">Seleccione</option>
	<?php  
	
	$consulta = $miconexion->query("select * from temporada where serie=".$_GET['id_serie']);
	
  while ($rows = $consulta->fetch_assoc()){
	  
	  echo '<option value="'.$rows['id_temporada'].'">'.$rows['numero_temporada'].' ('.$rows["año_temporada"].')</option>';
	  
}?>
</select>
