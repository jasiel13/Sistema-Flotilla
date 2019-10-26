<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$query="SELECT  * FROM proveedores";
$result=mysqli_query($con, $query) or die (mysqli_error());

echo "<table class='table table-hover table-sm table-bordered table-condensed' id='exportar'>
<thead class='thead-dark'>
<tr>
<th>Proveedor</th>
<th>Tipo de Producto</th>
<th>Ciudad</th>
<th>Contacto</th>
<th>Teléfono</th>
<th>Celular</th>
<th>Correo</th>
</tr>
</thead>";

while ($row=mysqli_fetch_array($result))
{   echo "<tbody>";
	echo "<tr>";
	echo "<td>".$row['proveedor']."</td>";
	echo "<td>".$row['tipo']."</td>";
	echo "<td>".$row['ciudad']."</td>";
	echo "<td>".$row['contacto']."</td>";
	echo "<td>".$row['telefono']."</td>";
	echo "<td>".$row['celular']."</td>";
	echo "<td>".$row['correo']."</td>";
	echo "</tr>";
	echo "</tbody>";

}
echo "</table>";

mysqli_query($con,$query) or die ("Problemas al llamar tabla".mysqli_error());

mysqli_close($con);

?>