<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());
$costo_unitario3=$_POST['costo_unitario3'];
$cantidad=$_POST['cantidad'];
 if (is_numeric($costo_unitario3) && is_numeric($cantidad)) 
 {
    $resultado3 = $costo_unitario3 * $cantidad;
    echo $resultado3;
 }
 else
 {}
?>