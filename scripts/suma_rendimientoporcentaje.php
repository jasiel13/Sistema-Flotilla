<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());
$factor=$_POST['factor'];
$rendimiento_kilometro=$_POST['rendimiento_kilometro'];


 if (is_numeric($factor) && is_numeric($rendimiento_kilometro)) 
 {
 	$resultado = $factor * 100 / $rendimiento_kilometro; 
    //echo $resultado;
    //se agrego la funcion round para redondear el resultado
    echo round($resultado,0,PHP_ROUND_HALF_DOWN);
 }
 elseif(is_numeric($factor))
 {
   $resultado = $factor;
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