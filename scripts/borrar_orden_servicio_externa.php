<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());

$query="delete from orden_servicio_externo where numero_orden= '".$_POST["id"]."' ";

$resultado=mysqli_query($con, $query) or die (mysqli_error());
echo "Registro Borrado con éxito!!";
mysqli_close($con);
?>
