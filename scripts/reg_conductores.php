<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$nombre=$_POST['nombre'];
$ap_pat=$_POST['ap_pat'];
$ap_mat=$_POST['ap_mat'];
$licencia=$_POST['licencia'];
$fecha=$_POST['fecha'];
$vehiculo=$_POST['vehiculo'];

$insert="INSERT INTO conductor(nombre, apellido_pat, apellido_mat, licencia, fecha_vencimiento, vehiculo) VALUES ('$nombre','$ap_pat','$ap_mat','$licencia','$fecha','$vehiculo')";

mysqli_query($con,$insert) or die ("Problemas al insertar".mysqli_error());

mysqli_close($con);

?>