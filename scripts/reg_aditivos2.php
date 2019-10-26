<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$aditivo2=$_POST['aditivo2'];
$fecha_registro=$_POST['fecha_registro'];
$marca1=$_POST['marca1'];
$litros=$_POST['litros'];
$costo_litro=$_POST['costo_litro'];
$costo_total=$_POST['costo_total'];
$vehiculo=$_POST['vehiculo'];

$insert="INSERT INTO aditivos(aditivo,fecha_registro,marca,litros,costo_litro,costo_total,vehiculo) VALUES ('$aditivo2','$fecha_registro','$marca1','$litros','$costo_litro','$costo_total','$vehiculo')";

mysqli_query($con,$insert) or die ("Problemas al insertar".mysqli_error());

mysqli_close($con);

?>