<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());
$tiempo=$_POST['tiempo'];

date_default_timezone_set('America/Mexico_City');
$tiempo; //dias a sumar
$fecha = date("Y/m/d");
$fecha= date("Y/m/d", strtotime("$fecha + ". $tiempo ." days")); //se suman los $x dias
echo $fecha;
?>














