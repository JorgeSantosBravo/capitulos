<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<title>Nueva lista</title>

 <link rel="stylesheet" href="css/estilos.css">
 
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
 
<script src="https://code.jquery.com/ui/1.8.10/jquery-ui.min.js"></script>	
 
 


<?php

	include "header/header.php";
	include "conexion.php";
if (!isset($_POST["uno"])&&!isset($_POST["guardar"])){
include "header/header.php";
echo "<form method='post' action=''>";
echo "<h3>¿Qué tipo de lista será?</h3>";
echo "<input type=radio name=tipo value=0>Personas";
echo "<input type=radio name=tipo value=1>Películas";
echo "<input type=radio name=tipo value=2>Series";
echo "<input type=radio name=tipo value=3>Temporadas";
echo "<input type=radio name=tipo value=4>Capítulos";
echo "<h3>Nombre de la lista</h3>";
echo "<input type=text name=nombre>";
echo "<h3>Añade una descripción</h3>";
echo "<input type=text name=desc><br><br>";
echo "<input name='uno' type='submit' value='Empezar' />
</form>";
}else{
session_start();

foreach($_POST as $campo => $valor) {
        $_SESSION["uno"][$campo] = $valor;
    }

		function maxid($nombreid, $tabla){
include "conexion.php";
$id=0;
$bid=$miconexion->query("SELECT MAX(".$nombreid.") as max FROM ".$tabla);
if ($rows = $bid->fetch_assoc()) {
$id=$rows["max"];
}
return $id+1;
}
 $idcap=maxid("id_lista", "lista");
	//TODO SACADO DE AQUÍ http://www.solvetic.com/tutoriales/article/1387-tabla-html-anadir-filas-controles-y-datos-dinamicos-con-jquery-php-y-mysql/
	
		if ($_SESSION["uno"]["tipo"]==0){
$primeraconsulta="SELECT * FROM lista,listaselementos,persona WHERE lista.id_lista=listaselementos.id_lista and listaselementos.id_elemento=persona.id_persona and lista.id_lista=".$idcap;
$primaria="id_persona";
$nombre="Nombre_persona";
$segundaconsulta="SELECT * FROM persona WHERE id_persona NOT IN (SELECT id_elemento FROM listaselementos) ORDER BY Nombre_persona ";
$consulta = $miconexion->query($primeraconsulta); 
}else if ($_SESSION["uno"]["tipo"]==1){
	$primeraconsulta="SELECT * FROM lista,listaselementos,titulopelicula WHERE lista.id_lista=listaselementos.id_lista and listaselementos.id_elemento=titulopelicula.id_pelicula and lista.id_lista=".$idcap;
$primaria="id_pelicula";
$nombre="titulo";
$segundaconsulta="SELECT * FROM titulopelicula WHERE id_pelicula NOT IN (SELECT id_elemento FROM listaselementos) ORDER BY año,titulo ";
$consulta = $miconexion->query($primeraconsulta); 
}
	
	
	echo "<h3>".$_SESSION["uno"]["nombre"]."</h3>";

if (!isset($_POST["guardar"])){

 
echo "<form action='lista.php' method=post>
 
		 <table border=1 cellpadding=0 cellspacing=0 class=tabla>
 
					 <tr class=ajaxTitle>
 
								 <th width='2%'>ID</th>
 
								 <th width='16%'>Nombre</th>
 
 
								 <th>Acciones</th>
 
					 </tr>";
 
		  //obtenemos y recorremoslas filas de la tabla
 
		 while($resultado = $consulta->fetch_assoc()) { ?>
 
		
 
					 <tr >
 
								 <td><?=$resultado[$primaria]?></td>
 
								 <td class="nombre"><?=$resultado[$nombre]?></td>
 
 
								 <td width="10%">
 
											 <div align="center"><a href="javascript:;" id="<?=$resultado[$primaria]?>" class="ajaxEdit"><img src="css/edit.png" width="32" height="32" class="eimage"></a>
 
								 	 <a href="javascript:;" id="<?=$resultado[$primaria]?>" class="ajaxDelete"><img src="css/stop.gif" width="32" height="32" class="dimage"></a> </div></td>
 
					 </tr>
 
					 <?php } ?>
 
</table>
<?php 



echo "<select class='serie'><option id=0>Selecciona</option>";
	$stocke=$miconexion->query($segundaconsulta);
while ($rows = $stocke->fetch_assoc()){

echo "<option id ='".$rows[$primaria]."'>".$rows[$nombre]."</option>";

}
echo "</select> <br><br>";
echo "<input type=hidden name=ssess value='".$_SESSION["uno"]["nombre"]."'>";
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
</script>
<br>
 <?php
 echo "</form>";
 }else{
	 	if (!$miconexion->query("INSERT INTO lista VALUES ('".$idcap."', '".$_POST["ssess"]."', '".$_SESSION["uno"]["tipo"]."', '".$_SESSION["uno"]["desc"]."')")){
echo $miconexion->error;
}
//leemos los datos enviados y los guardamos en matrices
$ids=$_POST['ids'];

//recorremos y vamos insertando los datos en la tabla mysql
for ($i = 0; $i < count($ids); $i++) {
	
	if ($miconexion->query("INSERT INTO `listaselementos` ( `id_lista`, `id_elemento` )
	 VALUES( '".$idcap."', '".$ids[$i]."')")){
echo "Correcto";
}else{
echo $miconexion->error;
}


}
header("Location:index.php");
 }

}
?>