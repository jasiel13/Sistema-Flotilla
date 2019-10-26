<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());
$pago_deducible1=$_POST['pago_deducible1'];
$pago_adicional1=$_POST['pago_adicional1'];


 if (is_numeric($pago_deducible1) && is_numeric($pago_adicional1)) 
 {
 	$resultado1 = $pago_deducible1 + $pago_adicional1;
    echo $resultado1;
 }
 elseif(is_numeric($pago_deducible1))
 {
   $resultado1 = $pago_deducible1;
    echo $resultado1;
 }
elseif(is_numeric($pago_adicional1))
 {
  $resultado1 = $pago_adicional1;
  echo $resultado1;
 }
 else
 {}
?>