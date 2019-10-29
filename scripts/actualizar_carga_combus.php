<?php
$id_carga=$_POST['id_carga'];
$vehiculo=$_POST['vehiculo'];
$fecha=$_POST['fecha'];
$hora=$_POST['hora'];
$ticket=$_POST['ticket'];
$factura=$_POST['factura'];
$tipo1=$_POST['tipo1'];
$costo_total=$_POST['costo_total'];
$litros=$_POST['litros'];
$costo_litro=$_POST['costo_litro'];
$empresa=$_POST['empresa'];
$km_inicial=$_POST['km_inicial'];
$km_final=$_POST['km_final'];
$rendimiento_real=$_POST['rendimiento_real'];
$rendimiento_kilometro=$_POST['rendimiento_kilometro'];
$factor=$_POST['factor'];
$porcentaje=$_POST['porcentaje'];

$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());

$query= " UPDATE carga_combustible SET vehiculo = '$vehiculo', fecha_carga = '$fecha', hora_carga= '$hora', ticket = '$ticket', factura='$factura', tipo='$tipo1', costo_total ='$costo_total', litros='$litros', costo_litro='$costo_litro', empresa='$empresa', km_inicial='$km_inicial', km_final='$km_final', rendimiento_real='$rendimiento_real', rendimiento_kilometro='$rendimiento_kilometro', factor='$factor', porcentaje='$porcentaje' WHERE id_carga  = ' " . $id_carga. " ' ";

$resultado=mysqli_query($con, $query) or die (mysqli_error()); 

mysqli_close($con);
?>











