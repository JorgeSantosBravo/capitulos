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
        series: [
		
	<?php  for ($i=2013;$i<=date('Y');$i++) { ?>
			{
			name: '<?php echo $i; ?>',
            data: [
			<?php
			for ($j=1;$j<=12;$j++){
			$stocke=$miconexion->query("SELECT SUM(duracion) as con FROM titulocapitulo,fechastitulos WHERE titulocapitulo.id_capitulo=fechastitulos.id_titulo and YEAR(fecha)=".$i." and MONTH(fecha)=".$j); 
while ($rows = $stocke->fetch_assoc()){

			?>
			<?php
			if (is_null($rows["con"])){
				echo 0;
			}else{
				echo $rows["con"];
			}
			?>,
			<?php
			}}
			?>
			]
        },
			<?php   } ?>
		
		]
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
	