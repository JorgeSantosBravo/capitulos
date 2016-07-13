<?php

include "../conexion.php";

//SELECT *,COUNT(*) as con FROM capitulo,serie,canal WHERE capitulo.serie=serie.id_serie and serie.canal=canal.ID_canal and YEAR(capitulo.fecha)=2016 GROUP BY MONTH(capitulo.fecha), serie.canal

$stocke=$miconexion->query("SELECT canal.Nomcanal,canal.ID_canal FROM serie,canal,capitulo WHERE capitulo.serie=serie.id_serie and serie.canal=canal.ID_canal and YEAR(capitulo.fecha)=2016 GROUP BY canal.ID_canal"); 

echo "<table border=1>";
echo "<tr><td></td><td>Enero</td><td>Febrero</td><td>Marzo</td><td>Abril</td><td>Mayo</td><td>Junio</td><td>Julio</td><td>Agosto</td><td>Septiembre</td><td>Octubre</td><td>Noviembre</td><td>Diciembre</td></tr>";

$i=1;
while ($rows = $stocke->fetch_assoc()){
echo "<tr><td>".$rows["ID_canal"]." - ".$rows["Nomcanal"]."</td>";

$s=$miconexion->query("SELECT *,COUNT(*) as con FROM capitulo,serie,canal WHERE capitulo.serie=serie.id_serie and serie.canal=canal.ID_canal and YEAR(capitulo.fecha)=2016 and serie.canal='".$rows["ID_canal"]."' and MONTH(capitulo.fecha)=".$i.""); 

if ($rows2 = $s->fetch_assoc()){

echo "<td>".$rows2["con"]." y ".$i."</td>";


}

$i++;
echo "</tr>";
}

?>