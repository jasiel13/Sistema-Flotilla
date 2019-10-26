<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());
$costo_unitario1=$_POST['costo_unitario1'];
$cantidad=$_POST['cantidad'];
 if (is_numeric($costo_unitario1) && is_numeric($cantidad)) 
 {
 	$resultado1 = $costo_unitario1 * $cantidad;
    echo $resultado1;
 } 
 else
 {}
?>