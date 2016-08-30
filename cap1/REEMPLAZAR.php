<?php

include "conexion.php";
if (!$_POST){

echo "
<form action='REEMPLAZAR.php' method=post>

Introduce tabla<br><input type='text' name='tabla'><br>
Introduce ID de la tabla<br><input type='text' name='id'><br>
Introduce campo para reemplazar<br><input type='text' name='campo'><br>

<input type=submit value='Enviar'>
</form>

";

}else{

$stocke=$miconexion->query("SELECT * FROM ".$_POST["tabla"].""); 
while ($rows = $stocke->fetch_assoc()){
if (strpos($rows["".$_POST["campo"].""], "+")){
$nueva=str_replace("+", "'", $rows["".$_POST["campo"].""]);
if (!$miconexion->query ("UPDATE ".$_POST["tabla"]." SET ".$_POST["campo"]." ='".addslashes($nueva)."' WHERE ".$_POST["id"]." LIKE '".$rows["".$_POST["id"].""]."'")){
	echo $miconexion->error;
}
}
}
}

?>