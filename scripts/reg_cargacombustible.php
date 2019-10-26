<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$vehiculo=$_POST['vehiculo'];
$fecha=$_POST['fecha'];
$hora=$_POST['hora'];
$ticket=$_POST['ticket'];
$factura=$_POST['factura'];
$tipo1=$_POST['tipo1'];
$capacidad=$_POST['capacidad'];
$costo_total=$_POST['costo_total'];
$litros=$_POST['litros'];
$costo_litro=$_POST['costo_litro'];
$fecha_reg=$_POST['fecha_reg'];
$empresa=$_POST['empresa'];
$km_inicial=$_POST['km_inicial'];
$km_final=$_POST['km_final'];
$rendimiento_real=$_POST['rendimiento_real'];
$rendimiento_kilometro=$_POST['rendimiento_kilometro'];
$factor=$_POST['factor'];

$insert="INSERT INTO carga_combustible(vehiculo ,fecha_carga, hora_carga, ticket, factura, capacidad, tipo, costo_total, litros, costo_litro, fecha_registro,empresa,km_inicial,km_final,rendimiento_real,rendimiento_kilometro,factor) VALUES ('$vehiculo','$fecha','$hora','$ticket','$factura','$capacidad','$tipo1', '$costo_total','$litros', '$costo_litro','$fecha_reg','$empresa','$km_inicial','$km_final','$rendimiento_real','$rendimiento_kilometro','$factor')";
mysqli_query($con,$insert) or die ("Problemas al insertar".mysqli_error());
?>

