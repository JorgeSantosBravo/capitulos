<!DOCTYPE HTML>
<html>
<?php
include "conexion.php";
?>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Minutos por mes</title>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        title: {
            text: 'Minutos vistos cada mes',
            x: -20 //center
        },
        
        xAxis: {
            categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
                'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
        },
        yAxis: {
            title: {
                text: 'Minutos'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ' minutos'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: '2013',
            data: [ 0,0,
			<?php
			$stocke=$miconexion->query("SELECT SUM(Duracion) as con FROM capitulo,capitulosfecha WHERE capitulosfecha.id_capitulo=capitulo.id_capitulo and YEAR(fecha)=2013 GROUP BY MONTH(fecha)"); 
while ($rows = $stocke->fetch_assoc()){

			?>
			<?php
			echo $rows["con"];
			?>,
			<?php
}
			?>
			]
        }, {
            name: '2014',
            data: [2551, 933, 418, 100, 695, 2719, 2984, 0, 1145, 1918, 2450, 1565]
        }, {
            name: '2015',
            data: [
			<?php
			$stocke=$miconexion->query("SELECT SUM(Duracion) as con FROM capitulo,capitulosfecha WHERE capitulosfecha.id_capitulo=capitulo.id_capitulo and  YEAR(fecha)=2015 GROUP BY MONTH(fecha)"); 
while ($rows = $stocke->fetch_assoc()){

			?>
			<?php
			echo $rows["con"];
			?>,
			<?php
}
			?>
			]
        }, {
            name: '2016',
            data: [
			<?php
			$stocke=$miconexion->query("SELECT SUM(Duracion) as con FROM capitulo,capitulosfecha WHERE capitulosfecha.id_capitulo=capitulo.id_capitulo and YEAR(fecha)=2016 GROUP BY MONTH(fecha)"); 
while ($rows = $stocke->fetch_assoc()){

			?>
			<?php
			echo $rows["con"];
			?>,
			<?php
}
			?>
			]
        }]
    });
});
		</script>
	</head>
	<body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	</body>
</html>
	