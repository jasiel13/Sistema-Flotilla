<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());
$prioridad=$_POST['prioridad'];

date_default_timezone_set('America/Mexico_City');
$prioridad; //dias a sumar
$fecha = date("Y/m/d");
$fecha= date("Y/m/d", strtotime("$fecha + ". $prioridad ." days")); //se suman los $x dias
echo $fecha;
?>






