<?php
include "header/header.php";
/*
include "conexion.php";
*/
if ($_GET["t"]==0){
/*
$consulta=$miconexion->query("SELECT * FROM lista,listaselementos,persona WHERE lista.id_lista=listaselementos.id_lista and listaselementos.id_elemento=persona.id_persona and lista.id_lista=".$_GET["id"]); 
while ($rows = $consulta->fetch_assoc()){

echo "<a href=persona.php?id=".$rows["id_persona"].">".$rows["Nombre_persona"]."</a><br>";

}
*/
	
$tabla="persona";
$primaria="id_persona";
$nombrecampo="Nombre_persona";
$pagphp="persona.php";
}else if ($_GET["t"]==1){
	/*$consulta=$miconexion->query("SELECT * FROM lista,listaselementos,titulopelicula WHERE lista.id_lista=listaselementos.id_lista and listaselementos.id_elemento=titulopelicula.id_pelicula and lista.id_lista=".$_GET["id"]); 
while ($rows = $consulta->fetch_assoc()){

echo "<a href=titulo.php?id=".$rows["id_pelicula"].">".$rows["titulo"]."</a><br>";
}
*/
$tabla="titulopelicula";
$primaria="id_pelicula";
$nombrecampo="titulo";
$pagphp="titulo.php";
}
include "conexion.php";
$consulta=$miconexion->query("SELECT * FROM lista WHERE id_lista=".$_GET["id"]); 
while ($rows = $consulta->fetch_assoc()){
	echo "<title>".$rows["nombre_lista"]."</title>";
	echo "<h2>".$rows["nombre_lista"]."</h2>";
}

?>

<html>
 
<head>
 <link rel="stylesheet" href="Estilos/estilos.css">
 <link rel="stylesheet" href="Estilos/trebuchet.css">
 <link rel="stylesheet" href="Estilos/enlace.css">
 
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
 
<script src="https://code.jquery.com/ui/1.8.10/jquery-ui.min.js"></script>	
 
 
 
</head>
 
<body>
 
<?php
 //TODO SACADO DE AQUÍ http://www.solvetic.com/tutoriales/article/1387-tabla-html-anadir-filas-controles-y-datos-dinamicos-con-jquery-php-y-mysql/
 
$consulta = $miconexion->query("SELECT * FROM lista,listaselementos,".$tabla." WHERE lista.id_lista=listaselementos.id_lista AND ".$tabla.".".$primaria."=listaselementos.id_elemento AND lista.id_lista=".$_GET["id"]); 
if (!$_POST){
?>
 

 
<form action='' method="post">
 
		 <table border="1" cellpadding="0" cellspacing="0" class="tabla">
 
					 <tr class="ajaxTitle">
 
								 <th width="2%">ID</th>
 
								 <th width="16%">Nombre</th>
 
 
								 <th>Acciones</th>
 
					 </tr>
 
		 <?php //obtenemos y recorremoslas filas de la tabla
 
		 while($resultado = $consulta->fetch_assoc())

			 { ?>
 
		
 
					 <tr id="<?=$resultado[$primaria]?>">
 
								 <td><?=$resultado[$primaria]?></td>
 
								 <td class="nombre"><?="<a href=".$pagphp."?id=".$resultado[$primaria].">".$resultado[$nombrecampo]."</a>"?></td>
 
 
								 <td width="10%">
 
											 <div align="center"><a href="javascript:;" id="<?=$resultado[$primaria]?>" class="ajaxEdit"><img src="./Estilos/edit.png" width="32" height="32" class="eimage"></a>
 
								 	 <input type="image" class="borrar" src="Estilos/stop.gif" width="32" height="32" class="dimage"> </div></td>
 
					 </tr>
 
					 <?php } ?>
 
</table>
 <?php 



echo "<select class='serie'><option id=0>Selecciona</option>";
	$stocke=$miconexion->query("SELECT * FROM ".$tabla." WHERE ".$primaria." NOT IN (SELECT id_elemento FROM listaselementos) ORDER BY ".$nombrecampo);
while ($rows = $stocke->fetch_assoc()){

echo "<option id ='".$rows[$primaria]."'>".$rows[$nombrecampo]."</option>";

}
echo "</select> <br><br>";
echo "<input type='submit' name=guardar value='Guardar'>";
?>
<div></div>
 
<script>
$( "select.serie" )
  .change(function() {
	   var id = $(this).children(":selected").attr("id");
    var str = "";
    $( "select option:selected" ).each(function() {
      str += $( this ).text();
    });
	if (id==0){}else{
    $( ".tabla" ).append("<tr><td></td><td><input type=hidden name=ids[] value='"+id+"'><input type=text name=nombre[] value='"+str+"' readonly></td></tr>");}
  })
  .trigger( "change" );
  
  $(document).on('click', '.borrar', function (event) {
    event.preventDefault();
    $(this).closest('tr').remove();
		
});
  
  
</script>
<br>
 <?php
 }else{
	 
//leemos los datos enviados y los guardamos en matrices
$ids=$_POST['ids'];

//recorremos y vamos insertando los datos en la tabla mysql
for ($i = 0; $i < count($ids); $i++) {
	
	if ($miconexion->query("INSERT INTO `listaselementos` ( `id_lista`, `id_elemento` )
	 VALUES( '".$_GET["id"]."', '".$ids[$i]."')")){
echo "Correcto";
}else{
echo $miconexion->error;
}

 

}
header('Location: verlista.php?id='.$_GET["id"]."&t=".$_GET["t"]);
 }
 ?>
 
</form>