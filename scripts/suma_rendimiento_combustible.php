<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());
$km_inicial=$_POST['km_inicial'];
$km_final=$_POST['km_final'];
$litros=$_POST['litros'];


 if (is_numeric($km_inicial) && is_numeric($km_final) && is_numeric($litros)) 
 {
 	$resultado = $km_final - $km_inicial;
 	$resultadof= $resultado / $litros;
    echo $resultadof;
 }
 elseif(is_numeric($km_inicial))
 {
   $resultado = $km_inicial;
    echo $resultado;
 }
elseif(is_numeric($km_final))
 {
  $resultado = $km_final;
  echo $resultado;
 }
 elseif(is_numeric($litros))
 {
  $resultado = $litros;
  echo $resultado;
 }
 else
 {}
?>