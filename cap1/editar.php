<?php

include "conexion.php";

if (!$_POST){

echo "
<form action='login.php' method=post>
Añadir director: <input type='text' name='dir'><br>
Añadir comentario: <input type='password' name='password'><br>
<input type=submit value='Enviar'>
</form>

";
}else{

}

?>