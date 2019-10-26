<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$vehiculo=$_POST['vehiculo'];
$aseguradora1=$_POST['aseguradora1'];
$poliza=$_POST['poliza'];
$fecha_vencimiento=$_POST['fecha_vencimiento'];
$monto_total=$_POST['monto_total'];
$accidente1=$_POST['accidente1'];
$costo_total_accidente=$_POST['costo_total_accidente'];

$insert="INSERT INTO  seguros (vehiculo,aseguradora,poliza,fecha_vencimiento,monto_total,accidente,costo_total_accidente) VALUES ('$vehiculo','$aseguradora1','$poliza','$fecha_vencimiento','$monto_total','$accidente1','$costo_total_accidente')";
mysqli_query($con,$insert) or die ("Problemas al insertar".mysqli_error());
mysqli_close($con);

?>