<?php
$id_refacciones=$_POST['id_refacciones'];
$vehiculo1=$_POST['vehiculo1'];
$parte1=$_POST['parte1'];
$tipo1=$_POST['tipo1'];
$monto1=$_POST['monto1'];
$proveedor1=$_POST['proveedor1'];

$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());

$query= " UPDATE listado_partes SET vehiculo = '$vehiculo1', parte = '$parte1', tipo= '$tipo1', monto = '$monto1', proveedor='$proveedor1' WHERE id_refacciones  = ' " . $id_refacciones. " ' ";
$resultado=mysqli_query($con, $query) or die (mysqli_error());
mysqli_close($con);
?>











