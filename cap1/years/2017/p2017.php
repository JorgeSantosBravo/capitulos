<!DOCTYPE html>
<html>
<head>
	<title>
		2017
	</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<style type="text/css">
	th{
		text-align: center;
	}
	td{
		text-align: center;
	}
	
</style>
</head>
<body>

<div class="container">
	
<div class="table-responsive">

<table class="table table-striped table-bordered table-hover table-condensed">
<tr class="info">
<th>Nº</th>
<th>Fecha</th>
<th>Formato</th>
<th>Año</th>
<th></th>
<th>Título</th>
<th>Punt.</th>
</tr>
<?php
include "../../conexion.php";
$i=1;	//Contador


$fech=$miconexion->query("SELECT * FROM titulopelicula,titulo,fechastitulos WHERE titulo.id_titulo=fechastitulos.id_titulo and titulo.id_titulo=titulopelicula.id_pelicula and YEAR(fecha)=2017 ORDER BY fecha ASC");

while ($rows = $fech->fetch_assoc()) {
	$fecha = explode("-",$rows["fecha"]); 

$fechcompl=$fecha[2].'/'.$fecha[1].'/'.$fecha[0];
?>
<tr>
<td><?php echo $i  ?></td>
<td><a name=<?php $fechcompl ?>></a> <?php echo $fechcompl ?></td>
<td><?php echo $rows["formato"] ?></td>
<td><?php echo $rows["año"] ?></td>
<td><img  width=35 height=50 src=../../poster/<?php echo $rows["poster"] ?>></td>
<td><a href=titulo.php?id=<?php echo $rows["id_titulo"] ?> ><?php echo $rows["titulo"] ?></a></td>
<td><?php echo $rows["puntuacion"] ?> </td>

<?php
$i++;
}
?>
</table><a name=final></a><br>
<a href=visor.php?v=years/index.php>Volver a anuarios</a><br>

</div>
</div>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>