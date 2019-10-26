<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());
$litros1=$_POST['litros1'];
$costo_litro1=$_POST['costo_litro1'];
 if (is_numeric($litros1) && is_numeric($costo_litro1)) 
 {
 	$resultado1 = $litros1 * $costo_litro1;
    echo $resultado1;
 } 
 else
 {}
?>