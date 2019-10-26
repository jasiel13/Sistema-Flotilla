<?php
$conductor=$_POST['conductor'];
$vehiculo=$_POST['vehiculo'];
$fecha_mod=$_POST['fecha_mod'];

$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());

$query2= " UPDATE conductor SET id_conductor = '$conductor', vehiculo = '$vehiculo', fecha_modificacion = '$fecha_mod' WHERE id_conductor  = ' " . $conductor. " ' ";

$resultado=mysqli_query($con, $query2) or die (mysqli_error()); 

//SI SE QUITA ESTE INSERT SOLO FUNCIONA EL UPDATE Y NO INSERTA NADA EN LA TABLA HISTORIAL
$insert="INSERT INTO historial_conductor (id_conductor, nombre, apellido_pat, apellido_mat ,licencia, fecha_vencimiento, vehiculo, fecha_modificacion) SELECT id_conductor, nombre, apellido_pat, apellido_mat, licencia, fecha_vencimiento, vehiculo , fecha_modificacion FROM conductor WHERE id_conductor  = ' " . $conductor. " ' ";
$result=mysqli_query($con, $insert) or die (mysqli_error());

mysqli_close($con);
?>











