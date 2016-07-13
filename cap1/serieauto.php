<script src="jquery-3.0.0.min.js" type="text/javascript"></script>
<script src="jquery-ui-1.11.4.custom/jquery-ui.min.js" type="text/javascript"></script>
<?php
include "conexion.php";
$stockes=$miconexion->query("SELECT Nombre FROM serie ORDER BY Nombre"); 
$arreglo_php2 = array();
  while ($rows2 = $stockes->fetch_assoc()){
   array_push($arreglo_php2, $rows2["Nombre"]);
  
}


?>
<script>
  $(function(){
    var autocompletar2 = new Array();
    <?php //Esto es un poco de php para obtener lo que necesitamos
     for($p = 0;$p < count($arreglo_php2); $p++){ //usamos count para saber cuantos elementos hay ?>
       autocompletar2.push('<?php echo $arreglo_php2[$p]; ?>');
     <?php } ?>
     $("#buscar2").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
       source: autocompletar2 //Le decimos que nuestra fuente es el arreglo
     });
  });
</script>
<input type='text' id='buscar2' name='serie'/>