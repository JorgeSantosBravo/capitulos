<?php		
include "conexion.php";
	for ($ano=2013;$ano<=date('o');$ano++){
		$j=0;
		echo "AÑO: $ano<br>";
		
				for ($meses=1;$meses<=12;$meses++){
					
					if ($meses==1||$meses==3||$meses==5||$meses==7||$meses==8||$meses==10||$meses==12){
						echo "<br>MES: $meses<br>";
						for ($i=1;$i<=31;$i++){
							echo " Día: $i, ";
							$consulta=$miconexion->query("SELECT COUNT(*) as con FROM `capitulo` as con WHERE DAY(fecha)=$i and MONTH(fecha)=$meses and YEAR(fecha)=$ano"); 
								while ($rows = $consulta->fetch_assoc()){
									$j+=$rows["con"];
									echo $rows["con"]." || $j<br>";
																		}
												}
					}else if ($meses==4||$meses==6||$meses==9||$meses==11){
						echo "<br>MES: $meses<br>";
						for ($i=1;$i<=30;$i++){
							echo " Día: $i, ";
							$consulta=$miconexion->query("SELECT COUNT(*) as con FROM `capitulo` as con WHERE DAY(fecha)=$i and MONTH(fecha)=$meses and YEAR(fecha)=$ano"); 
								while ($rows = $consulta->fetch_assoc()){
									$j+=$rows["con"];
									echo $rows["con"]." || $j<br>";
																		}
					}
					
					
												}else {
													echo "<br>MES: $meses<br>";
													if (date('L', strtotime("$ano-1-1"))){	//ESTO SIRVE PARA SABER SI ES BISIESTO
														
						for ($i=1;$i<=29;$i++){
							echo " Día: $i, ";
							$consulta=$miconexion->query("SELECT COUNT(*) as con FROM `capitulo` as con WHERE DAY(fecha)=$i and MONTH(fecha)=$meses and YEAR(fecha)=$ano"); 
								while ($rows = $consulta->fetch_assoc()){
									$j+=$rows["con"];
									echo $rows["con"]." || $j<br>";
																		}
					}
												}else{
													for ($i=1;$i<=28;$i++){
														echo " Día: $i, ";
							$consulta=$miconexion->query("SELECT COUNT(*) as con FROM `capitulo` as con WHERE DAY(fecha)=$i and MONTH(fecha)=$meses and YEAR(fecha)=$ano"); 
								while ($rows = $consulta->fetch_assoc()){
									$j+=$rows["con"];
									echo $rows["con"]." || $j<br>";
																		}
					}
													
												}
				
								}
				}
	}

								
	

?>