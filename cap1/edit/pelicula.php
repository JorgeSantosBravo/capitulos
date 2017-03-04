<script type="text/javascript">
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}


function eliminar() {

if(confirm("¿Estás seguro de que deseas eliminar la película?")) {
var id = getParameterByName('id');
location.href="deletepelicula.php?id="+id;

}


} 
</script>
<?php
include "../conexion.php";
if (!$_POST){

echo "
<form action='pelicula.php?id=".$_GET["id"]."' method=post>
<table>";
$consulta=$miconexion->query("SELECT * FROM titulopelicula,titulo WHERE titulo.id_titulo=titulopelicula.id_pelicula and titulopelicula.id_pelicula=".$_GET["id"]); 
while ($rows = $consulta->fetch_assoc()){
echo "<tr><td>Año</td><td><input type='text' name='anio' value='".$rows["año"]."'></td></tr>";	
echo "<tr><td>Título</td><td><input type='text' name='titulo' value=\"".$rows["titulo"]."\"></td></tr>";	
echo "<tr><td>Título orig.</td><td><input type='text' name='titorig' value=\"".$rows["titulo_original"]."\"></td></tr>";	
echo "<tr><td>Duración</td><td><input type='text' name='duracion' value='".$rows["duracion"]."'></td></tr>";	
echo "<tr><td>País</td><td><input type='text' name='pais' value='".$rows["pais"]."'></td></tr>";	
echo "<tr><td>Póster</td><td><input type='file' name='poster'></td></tr>";	
session_start();
$_SESSION["poster"]=$rows["poster"];
echo "<tr><td>Documental</td><td>";

if ($rows["documental"]==1){
	echo "<input type='checkbox' name='documental' value='1' checked=on></td></tr>";
}else{
	echo "<input type='checkbox' name='documental' value='1'></td></tr>";
}
}

$a = array();
$r2=$miconexion->query("SELECT * FROM titulopelicula,titulosdirectores,persona WHERE titulopelicula.id_pelicula=titulosdirectores.id_titulo and titulosdirectores.id_director=persona.id_persona and titulopelicula.id_pelicula LIKE  '$_GET[id]'");
while ($rows2 = $r2->fetch_assoc()) {

array_push($a, $rows2["Nombre_persona"]);
}
$final= implode(', ', $a);
echo "<tr><td>Director</td><td><input type='text' name=dire value=\"".$final."\"</td></tr>";

$a = array();
$r2=$miconexion->query("SELECT * FROM titulopelicula,peliculasguionistas,persona WHERE titulopelicula.id_pelicula=peliculasguionistas.id_pelicula and peliculasguionistas.id_guionista=persona.id_persona and titulopelicula.id_pelicula LIKE  '$_GET[id]'");
while ($rows2 = $r2->fetch_assoc()) {

array_push($a, $rows2["Nombre_persona"]);
}
$final= implode(', ', $a);
echo "<tr><td>Guión</td><td><input type='text' name=guion value=\"".$final."\"</td></tr>";

$a = array();
$r2=$miconexion->query("SELECT * FROM titulopelicula,peliculasmusicos,persona WHERE titulopelicula.id_pelicula=peliculasmusicos.id_pelicula and peliculasmusicos.id_musico=persona.id_persona and titulopelicula.id_pelicula LIKE  '$_GET[id]'");
while ($rows2 = $r2->fetch_assoc()) {

array_push($a, $rows2["Nombre_persona"]);
}
$final= implode(', ', $a);
echo "<tr><td>Música</td><td><input type='text' name=musica value=\"".$final."\"</td></tr>";

$a = array();
$r2=$miconexion->query("SELECT * FROM titulopelicula,peliculasfotografos,persona WHERE titulopelicula.id_pelicula=peliculasfotografos.id_pelicula and peliculasfotografos.id_foto=persona.id_persona and titulopelicula.id_pelicula LIKE  '$_GET[id]'");
while ($rows2 = $r2->fetch_assoc()) {

array_push($a, $rows2["Nombre_persona"]);
}
$final= implode(', ', $a);
echo "<tr><td>Fotografía</td><td><input type='text' name=foto value=\"".$final."\"</td></tr>";

$a = array();
$r2=$miconexion->query("SELECT * FROM titulopelicula,peliculasactores,persona WHERE titulopelicula.id_pelicula=peliculasactores.id_pelicula and peliculasactores.id_actor=persona.id_persona and titulopelicula.id_pelicula LIKE  '$_GET[id]'");
while ($rows2 = $r2->fetch_assoc()) {

array_push($a, $rows2["Nombre_persona"]);
}
$final= implode(', ', $a);
echo "<tr><td>Reparto</td><td><input type='text' name=rep value=\"".$final."\" /></td></tr>";

$a = array();
$r2=$miconexion->query("SELECT * FROM titulopelicula,peliculasproductoras,productora WHERE titulopelicula.id_pelicula=peliculasproductoras.id_pelicula and peliculasproductoras.id_productora=productora.id_productora and titulopelicula.id_pelicula LIKE  '$_GET[id]'");
while ($rows2 = $r2->fetch_assoc()) {

array_push($a, $rows2["nombre_productora"]);
}
$final= implode(' / ', $a);
echo "<tr><td>Productoras</td><td><input type='text' name=prod value=\"".$final."\"</td></tr>";

$a = array();
$r2=$miconexion->query("SELECT * FROM titulopelicula,peliculasgeneros,genero WHERE titulopelicula.id_pelicula=peliculasgeneros.id_pelicula and peliculasgeneros.id_genero=genero.id_genero and titulopelicula.id_pelicula LIKE  '$_GET[id]'");
while ($rows2 = $r2->fetch_assoc()) {

array_push($a, $rows2["nombre_genero"]);
}
$final= implode('. ', $a);
echo "<tr><td>Género</td><td><input type='text' name=gen value=\"".$final."\"</td></tr>";

$a = array();
$r2=$miconexion->query("SELECT * FROM titulopelicula,peliculastemas,tema WHERE titulopelicula.id_pelicula=peliculastemas.id_pelicula and peliculastemas.id_tema=tema.id_tema and titulopelicula.id_pelicula LIKE  '$_GET[id]'");
while ($rows2 = $r2->fetch_assoc()) {

array_push($a, $rows2["nombre_tema"]);
}
$final= implode('. ', $a);
echo "<tr><td>Tema</td><td><input type='text' name=tema value=\"".$final."\"</td></tr>";
$consulta=$miconexion->query("SELECT * FROM titulopelicula,titulo WHERE titulo.id_titulo=titulopelicula.id_pelicula and titulopelicula.id_pelicula=".$_GET["id"]); 
while ($rows = $consulta->fetch_assoc()){
echo "<table>
<tr><th>Punt.</th><th>FA</th><th>IMDB</th><th>RT</th><th>AS</th><th>LB</th></tr>
<tr><td><input type='text' name='punt' size=1 value='".$rows["puntuacion"]."'></td><td><input type=text name=fa size=1 value='".$rows["filmaffinity"]."'></td><td><input type=text name=imdb size=1 value='".$rows["imdb"]."'></td><td><input type=text name=rt size=1 value='".$rows["tomatometer"]."'></td><td><input type=text name=as size=1 value='".$rows["audiencescore"]."'></td><td><input type=text name=lb size=1 value='".$rows["letterboxd"]."'></td></tr>

</table>";
}
echo "</table>
<input type=submit value='Enviar'><input type=button value='Volver atrás' onclick=window.location.href='../pelicula.php?id=".$_GET["id"]."'>

</form>
<input type=button value='Borrar película' onclick=eliminar()>
";
//PARA EDITAR LA FECHA PODRÍA HACER UN CALENDARIO 
}else{
	include "../conexion.php";

$miconexion->query("DELETE FROM titulosdirectores WHERE id_titulo LIKE '".$_GET["id"]."'");
$miconexion->query("DELETE FROM peliculasguionistas WHERE id_pelicula LIKE '".$_GET["id"]."'");
$miconexion->query("DELETE FROM peliculasmusicos WHERE id_pelicula LIKE '".$_GET["id"]."'");
$miconexion->query("DELETE FROM peliculasfotografos WHERE id_pelicula LIKE '".$_GET["id"]."'");
$miconexion->query("DELETE FROM peliculasactores WHERE id_pelicula LIKE '".$_GET["id"]."'");
$miconexion->query("DELETE FROM peliculasproductoras WHERE id_pelicula LIKE '".$_GET["id"]."'");
$miconexion->query("DELETE FROM peliculasgeneros WHERE id_pelicula LIKE '".$_GET["id"]."'");
$miconexion->query("DELETE FROM peliculastemas WHERE id_pelicula LIKE '".$_GET["id"]."'");
	function maxid($nombreid, $tabla){
include "../conexion.php";
$id=0;
$bid=$miconexion->query("SELECT MAX(".$nombreid.") as max FROM ".$tabla);
if ($rows = $bid->fetch_assoc()) {
$id=$rows["max"];
}
return $id+1;
}
	
function directores ($elemento, $tabla){
	include "../conexion.php";
	
	if (strpos($elemento, ",")){
	$con=0;
	for ($i=0;$i<strlen($elemento);$i++){
		if ($elemento[$i]==","){
			$con++;
		}
	}
	$dir=explode(', ', $elemento);
	for ($j=0;$j<=$con;$j++){
		/*
		if (strpos($dir[$j],"'")){
			$dir[$j]=addslashes($dir[$j]);
		echo $dir[$j]." - ".buscarid($dir[$j], "persona", "Nombre_persona", "id_persona");
	}
	*/
		 $dir[$j]=addslashes($dir[$j]);
		echo $dir[$j]." - ".buscarid($dir[$j], "persona", "Nombre_persona", "id_persona")."<br>";
		$miconexion->query("INSERT INTO ".$tabla." VALUES ('".$_GET['id']."', '".buscarid($dir[$j], "persona", "Nombre_persona", "id_persona")."')");
	}
	}else{
		
		$miconexion->query("INSERT INTO ".$tabla." VALUES ('".$_GET['id']."', '".buscarid($elemento, "persona", "Nombre_persona", "id_persona")."')");
	}
	 
}

function buscarid($campo, $tabla, $nombrecampo, $nombreid){
	include "../conexion.php";
$miconsulta="SELECT * FROM ".$tabla." WHERE ".$nombrecampo." LIKE '".$campo."'";
	$resultado=$miconexion->query($miconsulta);
	 $filas=$miconexion->affected_rows;
	 $id=0;
	 
	 if($filas>=1){
		 while ($rows = $resultado->fetch_assoc()){

		 $id=$rows[$nombreid];
		 }
		 echo $campo." - ".$id; 
		 
		
		 
	 }else{
		 
		 $id=maxid($nombreid, $tabla);
		 
		 $miconexion->query("INSERT INTO ".$tabla." (".$nombreid.", ".$nombrecampo.") VALUES ('".$id."', '".$campo."')");
	 }
	return $id;
}


//PARA LOS DIRECTORES
//$_POST["dire"]=addslashes($_POST["dire"]);
directores ($_POST["dire"], "titulosdirectores");
echo "<br>".$_POST["dire"]."<br>";

//PARA LOS ACTORES
//$_POST["rep"]=addslashes($_POST["rep"]);
directores($_POST["rep"], "peliculasactores");

//PARA LOS GUIONISTAS
//$_POST["guion"]=addslashes($_POST["guion"]);
directores($_POST["guion"], "peliculasguionistas");

//PARA LA BSO
//$_POST["musica"]=addslashes($_POST["musica"]);
directores($_POST["musica"], "peliculasmusicos");

//PARA LA FOTOGRAFÍA
//$_POST["foto"]=addslashes($_POST["foto"]);
directores($_POST["foto"], "peliculasfotografos");

//PARA EL POSTER
session_start();
if (!$_POST["poster"]==""){
$_SESSION["poster"]=$_POST["poster"];

}else{

}
/*
if (!$miconexion->query("UPDATE titulo SET poster='".$_SESSION["poster"]."' WHERE id_titulo LIKE '".$_GET["id"]."'")){
	echo $miconexion->error;
}
*/
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
	$lb=$_POST["lb"];
	$i++;
	$j++;
}
$media=($pu+$fa+$imdb+$rt+$as+$lb)/$i;
if ($j>1){
	   $j-=1;
   }
 $mediaprof=($fa+$imdb+$rt+$lb)/$j;
if (!$miconexion->query("UPDATE titulopelicula SET año='".$_POST["anio"]."', titulo='".addslashes($_POST["titulo"])."', titulo_original='".addslashes($_POST["titorig"])."', duracion='".$_POST["duracion"]."', documental='".$_POST["documental"]."', pais='".$_POST["pais"]."', puntuacion='".$_POST['punt']."', filmaffinity='".$_POST['fa']."', imdb='".$_POST['imdb']."', tomatometer='".$_POST['rt']."', audiencescore='".$_POST['as']."', letterboxd='".$_POST['lb']."', media='".$media."', mediaprof='".$mediaprof."' WHERE id_pelicula=".$_GET["id"])){
	echo $miconexion->error;
}

//PARA LAS PRODUCTORAS
$elemento=$_POST["prod"];
if (strpos($elemento, "/")){
	$con=0;
	for ($i=0;$i<strlen($elemento);$i++){
		if ($elemento[$i]=="/"){
			$con++;
		}
	}
	$dir=explode(' / ', $elemento);
	for ($j=0;$j<=$con;$j++){
		
		$dir[$j];
		
		$miconexion->query("INSERT INTO peliculasproductoras VALUES ('".$_GET['id']."', '".buscarid($dir[$j], "productora", "nombre_productora", "id_productora")."')");
	}
	}else{
		
		$miconexion->query("INSERT INTO peliculasproductoras VALUES ('".$_GET['id']."', '".buscarid($elemento, "productora", "nombre_productora", "id_productora")."')");
	}

//PARA LOS GÉNEROS
$elemento=$_POST["gen"];
if (strpos($elemento, ".")){
	$con=0;
	for ($i=0;$i<strlen($elemento);$i++){
		if ($elemento[$i]=="."){
			$con++;
		}
	}
	$dir=explode('. ', $elemento);
	for ($j=0;$j<=$con;$j++){
		
		$dir[$j];
		
		$miconexion->query("INSERT INTO peliculasgeneros VALUES ('".$_GET['id']."', '".buscarid($dir[$j], "genero", "nombre_genero", "id_genero")."')");
	}
	}else{
		
		$miconexion->query("INSERT INTO peliculasgeneros VALUES ('".$_GET['id']."', '".buscarid($elemento, "genero", "nombre_genero", "id_genero")."')");
	}	
	
//PARA LOS TEMAS
$elemento=$_POST["tema"];
if (strpos($elemento, ".")){
	$con=0;
	for ($i=0;$i<strlen($elemento);$i++){
		if ($elemento[$i]=="."){
			$con++;
		}
	}
	$dir=explode('. ', $elemento);
	for ($j=0;$j<=$con;$j++){
		
		$dir[$j];
		
		$miconexion->query("INSERT INTO peliculastemas VALUES ('".$_GET['id']."', '".buscarid($dir[$j], "tema", "nombre_tema", "id_tema")."')");
	}
	}else{
		
		$miconexion->query("INSERT INTO peliculastemas VALUES ('".$_GET['id']."', '".buscarid($elemento, "tema", "nombre_tema", "id_tema")."')");
	}
//PARA PONER EN NULL LOS 0
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

if (!$miconexion->query("DELETE FROM peliculasactores WHERE id_actor=127")){
	echo $miconexion->error;
}
if (!$miconexion->query("DELETE FROM peliculastemas WHERE id_tema=8")){
	echo $miconexion->error;
}
	unset ($_SESSION["poster"]);
	header("Location:../titulo.php?id=".$_GET["id"]);
}