<link rel="stylesheet" type="text/css" media="screen" href="Estilos/enlace.css">
<link rel='stylesheet' type='text/css' media='screen' href='Estilos/trebuchet.css'>
<?php
include("conexion.php");
session_start();
$_SESSION["idcap"]=$_GET["id"];
$miconsulta="select * from titulo where id_titulo='".$_GET["id"]."'"; 
     $resultado=$miconexion->query($miconsulta);
	 $filas=$miconexion->affected_rows;
     if($filas>=1){
$resultado=$miconexion->query("SELECT * FROM temporada,titulocapitulo,tituloserie WHERE temporada.id_temporada=titulocapitulo.ns AND titulocapitulo.serie=tituloserie.id_serie and titulocapitulo.id_capitulo LIKE '$_GET[id]'");

while ($rows = $resultado->fetch_assoc()) {
if ($rows["miniserie"]==1){
echo "<a href=titulo.php?id=".$rows["id_serie"].">".$rows["titulo_serie"]." (".$rows["inicio"].")</a><br>";	
}else{
if ($rows["fin"]!=0){
echo "<a href=titulo.php?id=".$rows["id_serie"].">".$rows["titulo_serie"]." (".$rows["inicio"]."-".$rows["fin"].")</a><br>";
}else{
echo "<a href=titulo.php?id=".$rows["id_serie"].">".$rows["titulo_serie"]." (".$rows["inicio"]."-)</a><br>";
}
}
echo'<title>'.$rows["titulo_capitulo"].'</title>';

$nombre=$rows["titulo_serie"];
echo "<h3>".$rows["titulo_capitulo"]."</h3><hr>";

$r2=$miconexion->query("SELECT * FROM titulocapitulo WHERE id_capitulo<'$_GET[id]' and serie=".$rows["serie"]." ORDER BY id_capitulo DESC LIMIT 1");
while ($rows2 = $r2->fetch_assoc()) {
	echo "<a href=titulo.php?id=".$rows2["id_capitulo"].">Anterior capítulo</a> | ";
}

echo "Temporada ".$rows["numero_temporada"]." Episodio ".$rows["e"];
$r2=$miconexion->query("SELECT * FROM titulocapitulo WHERE id_capitulo>'$_GET[id]' and serie=".$rows["serie"]." ORDER BY id_capitulo ASC LIMIT 1");
while ($rows2 = $r2->fetch_assoc()) {
	echo " | <a href=titulo.php?id=".$rows2["id_capitulo"].">Siguiente capítulo</a>";
}
 
$_SESSION["s"]=$rows["numero_temporada"];
$_SESSION["e"]=$rows["e"];
$_SESSION["titulo"]=$rows["titulo_capitulo"];

echo "<br><strong>Visto el:</strong> ";
$fecha=$miconexion->query("SELECT * FROM titulo,fechastitulos WHERE titulo.id_titulo=fechastitulos.id_titulo and titulo.id_titulo LIKE '$_GET[id]'");

while ($rows4 = $fecha->fetch_assoc()) {
$fe=explode("-", $rows4["fecha"]);
 echo "<a href=edit/visionado.php?id=".$rows4["id_visionado"].">".$fe[2]."/".$fe[1]."/".$fe[0];
if (!$rows4["medio"]==""){
echo " en ".$rows4["medio"];}

if (!$rows4["formato"]==""){
echo " por ".$rows4["formato"];
}
echo "<br>";
if (!$rows4["comentario"]==""){
echo "<strong>Comentario</strong>: ".$rows4["comentario"]."</a><br>";

}
$_SESSION["com"]=$rows4["comentario"];

}
echo "</a>";
$r2=$miconexion->query("SELECT * FROM titulocapitulo,persona,titulosdirectores WHERE titulocapitulo.id_capitulo=titulosdirectores.id_titulo and titulosdirectores.id_director=persona.id_persona and titulocapitulo.id_capitulo LIKE  '$_GET[id]'");
$a = array();
while ($rows2 = $r2->fetch_assoc()) {


array_push($a, "<a href=persona.php?id=".$rows2["id_persona"].">".$rows2["Nombre_persona"]."</a>");
}
$final= implode(', ', $a);
if (!$final==""){
echo "<strong>Director</strong>: ".$final."<br>"; 
}
echo "<strong>Duración</strong>: ".$rows["duracion"]."<br>";
$_SESSION["dur"]=$rows["duracion"];



}
echo "</table><br></font>";
?>
<style type="text/css">
  .boton{
        font-size:10px;
        font-weight:bold;
        color:white;
        background:#638cb5;
        border:0px;
        width:80px;
        height:19px;
		position: absolute;
	top: 130px; 
	right: 270px;
       }
</style>
<div id="boton">
<?php


echo "<input type='button' value='Editar' onclick=window.location.href='edit/capitulo.php?id=".$_GET["id"]."' class='boton'>";
?>
</div>
<?php
	 }else{
		 echo "<title>404 Not Found</title>";
		 ECHO "NOT FOUND";
	 }
?>