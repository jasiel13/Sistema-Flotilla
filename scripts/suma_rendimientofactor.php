<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());
$rendimiento_real=$_POST['rendimiento_real'];
$rendimiento_kilometro=$_POST['rendimiento_kilometro'];


 if (is_numeric($rendimiento_real) && is_numeric($rendimiento_kilometro)) 
 {
 	$resultado = $rendimiento_real / $rendimiento_kilometro; 
    echo $resultado;
 }
 elseif(is_numeric($rendimiento_real))
 {
   $resultado = $rendimiento_real;
    echo $resultado;
 }
elseif(is_numeric($rendimiento_kilometro))
 {
  $resultado = $rendimiento_kilometro;
  echo $resultado;
 }
 else
 {}
?>