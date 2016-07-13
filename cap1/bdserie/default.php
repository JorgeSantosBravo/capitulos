<?php
include "conexion.php";
if (!$_POST){

echo "
<form action='index.php' method=post>

Usuario<input type='text' name='usu'><br>
Contraseña<input type='password' name='password'><br>
<input type=submit value='Enviar'>
</form>

";
}else{

$miconsulta=$miconexion->query("SELECT * FROM usuario WHERE Usuario LIKE '".$_POST['usu']."' and pass LIKE '".$_POST['password']."'");
$resultado=$miconexion->query($miconsulta);
	 $filas=$miconexion->affected_rows;
     if($filas>=1){
		 echo "Bienvenido";
		 header ("Location:index.php");
	 }else{
		 
		 echo "Usuario no encontrado o contraseña incorrecta";
		 header ("refresh:2;url=default.php");
	 }


}


?>