<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());
$costo_ref=$_POST['costo_refacciones'];
$costo_mano=$_POST['costo_manodeobra'];


 if (is_numeric($costo_ref) && is_numeric($costo_mano)) 
 {
 	$resultado = $costo_ref + $costo_mano;
    echo $resultado;
 }
 elseif(is_numeric($costo_ref))
 {
   $resultado = $costo_ref;
    echo $resultado;
 }
elseif(is_numeric($costo_mano))
 {
  $resultado = $costo_mano;
  echo $resultado;
 }
 else
 {}
?>