<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$fecha_registro=$_POST['fecha_registro'];
$conductor=$_POST['conductor'];
$vehiculo=$_POST['vehiculo'];
$cantidad=$_POST['cantidad'];
$costo=$_POST['costo'];
$costo_total=$_POST['costo_total'];
$observaciones=$_POST['observaciones'];

$insert="INSERT INTO  cambio_balatas (fecha_registro,responsable,vehiculo,cantidad,costo,costo_total,observaciones) VALUES ('$fecha_registro','$conductor','$vehiculo','$cantidad','$costo','$costo_total','$observaciones')";
mysqli_query($con,$insert) or die ("Problemas al insertar".mysqli_error());
mysqli_close($con);
?>