<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());

$query="delete from vehiculo where no_unidad= '".$_POST["id"]."' ";
//error_log($query1);
$resultado=mysqli_query($con, $query) or die (mysqli_error());

echo "Registro Borrado con éxito!!";
mysqli_close($con);
?>
