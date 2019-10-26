<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$accidente=$_POST['accidente'];
$vehiculo=$_POST['vehiculo'];
$fecha_accidente=$_POST['fecha_accidente'];
$conductor=$_POST['conductor'];
$pago_deducible=$_POST['pago_deducible'];
$pago_adicional=$_POST['pago_adicional'];
$pago_total=$_POST['pago_total'];
$detalles=$_POST['detalles'];

$insert="INSERT INTO  accidentes (accidente,vehiculo,fecha_accidente,conductor,pago_deducible,pago_adicional,pago_total,detalles) VALUES ('$accidente','$vehiculo','$fecha_accidente','$conductor','$pago_deducible','$pago_adicional','$pago_total','$detalles')";
mysqli_query($con,$insert) or die ("Problemas al insertar".mysqli_error());
mysqli_close($con);

?>