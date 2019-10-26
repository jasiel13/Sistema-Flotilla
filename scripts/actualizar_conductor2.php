<?php
$conductor1=$_POST['conductor1'];
$nombre=$_POST['nombre'];
$apellido_pat=$_POST['apellido_pat'];
$apellido_mat=$_POST['apellido_mat'];
$licencia=$_POST['licencia'];
$fecha_vencimiento=$_POST['fecha_vencimiento'];

$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());

$query6= " UPDATE conductor SET id_conductor = '$conductor1', nombre ='$nombre',apellido_pat =
'$apellido_pat', apellido_mat ='$apellido_mat',licencia ='$licencia', fecha_vencimiento =           '$fecha_vencimiento' WHERE id_conductor  = ' " . $conductor1. " ' ";

$resultado=mysqli_query($con, $query6) or die (mysqli_error()); 
mysqli_close($con);
?>











