<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<style type="text/css">
body{ background: #000 url('fondos/degradado.jpg') no-repeat top right fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;}
</style>
<title>Re-ver película</title>
<?php

include "conexion.php";
include "header/header.php";
echo "<table>";
if (!$_POST){

echo "<form action='rewatchmovie.php' method=post>";
echo "
<tr><td>Película</td><td><select name='pelicula'>
<option selected=on>Elige una película</option>";
$consulta=$miconexion->query("SELECT * FROM titulopelicula ORDER BY titulo"); 
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
$id=maxid("id_visionado", "fechastitulos");
if(isset($_POST['hoy'])){
$fecha= date("Y")."/".date("n")."/".date("j");
}else if(isset($_POST['ayer'])){
	$date = date("y-m-d");
$fecha = date( "Y-m-d", strtotime( "-1 day", strtotime( $date ) ) ); 
}else{
$f=explode('/', $_POST["fecha"]);
$fecha=$f[2].'/'.$f[1].'/'.$f[0];
}

if (!$miconexion->query("INSERT INTO fechastitulos VALUES ('".$id."', '".$fecha."', '".$_POST["pelicula"]."', '".$_POST['pc']."', '".$_POST['for']."', '".$_POST['audio']."', '".$_POST['com']."', '".$_POST['punt']."', '".$_POST['fa']."', '".$_POST['imdb']."', '".$_POST['rt']."', '".$_POST['as']."', '".($_POST['lb']*2)."')")){
	echo $miconexion->error;
}


//HACE LA MEDIA
$i=1;
$j=1;
$pu=0;	//CONTADOR PARA HACER LA MEDIA
$fa=0;
$imdb=0;
$rt=0;
$as=0;
$lb=0;
$pu=$_POST["punt"];
	if (!$_POST["fa"]==0){
	$fa=$_POST["fa"];
	$i++;
	$j++;
}
if (!$_POST["imdb"]==0){
	$imdb=$_POST["imdb"];
	$i++;
	$j++;
}

if (!$_POST["rt"]==0){
	$rt=$_POST["rt"];
	$i++;
	$j++;
}
if (!$_POST["as"]==0){
		$as=$_POST["as"];
		$i++;
}
if (!$_POST["lb"]==0){
	$lb=($_POST["lb"]*2);
	$i++;
	$j++;
}
$media=($pu+$fa+$imdb+$rt+$as+$lb)/$i;
if ($j>1){
	   $j-=1;
   }
 $mediaprof=($fa+$imdb+$rt+$lb)/$j;

if (!$miconexion->query("UPDATE titulopelicula SET puntuacion='".$_POST['punt']."', filmaffinity='".$_POST['fa']."', imdb='".$_POST['imdb']."', tomatometer='".$_POST['rt']."', audiencescore='".$_POST['as']."', letterboxd='".($_POST['lb']*2)."', media='".$media."', mediaprof='".$mediaprof."' WHERE id_pelicula=".$_POST["pelicula"])){
	echo $miconexion->error;
}
if (!$miconexion->query("UPDATE titulopelicula SET filmaffinity=NULL WHERE filmaffinity=0")){
	echo $miconexion->error;
}
if (!$miconexion->query("UPDATE titulopelicula SET imdb=NULL WHERE imdb=0")){
	echo $miconexion->error;
}
if (!$miconexion->query("UPDATE titulopelicula SET tomatometer=NULL WHERE tomatometer=0")){
	echo $miconexion->error;
}
if (!$miconexion->query("UPDATE titulopelicula SET audiencescore=NULL WHERE audiencescore=0")){
	echo $miconexion->error;
}
if (!$miconexion->query("UPDATE titulopelicula SET letterboxd=NULL WHERE letterboxd=0")){
	echo $miconexion->error;
}
if (!$miconexion->query("UPDATE titulopelicula SET media=NULL WHERE media=0")){
	echo $miconexion->error;
}
if (!$miconexion->query("UPDATE titulopelicula SET mediaprof=NULL WHERE mediaprof=0")){
	echo $miconexion->error;
}
if (!$miconexion->query("UPDATE fechastitulos SET filmaffinity=NULL WHERE filmaffinity=0")){
	echo $miconexion->error;
}
if (!$miconexion->query("UPDATE fechastitulos SET imdb=NULL WHERE imdb=0")){
	echo $miconexion->error;
}
if (!$miconexion->query("UPDATE fechastitulos SET tomatometer=NULL WHERE tomatometer=0")){
	echo $miconexion->error;
}
if (!$miconexion->query("UPDATE fechastitulos SET audiencescore=NULL WHERE audiencescore=0")){
	echo $miconexion->error;
}
if (!$miconexion->query("UPDATE fechastitulos SET letterboxd=NULL WHERE letterboxd=0")){
	echo $miconexion->error;
}
header ("Location:index.php");
}
?>