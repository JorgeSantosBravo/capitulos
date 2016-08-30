<link rel="stylesheet" type="text/css" media="screen" href="header/estilo.css">
<link rel="shortcut icon" type="image/x-icon" href="icono.ico" />
<html>

<div id="main-header">

<a href='http://localhost:8080/capitulos/index.php'><img class="logo" width="100" height="80" src="http://localhost:8080/capitulos/header/logo.png" ></a>
<?php
if (!isset($_POST["busc"])){
echo "<div id='buscador'>
<form action='header/header.php' method=post>
<input class='buscador' autocomplete=off type='text' name='busc' size=40>
</form>
</div>";
}
else{
	header("Location:../buscar.php?b=".$_POST["busc"]."");
}
?>
</div>



</html>