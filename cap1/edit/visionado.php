<script type="text/javascript">
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}


function eliminar() {

if(confirm("¿Estás seguro de que deseas eliminar el visionado?")) {
var id = getParameterByName('id');
location.href="deletevisionado.php?id="+id;

}


} 
</script>
<?php
include "../conexion.php";

if (!$_POST){
session_start();
echo "
<form action='visionado.php?id=".$_GET["id"]."' method=post>
<table>
<tr><td>";
$r2=$miconexion->query("SELECT * FROM fechastitulos WHERE id_visionado LIKE  '$_GET[id]'");
while ($rows = $r2->fetch_assoc()) {
$fe=explode("-", $rows["fecha"]);
echo "Fecha</td><td><input type='text' name='fecha' value='".$fe[2]."/".$fe[1]."/".$fe[0]."'></td></tr>
<tr><td>Medio</td><td><input type='text' name='medio' value='".$rows["medio"]."' size=1></td></tr>
<tr><td>Formato</td><td><input type='text' name='formato' value='".$rows["formato"]."'></td></tr>
<tr><td>Comentario</td><td><textarea name='comentario'>".$rows["comentario"]."</textarea></td></tr>
</table>
<input type=submit value='Enviar'><input type=button value='Volver atrás' onclick=window.location.href='../titulo.php?id=".$_SESSION["idcap"]."'>

</form>
<input type=button value='Borrar capítulo' onclick=eliminar()>
";
}

}else{
	session_start();
	$fe=explode("/", $_POST["fecha"]);
	$fecha=$fe[2]."/".$fe[1]."/".$fe[0];
	$miconexion->query("UPDATE fechastitulos SET fecha='".$fecha."',medio='".$_POST["medio"]."',formato='".$_POST["formato"]."',comentario='".$_POST["comentario"]."' WHERE id_visionado LIKE '".$_GET["id"]."'");
	header("Location:../titulo.php?id=".$_SESSION["idcap"]);
	session_destroy();
	}
?>