<?php
$no_unidad=$_POST['no_unidad'];
$fecha=$_POST['fecha'];
$departamento=$_POST['departamento'];
$empresa=$_POST['empresa'];
$rendimiento=$_POST['rendimiento'];
$status=$_POST['status'];

$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());

$query= " UPDATE vehiculo SET fecha = '$fecha', departamento = '$departamento', empresa = '$empresa' , rendimiento = '$rendimiento' , status='$status' WHERE no_unidad  = ' " . $no_unidad. " ' ";

$resultado=mysqli_query($con, $query) or die (mysqli_error());

mysqli_close($con);
?>











