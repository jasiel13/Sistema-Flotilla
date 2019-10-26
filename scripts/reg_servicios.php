<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$servicio=$_POST['servicio'];
$prioridad=$_POST['prioridad'];
$kilometraje=$_POST['kilometraje'];
$tiempo=$_POST['tiempo'];

$insert="INSERT INTO tipos_servicios (tipo_servicio, kilometraje, prioridad, tiempo) VALUES ('$servicio','$kilometraje','$prioridad','$tiempo')";

mysqli_query($con,$insert) or die ("Problemas al insertar".mysqli_error());

mysqli_close($con);

?>