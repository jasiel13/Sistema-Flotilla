<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
$valor=$_POST['valor'];
$id=$_POST['id'];

$query= "UPDATE orden_servicio_externo SET estado = '$valor' WHERE numero_orden='$id'";
mysqli_query($con,$query) or die ("Problemas al actualizar".mysqli_error($con));

//este codigo fue necesario por la tabla del historial ya que sino quedaria como cuando se registro y no tomaria encuenta las actualizaciones que haga el usuario
if($query==true){
$query2= "UPDATE historial_ordenes_servicioex SET estado = '$valor' WHERE numero_orden='$id'";
mysqli_query($con,$query2) or die ("Problemas al actualizar".mysqli_error($con));
 }
?>

