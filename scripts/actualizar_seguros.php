<?php
$id_seguro=$_POST['id_seguro'];
$vehiculo1=$_POST['vehiculo1'];
$aseguradora2=$_POST['aseguradora2'];
$poliza1=$_POST['poliza1'];
$fecha_vencimiento1=$_POST['fecha_vencimiento1'];
$monto_total1=$_POST['monto_total1'];
$accidente4=$_POST['accidente4'];
$costo_total_accidente1=$_POST['costo_total_accidente1'];

$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());

$query= " UPDATE seguros SET vehiculo ='$vehiculo1', aseguradora = '$aseguradora2', poliza= '$poliza1', fecha_vencimiento='$fecha_vencimiento1', monto_total= '$monto_total1', accidente='$accidente4', costo_total_accidente= '$costo_total_accidente1' WHERE id_seguro  = ' " . $id_seguro. " ' ";
$resultado=mysqli_query($con, $query) or die (mysqli_error());
mysqli_close($con);
?>











