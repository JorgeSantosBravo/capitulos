<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>

<style>
div{
width:300px; float:left;
padding:10px;
background:#f6f6f6;
}
</style>
<script type="text/javascript" language="javascript" src="js/ajax.js"></script>	

</head>
<body>

<?php include ("conexion.php");   ?>


	<form name="form1" action="">
		<div>
			Serie:
			<select name="cliente" id="" onchange="from1(document.form1.cliente.value,'midiv','[Combo]temporadas.php')">
				<option value="0">Seleccione</option>
				<?php   $consulta = $miconexion->query("SELECT * FROM tituloserie ORDER BY titulo_serie");
  while ($rows = $consulta->fetch_assoc()){
	  
	  echo '<option value="'.$rows['id_serie'].'">'.$rows['titulo_serie'].'</option>';
	  
}?>
							
			</select>	
		</div>
		
		<div id="midiv">
			
		</div>
		
		<div id="miotrodiv">
		
		
		</div>
	
	
	
	</form>
</body>
</html>