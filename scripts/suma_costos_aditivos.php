<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());
$litros=$_POST['litros'];
$costo_litro=$_POST['costo_litro'];
 if (is_numeric($litros) && is_numeric($costo_litro)) 
 {
 	$resultado = $litros * $costo_litro;
    echo $resultado;
 } 
 else
 {}
?>