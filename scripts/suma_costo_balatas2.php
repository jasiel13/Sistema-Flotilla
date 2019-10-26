<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());
$costo2=$_POST['costo2'];
$cantidad2=$_POST['cantidad2'];


 if (is_numeric($costo2) && is_numeric($cantidad2)) 
 {
 	$resultado = $costo2 * $cantidad2;
    echo $resultado;
 }
 elseif(is_numeric($costo2))
 {
   $resultado = $costo2;
    echo $resultado;
 }
elseif(is_numeric($cantidad2))
 {
  $resultado = $cantidad2;
  echo $resultado;
 }
 else
 {}
?>