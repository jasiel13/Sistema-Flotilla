<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$refacciones=$_POST['refacciones'];

$insert="INSERT INTO  refacciones (partes) VALUES ('$refacciones')";

mysqli_query($con,$insert) or die ("Problemas al insertar".mysqli_error());

mysqli_close($con);

?>