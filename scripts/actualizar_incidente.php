<?php
$id_incidente=$_POST['id_incidente'];
$conductor=$_POST['conductor'];
$servicio=$_POST['servicio'];
$vehiculo=$_POST['vehiculo'];
$odometro=$_POST['odometro'];
$incidente=$_POST['incidente'];
$descripcion=$_POST['descripcion'];

$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());

$query= " UPDATE incidentes SET conductor = '$conductor', servicio = '$servicio', vehiculo= '$vehiculo', odometro = '$odometro', incidente='$incidente', descripcion='$descripcion' WHERE id_incidente  = ' " . $id_incidente. " ' ";

$resultado=mysqli_query($con, $query) or die (mysqli_error()); 

mysqli_close($con);
?>











