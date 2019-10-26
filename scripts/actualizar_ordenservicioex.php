<?php
$numero_orden=$_POST['numero_orden'];
$vehiculo1=$_POST['vehiculo1'];
$servicio1=$_POST['servicio1'];
$responsable1=$_POST['responsable1'];
$fecha_inicio1=$_POST['fecha_inicio1'];
$proveedor1=$_POST['proveedor1'];
$costo1=$_POST['costo1'];
$kilometraje1=$_POST['kilometraje1'];
$autorizacion1=$_POST['autorizacion1'];
$fecha_entrega1=$_POST['fecha_entrega1'];
$comentarios1=$_POST['comentarios1'];

$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());

$query= " UPDATE orden_servicio_externo SET vehiculo = '$vehiculo1', servicio = '$servicio1', responsable= '$responsable1', fecha_inicio = '$fecha_inicio1', proveedor='$proveedor1', costo='$costo1', kilometraje ='$kilometraje1', autorizacion='$autorizacion1', fecha_entrega='$fecha_entrega1', comentarios='$comentarios1' WHERE numero_orden  = ' " . $numero_orden. " ' ";
$resultado=mysqli_query($con, $query) or die (mysqli_error()); 

if($query==true){
$query2= " UPDATE historial_ordenes_servicioex SET vehiculo = '$vehiculo1', servicio = '$servicio1', responsable= '$responsable1', fecha_inicio = '$fecha_inicio1', proveedor='$proveedor1', costo='$costo1', kilometraje ='$kilometraje1', autorizacion='$autorizacion1', fecha_entrega='$fecha_entrega1', comentarios='$comentarios1' WHERE numero_orden  = ' " . $numero_orden. " ' ";
$resultado=mysqli_query($con, $query2) or die (mysqli_error()); 	

 }
mysqli_close($con);
?>











