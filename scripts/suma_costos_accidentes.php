<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());
$pago_deducible=$_POST['pago_deducible'];
$pago_adicional=$_POST['pago_adicional'];


 if (is_numeric($pago_deducible) && is_numeric($pago_adicional)) 
 {
 	$resultado = $pago_deducible + $pago_adicional;
    echo $resultado;
 }
 elseif(is_numeric($pago_deducible))
 {
   $resultado = $pago_deducible;
    echo $resultado;
 }
elseif(is_numeric($pago_adicional))
 {
  $resultado = $pago_adicional;
  echo $resultado;
 }
 else
 {}
?>