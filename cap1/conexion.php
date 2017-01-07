<?php
$hostname = 'localhost';
//$database = 'cinepruebas';
$database = 'cineyseries';
$username = 'root';		//Definimos las constantes
$password = '12345';

$miconexion = new mysqli($hostname, $username,$password, $database);	
?>