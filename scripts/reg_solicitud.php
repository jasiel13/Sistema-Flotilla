<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$fecha=$_POST['fecha'];
$usuario=$_POST['usuario'];
$prioridad=$_POST['prioridad'];
$problema=$_POST['problema'];

$insert="INSERT INTO soporte(fecha, usuario, problema, prioridad) VALUES ('$fecha','$usuario','$problema','$prioridad')";

mysqli_query($con,$insert) or die ("Problemas al insertar".mysqli_error());

mysqli_close($con);

?>