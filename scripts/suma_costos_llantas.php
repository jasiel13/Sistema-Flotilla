<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());
$costo_unitario=$_POST['costo_unitario'];
$cantidad=$_POST['cantidad'];
 if (is_numeric($costo_unitario) && is_numeric($cantidad)) 
 {
 	$resultado = $costo_unitario * $cantidad;
    echo $resultado;
 } 
 else
 {}
?>