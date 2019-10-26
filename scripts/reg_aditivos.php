<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$aditivo=$_POST['aditivo'];
$marca=$_POST['marca'];

$insert="INSERT INTO  aditivo_tipo (aditivo,marca) VALUES ('$aditivo','$marca')";

mysqli_query($con,$insert) or die ("Problemas al insertar".mysqli_error());

mysqli_close($con);

?>