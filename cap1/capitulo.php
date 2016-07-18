<link rel="stylesheet" type="text/css" media="screen" href="Estilos/enlace.css">
<link rel='stylesheet' type='text/css' media='screen' href='Estilos/trebuchet.css'>
<?php
include("header/header.php");
include("conexion.php");
session_start();
$miconsulta="select * from capitulo where id_capitulo='".$_GET["id"]."'"; 
     $resultado=$miconexion->query($miconsulta);
	 $filas=$miconexion->affected_rows;
     if($filas>=1){
$resultado=$miconexion->query("SELECT * FROM capitulo,serie WHERE capitulo.serie=serie.id_serie and capitulo.id_capitulo LIKE '$_GET[id]'");

while ($rows = $resultado->fetch_assoc()) {
	if ($rows["fin"]!=0){
echo "<a href=serie.php?id=".$rows["id_serie"].">".$rows["Nombre"]." (".$rows["inicio"]."-".$rows["fin"].")</a><br>";
}else{
echo "<a href=serie.php?id=".$rows["id_serie"].">".$rows["Nombre"]." (".$rows["inicio"]."-)</a><br>";
}
echo'<title>'.$rows["Titulo"].'</title>';

$nombre=$rows["Nombre"];
echo "<h3>".$rows["Titulo"]."</h3><hr>";
echo "Temporada ".$rows["s"]." Episodio ".$rows["e"]."<br>"; 
$_SESSION["s"]=$rows["s"];
$_SESSION["e"]=$rows["e"];
$_SESSION["titulo"]=$rows["Titulo"];
$fe=explode("-", $rows["fecha"]);

echo "<strong>Visto el:</strong> ".$fe[2]."/".$fe[1]."/".$fe[0];
if (!$rows["medio"]==""){
echo " en ".$rows["medio"];}

if (!$rows["formato"]==""){
echo " por ".$rows["formato"];}
echo "<br>";
$r2=$miconexion->query("SELECT * FROM capitulo,serie,persona,capitulosdirectores WHERE capitulo.serie=serie.id_serie and capitulo.id_capitulo=capitulosdirectores.id_capitulo and capitulosdirectores.id_director=persona.id_persona and capitulo.id_capitulo LIKE  '$_GET[id]'");
$a = array();
while ($rows2 = $r2->fetch_assoc()) {


array_push($a, "<a href=persona.php?id=".$rows2["id_persona"].">".$rows2["Nombre_persona"]."</a>");
}
$final= implode(', ', $a);
if (!$final==""){
echo "<strong>Director</strong>: ".$final."<br>"; 
}
echo "<strong>Duración</strong>: ".$rows["Duracion"]."<br>";
$_SESSION["dur"]=$rows["Duracion"];
if (!$rows["Comentario"]==""){
echo "<strong>Comentario</strong>: ".$rows["Comentario"]."<br>";

}
$_SESSION["com"]=$rows["Comentario"];
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