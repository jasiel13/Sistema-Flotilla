<?php
$id_accidentes=$_POST['id_accidentes'];
$accidente1=$_POST['accidente1'];
$vehiculo1=$_POST['vehiculo1'];
$fecha_accidente1=$_POST['fecha_accidente1'];
$conductor1=$_POST['conductor1'];
$pago_deducible1=$_POST['pago_deducible1'];
$pago_adicional1=$_POST['pago_adicional1'];
$pago_total1=$_POST['pago_total1'];
$detalles1=$_POST['detalles1'];

$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());

$query= " UPDATE accidentes SET accidente ='$accidente1', vehiculo = '$vehiculo1', fecha_accidente= '$fecha_accidente1', conductor='$conductor1', pago_deducible= '$pago_deducible1', pago_adicional='$pago_adicional1', pago_total= '$pago_total1', detalles='$detalles1' WHERE id_accidentes  = ' " . $id_accidentes. " ' ";
$resultado=mysqli_query($con, $query) or die (mysqli_error());
mysqli_close($con);
?>











