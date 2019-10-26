<?php
$id_mtto=$_POST['id_mtto'];
$vehiculo=$_POST['vehiculo'];
$km_inicial=$_POST['km_inicial'];
$km_proximo=$_POST['km_proximo'];
$costo_refacciones=$_POST['costo_refacciones'];
$costo_manodeobra=$_POST['costo_manodeobra'];
$costo_total=$_POST['costo_total'];
$referencia=$_POST['referencia'];
$tipo_mtto=$_POST['tipo_mtto'];
$proveedor=$_POST['proveedor'];
$observaciones=$_POST['observaciones'];
$incidente=$_POST['incidente'];
$descripcion_incidente=$_POST['descripcion_incidente'];

$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());

$query= " UPDATE mantenimiento SET vehiculo = '$vehiculo', km_inicial = '$km_inicial', km_proximo= '$km_proximo', costo_refacciones = '$costo_refacciones', costo_manodeobra='$costo_manodeobra',costo_total='$costo_total', referencia='$referencia', tipo_mtto ='$tipo_mtto', proveedor='$proveedor', observaciones='$observaciones', incidente='$incidente',descripcion_incidente='$descripcion_incidente' WHERE id_mtto  = ' " . $id_mtto. " ' ";

$resultado=mysqli_query($con, $query) or die (mysqli_error()); 

mysqli_close($con);
?>











