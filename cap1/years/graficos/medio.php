<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
    $('#medio').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Medios'
        },
        tooltip: {
            //pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Capítulos',
            colorByPoint: true,
            data: [
	<?php
	$conti=$miconexion->query("SELECT medio,COUNT(medio) as cantidad FROM fechastitulos,titulocapitulo WHERE fechastitulos.id_titulo=titulocapitulo.id_capitulo and YEAR(fecha)=".$url[3]." GROUP BY medio ORDER BY cantidad DESC");
while ($rowsi = $conti->fetch_assoc()) {  ?>
	{name: '<?php  echo $rowsi["medio"];?>',
                y: <?php echo $rowsi["cantidad"];?>
	},
<?php } ?>
            ]
        }]
    });
});
		</script>
		
	</head>
	<body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<div id="medio" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>

	</body>
</html>
