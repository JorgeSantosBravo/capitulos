

<select name="capitulos">	
<option value="0">Seleccione</option>
	<?php  
	include "../conexion.php";
	$consulta = $miconexion->query("select * from titulocapitulo where ns=".$_GET['id_temp']);
  while ($rows = $consulta->fetch_assoc()){
	  
	  echo '<option value="'.$rows['id_capitulo'].'">'.$rows['e'].' - '.$rows['titulo_capitulo'].'</option>';
	  
}?>
</select>