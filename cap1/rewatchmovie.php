<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<style type="text/css">
body{ background: #000 url('fondos/degradado.jpg') no-repeat top right fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;}
</style>
<?php

include "conexion.php";
include "header/header.php";
echo "<table>";
if (!$_POST){

echo "<form action='rewatchmovie.php' method=post>";
echo "
<tr><td>Película</td><td><select name='pelicula'>
<option selected=on>Elige una película</option>";
$consulta=$miconexion->query("SELECT * FROM peliculas ORDER BY titulo"); 
while ($rows = $consulta->fetch_assoc()){
echo "<option value=".$rows["id_pelicula"].">".$rows["titulo"]." - ".$rows["año"]."</option>";
}

echo "</select></td></tr>


<tr><td>Fecha</td><td>Hoy: <input type='checkbox' default=off name='hoy'>	Ayer: <input type='checkbox' default=off name='ayer'>
<br><input type='text' name='fecha' size=10>	</td></tr>
<tr><td>Visto en:</td><td> <input type='pc' size=2 name='pc'>	<input type='for' size=5 name='for'>	</td></tr>
<tr><td>Audio</td><td> <input type='text' name='audio'>		</td></tr>
<tr><td>Comentario</td><td><textarea name='com'></textarea></td></tr>
<tr><td>Puntuación</td>
<td><table>
<tr><th>Punt.</th><th>FA</th><th>IMDB</th><th>RT</th><th>AS</th><th>LB</th></tr>
<tr><td><input type='text' name='punt' size=1></td><td><input type=text name=fa size=1></td><td><input type=text name=imdb size=1></td><td><input type=text name=rt size=1></td><td><input type=text name=as size=1></td><td><input type=text name=lb size=1></td></tr>
</table></td></tr></table>
<input type=submit value='Enviar'>
</form>

";
}else{
	
function maxid($nombreid, $tabla){
include "conexion.php";
$id=0;
$bid=$miconexion->query("SELECT MAX(".$nombreid.") as max FROM ".$tabla);
if ($rows = $bid->fetch_assoc()) {
$id=$rows["max"];
}
return $id+1;
}	
	
if(isset($_POST['hoy'])){
$fecha= date("Y")."/".date("n")."/".date("j");
}else if(isset($_POST['ayer'])){
	$date = date("y-m-d");
$fecha = date( "Y-m-d", strtotime( "-1 day", strtotime( $date ) ) ); 
}else{
$f=explode('/', $_POST["fecha"]);
$fecha=$f[2].'/'.$f[1].'/'.$f[0];
}
	
if (!$miconexion->query("INSERT INTO fechaspeliculas VALUES ('".maxid("id_visionado", "fechaspeliculas")."', '".$fecha."', '".$_POST["pelicula"]."', '".$_POST['pc']."', '".$_POST['for']."', '".$_POST['audio']."', '".$_POST['com']."', '".$_POST['punt']."', '".$_POST['fa']."', '".$_POST['imdb']."', '".$_POST['rt']."', '".$_POST['as']."', '".$_POST['lb']."')")){
	echo $miconexion->error;
}
header ("Location:index.php");
}
?>