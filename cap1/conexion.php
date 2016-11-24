<?php
$hostname = 'localhost';
$database = 'cinepruebas';
//$database = 'cap pruebas';
$username = 'root';		//Definimos las constantes
$password = '12345';

$miconexion = new mysqli($hostname, $username,$password, $database);	
?>