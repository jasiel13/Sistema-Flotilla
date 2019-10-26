<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$query2="SELECT  * FROM vehiculo";
$result=mysqli_query($con, $query2) or die (mysqli_error());

echo "<table class='table table-hover table-sm table-bordered table-condensed' id='exportar'>
<thead class='thead-dark'>
<tr>
<th>No_unidad</th>
<th>Vehículo</th>
<th>Marca</th>
<th>Modelo</th>
<th>Año</th>
<th>Placa</th>
<th>Tipo de vehículo</th>
<th>Fecha Renovación Placas</th>
<th>Depto.</th>
<th>Empresa</th>
<th>Medida_uso</th>
<th>Rendimiento</th>
<th>No_serie</th>
<th>Status</th>
</tr>
</thead>";

while ($row=mysqli_fetch_array($result))
{   echo "<tbody>";
	echo "<tr>";
	echo "<td>".$row['no_unidad']."</td>";
	echo "<td>".$row['vehiculo']."</td>";
	echo "<td>".$row['marca']."</td>";
	echo "<td>".$row['modelo']."</td>";
	echo "<td>".$row['ano']."</td>";
	echo "<td>".$row['placa']."</td>";	
	echo "<td>".$row['tipo']."</td>";	
	echo "<td>".$row['fecha']."</td>";	
	echo "<td>".$row['departamento']."</td>";		
	echo "<td>".$row['empresa']."</td>";
	echo "<td>".$row['medida_uso']."</td>";	
	echo "<td>".$row['rendimiento']."</td>";	
	echo "<td>".$row['no_serie']."</td>";
	echo "<td>".$row['status']."</td>";	
	echo "</tr>";
	echo "</tbody>";

}
echo "</table>";

mysqli_query($con,$query2) or die ("Problemas al llamar tabla".mysqli_error());

mysqli_close($con);

?>