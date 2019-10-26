<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$valor=$_POST['valor'];
$jsondata = array();

$query="SELECT  vehiculo, km_inicial, km_proximo, costo_refacciones, costo_manodeobra, costo_total, referencia, tipo_mtto, proveedor, incidente, descripcion_incidente, observaciones, fecha_proximo from mantenimiento where id_mtto=$valor";
$result=mysqli_query($con, $query) or die (mysqli_error());

$resultados= mysqli_fetch_array($result); 

/*$fecha_inicio=$resultados['fecha_inicio'];
$servicio=$resultados['servicio'];
$servicio1=$resultados['servicio'];
$tiempo=$resultados['tiempo'];
$fecha_final=$resultados['fecha_final'];*/
$vehiculo=$resultados['vehiculo'];
$km_inicial=$resultados['km_inicial'];
$km_proximo=$resultados['km_proximo'];
$costo_refacciones=$resultados['costo_refacciones'];
$costo_manodeobra=$resultados['costo_manodeobra'];
$costo_total=$resultados['costo_total'];
$referencia=$resultados['referencia'];
$tipo_mtto=$resultados['tipo_mtto'];
$proveedor=$resultados['proveedor'];
$observaciones=$resultados['observaciones'];
$incidente=$resultados['incidente'];
$incidente1=$resultados['incidente'];
$descripcion_incidente=$resultados['descripcion_incidente'];
/*$fecha_proximo=$resultados['fecha_proximo'];*/

//agregamos nuestros datos al array para retornarlos

/*$jsondata['fecha_inicio'] = $fecha_inicio; 
$jsondata['servicio'] = $servicio;
$jsondata['servicio1'] = $servicio1;  
$jsondata['tiempo'] = $tiempo; 
$jsondata['fecha_final'] = $fecha_final;*/ 
$jsondata['vehiculo'] = $vehiculo; 
$jsondata['km_inicial'] = $km_inicial; 
$jsondata['km_proximo'] = $km_proximo; 
$jsondata['costo_refacciones'] = $costo_refacciones; 
$jsondata['costo_manodeobra'] = $costo_manodeobra; 
$jsondata['costo_total'] = $costo_total; 
$jsondata['referencia'] = $referencia; 
$jsondata['tipo_mtto'] = $tipo_mtto; 
$jsondata['proveedor'] = $proveedor;
$jsondata['observaciones'] = $observaciones; 
$jsondata['incidente'] = $incidente;
$jsondata['incidente1'] = $incidente1;
$jsondata['descripcion_incidente'] = $descripcion_incidente;
/*$jsondata['fecha_proximo'] = $fecha_proximo;*/
//este header es para el retorno correcto de datos con json
 header('Content-type: application/json; charset=utf-8');
 echo json_encode($jsondata); 
 mysqli_close($con);

?>


