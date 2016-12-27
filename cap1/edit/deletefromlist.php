<?php
$service = $_POST['id'];
mysql_query("DELETE FROM listaselementos WHERE id=".$service);
?>