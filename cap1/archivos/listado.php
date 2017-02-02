<title>Listado de archivos</title>
<table>
<th>Nombre</th><th>Link</th>
<?php
$consulta=$miconexion->query("SELECT * FROM nube");
while ($rows = $consulta->fetch_assoc()){
$resultado=$miconexion->query("select * from titulopelicula where id_pelicula=".$rows["id_titulo"]);
	$filas=$miconexion->affected_rows;
     if($filas>=1){
		 $consulta2=$miconexion->query("select * from titulopelicula where id_pelicula=".$rows["id_titulo"]);
while ($rows2 = $consulta2->fetch_assoc()){
		echo "<tr><td>".$rows2["titulo"]."</td><td><a href='".$rows["link_archivo"]."' target='_blank'>Link</a></td></tr>"; 
	 }
	 }
	$resultado=$miconexion->query("select * from temporada where id_temporada=".$rows["id_titulo"]);
	 $filas=$miconexion->affected_rows;
     if($filas>=1){
		 $consulta2=$miconexion->query("select * from temporada,tituloserie WHERE temporada.serie=tituloserie.id_serie and id_temporada=".$rows["id_titulo"]);
while ($rows2 = $consulta2->fetch_assoc()){
		echo "<tr><td>".$rows2["titulo_serie"]." (".$rows2["numero_temporada"]."ª temporada)</td><td><a href='".$rows["link_archivo"]."' target='_blank'>Link</a></td></tr>"; 
	 }
	 }
	 
	 	$resultado=$miconexion->query("select * from titulocapitulo where id_capitulo=".$rows["id_titulo"]);
	 $filas=$miconexion->affected_rows;
     if($filas>=1){
		 $consulta2=$miconexion->query("select * from titulocapitulo,temporada,tituloserie WHERE titulocapitulo.ns=temporada.id_temporada AND  temporada.serie=tituloserie.id_serie and id_capitulo=".$rows["id_titulo"]);
while ($rows2 = $consulta2->fetch_assoc()){
		echo "<tr><td>".$rows2["titulo_serie"]." ".$rows2["numero_temporada"]."x".$rows2["e"]."</td><td><a href='".$rows["link_archivo"]."' target='_blank'>Link</a></td></tr>"; 
	 }
	 }
}
?>
</table>