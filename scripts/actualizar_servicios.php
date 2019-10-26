<?php
$servicio1=$_POST['servicio1'];
$prioridad1=$_POST['prioridad1'];
$kilometraje1=$_POST['kilometraje1'];
$tiempo1=$_POST['tiempo1'];

$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());

$query= " UPDATE tipos_servicios SET  prioridad= '$prioridad1', kilometraje= '$kilometraje1', tiempo = '$tiempo1' WHERE id_servicio  = ' " . $servicio1. " ' ";

$resultado=mysqli_query($con, $query) or die (mysqli_error()); 

mysqli_close($con);
?>











