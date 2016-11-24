<?php
	
include("conexion.php");

$cont=$miconexion->query("SELECT *, count(persona.id_persona)as cantidad FROM titulocapitulo,titulosdirectores,persona WHERE titulocapitulo.id_capitulo=titulosdirectores.id_titulo and persona.id_persona=titulosdirectores.id_director GROUP BY persona.id_persona ORDER BY cantidad DESC");
echo "<table border=1 align=center>";
echo "<th><font face='Trebuchet MS'>persona</th>";
echo "<th><font face='Trebuchet MS'>Capítulos</th>";
while ($rows = $cont->fetch_assoc()) {
if (!$rows["Nombre_persona"]==""){
echo "<tr><td align=center><a href=persona.php?id=".$rows["id_persona"].">".$rows["Nombre_persona"]."</a></td>";
echo "<td align=center>".$rows["cantidad"]."</td></tr>";
}
}
echo "</table><br>";

?>