<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());
$costo_unitario2=$_POST['costo_unitario2'];
$cantidad=$_POST['cantidad'];
 if (is_numeric($costo_unitario2) && is_numeric($cantidad)) 
 {
    $resultado2 = $costo_unitario2 * $cantidad;
    echo $resultado2;
 } 
 else
 {}
?>