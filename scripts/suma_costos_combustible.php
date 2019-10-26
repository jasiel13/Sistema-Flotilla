<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());
$costo_total=$_POST['costo_total'];
$costo_litro=$_POST['costo_litro'];


 if (is_numeric($costo_total) && is_numeric($costo_litro)) 
 {
 	$resultado = $costo_total / $costo_litro;
    echo $resultado;
 }
 elseif(is_numeric($costo_total))
 {
   $resultado = $costo_total;
    echo $resultado;
 }
elseif(is_numeric($costo_litro))
 {
  $resultado = $costo_litro;
  echo $resultado;
 }
 else
 {}
?>