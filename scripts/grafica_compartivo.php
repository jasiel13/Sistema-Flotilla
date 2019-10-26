<?php
header('Content-Type: application/json');
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$numero_orden=$_POST['numero_orden'];
$vehiculo=$_POST['vehiculo'];

$query = "SELECT servicio,costo_unitario1,costo_total1,costo_unitario2,costo_total2,costo_unitario3,costo_total3 FROM orden_servicio_gastos WHERE numero_orden='$numero_orden' and vehiculo ='$vehiculo'";
$result = mysqli_query($con,$query);

$data = array();
foreach ($result as $row) 
{
  $data[] = $row;
}
mysqli_close($con);
echo json_encode($data);
?>