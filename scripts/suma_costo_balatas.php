<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());
$costo=$_POST['costo'];
$cantidad=$_POST['cantidad'];


 if (is_numeric($costo) && is_numeric($cantidad)) 
 {
 	$resultado = $costo * $cantidad;
    echo $resultado;
 }
 elseif(is_numeric($costo))
 {
   $resultado = $costo;
    echo $resultado;
 }
elseif(is_numeric($cantidad))
 {
  $resultado = $cantidad;
  echo $resultado;
 }
 else
 {}
?>