<title>Subir archivo</title>
<script>
function cambiar(op){

var opcion=document.getElementById(op);

if (opcion.value=="p"){
pelicula.style.visibility = 'visible';
seriee.style.visibility = 'hidden';
}else if (opcion.value=="t"){
	pelicula.style.visibility = 'hidden';
seriee.style.visibility = 'visible';
}else{
	pelicula.style.visibility = 'hidden';
seriee.style.visibility = 'visible';
}

}

</script>
<script type="text/javascript" language="javascript" src="js/ajax.js"></script>	
<?php

include "header/header.php";

if (!$_POST){
?>
<tr><td><input type='radio' id='ar' name='a' value='p' onchange='cambiar(this.id)'>Película</td></tr>
<tr><td><input type='radio' id='ar2' name='a' value='t' onchange='cambiar(this.id)'>Temporada</td></tr>
<tr><td><input type='radio' id='ar3' name='a' value='c' onchange='cambiar(this.id)'>Capítulo</td></tr>

<table>

<form name="form1" action="" method=post>

<tr><td></td><td>

<select id='pelicula' name='pelicula' style="visibility:hidden">
<?php
echo "<option selected=on>Elige una película</option>";
$consulta=$miconexion->query("SELECT * FROM titulopelicula WHERE id_pelicula NOT IN (SELECT id_titulo FROM nube) ORDER BY titulo"); 
while ($rows = $consulta->fetch_assoc()){
echo "<option value=".$rows["id_pelicula"].">".$rows["titulo"]." - ".$rows["año"]."</option>";
}
?>
</select>
<br>


		<div id="seriee" style="visibility:hidden">
			<select name="cliente" id="" onchange="from1(this.value,'midiv','[Combo]temporadas.php')">
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
	
	
	




</td></tr>
<tr><td>Link</td><td><input type='text' name='link'></td></tr>
<tr><td>Lugar</td><td><?php
echo "<select id='lugar' name='lugar'>";
echo "<option selected=on>Elige</option>";
$consulta=$miconexion->query("SELECT * FROM servidorescorreos,servidor,correo WHERE servidorescorreos.id_sservidor=servidor.id_servidor and servidorescorreos.id_ccorreo=correo.id_correo and lleno=0"); 
while ($rows = $consulta->fetch_assoc()){
echo "<option value=".$rows["id_sc"].">".$rows["nombre_servidor"]."  (".$rows["nombre_correo"].")</option>";
}

echo "</select>";

?></td></tr>
<?php
echo "<tr><td></td><td><input type=submit value='Enviar'></td></tr></form>";

}else{
	if ($_POST["pelicula"]!=0){
	if ($miconexion->query("INSERT INTO nube VALUES ('".$_POST["pelicula"]."', '".$_POST["link"]."', '".$_POST["lugar"]."')")){
//header("Location:index.php");
echo "aqui";
}else{
echo $miconexion->error;
}
	}else if ($_POST["cliente"]!=0){
		echo $_POST["cliente"]."<br>";
		echo $_POST["maquinas"]."<br>";
		echo $_POST["capitulos"];
		/*
		if ($miconexion->query("INSERT INTO nube VALUES ('".$_POST["capitulos"]."', '".$_POST["link"]."', '".$_POST["lugar"]."')")){
//header("Location:index.php");
echo "alli";
}else{
echo $miconexion->error;
}
*/
	}
}

?>