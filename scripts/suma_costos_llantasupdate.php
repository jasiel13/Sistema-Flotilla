<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());
$costo_unitario1=$_POST['costo_unitario1'];
$cantidad1=$_POST['cantidad1'];
 if (is_numeric($costo_unitario1) && is_numeric($cantidad1)) 
 {
 	$resultado1 = $costo_unitario1 * $cantidad1;
    echo $resultado1;
 } 
 else
 {}
?>