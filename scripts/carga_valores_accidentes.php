<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
//el dato que enviamos a traves de ajax
$valor=$_POST['valor'];
//esta variable es para retornar los datos
$jsondata = array();
//la consulta que necesites para trer el codigo y el nombre del cliente
$query="SELECT accidente,vehiculo,fecha_accidente,conductor,pago_deducible,pago_adicional,pago_total,detalles from accidentes where id_accidentes=$valor";
$result=mysqli_query($con, $query) or die (mysqli_error());

$resultados= mysqli_fetch_array($result);

$accidente1=$resultados['accidente'];
$vehiculo1=$resultados['vehiculo'];
$fecha_accidente1=$resultados['fecha_accidente'];
$conductor1=$resultados['conductor'];
$pago_deducible1=$resultados['pago_deducible'];
$pago_adicional1=$resultados['pago_adicional'];
$pago_total1=$resultados['pago_total'];
$detalles1=$resultados['detalles'];
 
//agregamos nuestros datos al array para retornarlos
$jsondata['accidente1'] = $accidente1;
$jsondata['vehiculo1'] = $vehiculo1;
$jsondata['fecha_accidente1'] = $fecha_accidente1;
$jsondata['conductor1'] = $conductor1;
$jsondata['pago_deducible1'] = $pago_deducible1;
$jsondata['pago_adicional1'] = $pago_adicional1;
$jsondata['pago_total1'] = $pago_total1; 
$jsondata['detalles1'] = $detalles1; 
//este header es para el retorno correcto de datos con json
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata); 
 mysqli_close($con);

?>


