<script src="jquery-3.0.0.min.js" type="text/javascript"></script>
<script src="jquery-ui-1.11.4.custom/jquery-ui.min.js" type="text/javascript"></script>
<?php
include "conexion.php";
$stocke=$miconexion->query("SELECT Nombre_persona FROM persona ORDER BY Nombre_persona"); 
$arreglo_php = array();
  while ($rows = $stocke->fetch_assoc()){
   array_push($arreglo_php, $rows["Nombre_persona"]);
  
}


?>
<script>
  $(function(){
    var autocompletar = new Array();
    <?php //Esto es un poco de php para obtener lo que necesitamos
     for($p = 0;$p < count($arreglo_php); $p++){ //usamos count para saber cuantos elementos hay ?>
       autocompletar.push('<?php echo $arreglo_php[$p]; ?>');
     <?php } ?>
     $("#buscar").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
       source: autocompletar //Le decimos que nuestra fuente es el arreglo
     });
  });
</script>
<?php

if (!$_POST){
echo "	<form action='titulo.php?id=".$_GET['id']."' method=post>
<input type='text' id='buscar' name='texto'/>
<input type=submit value='Enviar'>
</form>

";
}else{
	
	  }
	
?>