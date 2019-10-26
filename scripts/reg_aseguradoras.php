<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$aseguradora=$_POST['aseguradora'];

$insert="INSERT INTO  aseguradoras (aseguradora) VALUES ('$aseguradora')";

mysqli_query($con,$insert) or die ("Problemas al insertar".mysqli_error());

mysqli_close($con);

?>