<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$fecha_prox_mtto=$_POST['fecha_prox_mtto'];
$id=$_POST['id'];

$query= "UPDATE mantenimiento SET fecha_proximo = '$fecha_prox_mtto' WHERE id_mtto  = ' " . $id. " ' ";
mysqli_query($con,$query) or die ("Problemas al actualizar".mysqli_error($con));
?>

