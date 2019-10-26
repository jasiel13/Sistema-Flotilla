<?php
$id_llantas=$_POST['id_llantas'];
$vehiculo1=$_POST['vehiculo1'];
$num_serie2=$_POST['num_serie2'];
$marca2=$_POST['marca2'];
$cantidad1=$_POST['cantidad1'];
$costo_unitario1=$_POST['costo_unitario1'];
$costo_total1=$_POST['costo_total1'];
$kilometraje1=$_POST['kilometraje1'];
$proximo_kilometraje1=$_POST['proximo_kilometraje1'];

$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());

$query= " UPDATE llantas SET vehiculo = '$vehiculo1',num_serie='$num_serie2', marca = '$marca2', cantidad= '$cantidad1', costo_unitario = '$costo_unitario1', costo_total='$costo_total1', kilometraje ='$kilometraje1', proximo_kilometraje ='$proximo_kilometraje1' WHERE id_llantas  = ' " . $id_llantas. " ' ";
$resultado=mysqli_query($con, $query) or die (mysqli_error());
mysqli_close($con);
?>











