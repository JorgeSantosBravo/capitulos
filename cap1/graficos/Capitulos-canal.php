<!DOCTYPE HTML>
<?php include "../conexion.php"; ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Capítulos por canal</title>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Capítulos por canal'
        },
        
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: '<b>{point.y} capítulos</b>'
        },
        series: [{
            name: 'Series',
            data: [
			<?php $cont=$miconexion->query("SELECT *,COUNT(id_capitulo) as cantidad FROM capitulo,serie,canal WHERE capitulo.serie=serie.id_serie and serie.Canal=canal.ID_canal GROUP BY canal ORDER BY cantidad DESC");
while ($rows = $cont->fetch_assoc()) {  ?>
                ['<?php  echo $rows["Nomcanal"]; ?>', <?php echo $rows["cantidad"];?>],
<?php  } ?>    
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
               // format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
		</script>
	</head>
	<body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<div id="container" style="min-width: 300px; height: 675px; margin: 0 auto"></div>

	</body>
</html>
<font face="Verdana"><a href='../index.php' >Volver a inicio</a></font>