<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$vehiculo=$_POST['vehiculo'];
$num_serie=$_POST['num_serie'];
$fecha=$_POST['fecha'];
$marca1=$_POST['marca1'];
$cantidad=$_POST['cantidad'];
$costo_unitario=$_POST['costo_unitario'];
$costo_total=$_POST['costo_total'];
$kilometraje=$_POST['kilometraje'];
$proximo_kilometraje=$_POST['proximo_kilometraje'];
$proximo_cambio=$_POST['proximo_cambio'];

$insert="INSERT INTO llantas(vehiculo,num_serie,fecha,marca,cantidad,costo_unitario,costo_total,kilometraje,proximo_kilometraje,proximo_cambio) VALUES ('$vehiculo','$num_serie','$fecha','$marca1','$cantidad','$costo_unitario','$costo_total','$kilometraje','$proximo_kilometraje','$proximo_cambio')";

mysqli_query($con,$insert) or die ("Problemas al insertar".mysqli_error());

mysqli_close($con);

?>