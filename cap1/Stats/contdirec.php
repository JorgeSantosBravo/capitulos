<link rel="stylesheet" type="text/css" media="screen" href="Estilos/trebuchet.css">
<?php
	
include("conexion.php");

$cont=$miconexion->query("SELECT *, count(persona.id_persona)as cantidad FROM capitulo,capitulosdirectores,persona WHERE capitulo.id_capitulo=capitulosdirectores.id_capitulo and persona.id_persona=capitulosdirectores.id_director GROUP BY persona.id_persona ORDER BY cantidad DESC");
echo "<table border=1 align=center>";
echo "<th><font face='Trebuchet MS'>persona</th>";
echo "<th><font face='Trebuchet MS'>Capítulos</th>";
while ($rows = $cont->fetch_assoc()) {
if (!$rows["Nombre_persona"]==""){
echo "<tr><td align=center>".$rows["Nombre_persona"]."</td>";
echo "<td align=center>".$rows["cantidad"]."</td></tr>";
}
}
echo "</table><br>";

?>