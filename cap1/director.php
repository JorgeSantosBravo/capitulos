<script src="jquery-3.0.0.min.js" type="text/javascript"></script>
<script src="jquery-ui-1.11.4.custom/jquery-ui.min.js" type="text/javascript"></script>
<?php
include "conexion.php";
$stocke=$miconexion->query("SELECT Nomdir FROM director ORDER BY Nomdir"); 
$arreglo_php = array();
  while ($rows = $stocke->fetch_assoc()){
   array_push($arreglo_php, $rows["Nomdir"]);
  
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
<input type='text' id='buscar' name='director' />