<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
//el dato que enviamos a traves de ajax
$valor=$_POST['valor'];
//esta variable es para retornar los datos
$jsondata = array();
//la consulta que necesites para trer el codigo y el nombre del cliente
$query="SELECT vehiculo,fecha_carga,hora_carga,ticket,factura,tipo,costo_total,litros,costo_litro,empresa,km_inicial,km_final,rendimiento_real,rendimiento_kilometro,factor from carga_combustible where id_carga=$valor";
$result=mysqli_query($con, $query) or die (mysqli_error());

$resultados= mysqli_fetch_array($result);
$vehiculo1=$resultados['vehiculo'];
$vehiculo=$resultados['vehiculo']; 
$fecha=$resultados['fecha_carga'];
$hora=$resultados['hora_carga'];
$ticket=$resultados['ticket'];
$factura=$resultados['factura'];
$tipo1=$resultados['tipo'];
$costo_total=$resultados['costo_total'];
$litros=$resultados['litros'];
$costo_litro=$resultados['costo_litro'];
$empresa=$resultados['empresa'];
$km_inicial=$resultados['km_inicial'];
$km_final=$resultados['km_final'];
$rendimiento_real=$resultados['rendimiento_real'];
$rendimiento_kilometro=$resultados['rendimiento_kilometro'];
$factor=$resultados['factor']; 

//agregamos nuestros datos al array para retornarlos
$jsondata['vehiculo1'] = $vehiculo1;
$jsondata['vehiculo'] = $vehiculo;
$jsondata['fecha'] = $fecha;
$jsondata['hora'] = $hora;
$jsondata['ticket'] = $ticket;
$jsondata['factura'] = $factura;
$jsondata['tipo1'] = $tipo1;
$jsondata['costo_total'] = $costo_total;
$jsondata['litros'] = $litros;
$jsondata['costo_litro'] = $costo_litro;
$jsondata['empresa'] = $empresa;
$jsondata['km_inicial'] = $km_inicial;
$jsondata['km_final'] = $km_final;
$jsondata['rendimiento_real'] = $rendimiento_real;
$jsondata['rendimiento_kilometro'] = $rendimiento_kilometro;
$jsondata['factor'] = $factor;
 
//este header es para el retorno correcto de datos con json
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata); 
 mysqli_close($con);

?>


