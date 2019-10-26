<?php
$id_balatas=$_POST['id_balatas'];
$fecha_registro2=$_POST['fecha_registro2'];
$conductor2=$_POST['conductor2'];
$vehiculo2=$_POST['vehiculo2'];
$cantidad2=$_POST['cantidad2'];
$costo2=$_POST['costo2'];
$costo_total2=$_POST['costo_total2'];
$observaciones2=$_POST['observaciones2'];

$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());

$query= " UPDATE cambio_balatas SET fecha_registro = '$fecha_registro2',responsable='$conductor2', vehiculo = '$vehiculo2',cantidad = '$cantidad2', costo= '$costo2', costo_total = '$costo_total2', observaciones='$observaciones2' WHERE id_balatas  = ' " . $id_balatas. " ' ";
$resultado=mysqli_query($con, $query) or die (mysqli_error());
mysqli_close($con);
?>











