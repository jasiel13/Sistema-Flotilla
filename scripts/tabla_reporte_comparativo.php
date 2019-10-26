<?php
//error_reporting(0);
$numero_orden=$_POST['numero_orden'];
$vehiculo=$_POST['vehiculo'];

$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$query="select numero_orden,vehiculo,servicio,cantidad,proveedor1,proveedor2,proveedor3,costo_unitario1,costo_total1,costo_unitario2,costo_total2,costo_unitario3,costo_total3 from orden_servicio_gastos where numero_orden='$numero_orden' and vehiculo='$vehiculo'";

$result=mysqli_query($con, $query) or die (mysqli_error());

echo "<table class='table table-hover table-sm table-bordered table-condensed' id='exportar'>
<thead class='thead-dark text-center'>

<tr>
<th colspan='7' scope='rowgroup' class='bg-info text-center'><h3>Reporte Comparativo de Ordenes de Servicio Externas</h3></th>
</tr>

<tr>
<th>Número de Orden</th>
<th>Vehículo</th>
<th>Servicios</th>
<th>Cantidad</th>
<th>Proveedor1</th>
<th>Costo Unitario1</th>
<th>Costo Total1</th>
</tr>
</thead>";

while ($row=mysqli_fetch_array($result))
{ 

  echo "<tbody class='text-center'>";    
	echo "<tr>";
    echo "<td>".$row['numero_orden']."</td>";	
	echo "<td>".$row['vehiculo']."</td>";
	echo "<td>".$row['servicio']."</td>";
	echo "<td>".$row['cantidad']."</td>";
	echo "<td>".$row['proveedor1']."</td>";
	echo "<td>".$row['costo_unitario1']."</td>";
    echo "<td>".$row['costo_total1']."</td>";   
	echo "</tr>";

	echo "<tr>";
	echo "<th class='bg-warning'>Número de Orden</th>";
	echo "<th class='bg-warning'>Vehículo</th>";
	echo "<th class='bg-warning'>Servicios</th>";
	echo "<th class='bg-warning'>Cantidad</th>";
	echo "<th class='bg-warning'>Proveedor2</th>";
	echo "<th class='bg-warning'>Costo Unitario2</th>";
	echo "<th class='bg-warning'>Costo Total2</th>";	
    echo "</tr>";

    echo "<tr>";
    echo "<td>".$row['numero_orden']."</td>";	
	echo "<td>".$row['vehiculo']."</td>";
	echo "<td>".$row['servicio']."</td>";
	echo "<td>".$row['cantidad']."</td>";
	echo "<td>".$row['proveedor2']."</td>";
	echo "<td>".$row['costo_unitario2']."</td>";	
	echo "<td>".$row['costo_total2']."</td>";	
    echo "</tr>";

    echo "<tr>";
	echo "<th class='bg-success'>Número de Orden</th>";
	echo "<th class='bg-success'>Vehículo</th>";
	echo "<th class='bg-success'>Servicios</th>";
	echo "<th class='bg-success'>Cantidad</th>";
	echo "<th class='bg-success'>Proveedor3</th>";
	echo "<th class='bg-success'>Costo Unitario3</th>";
	echo "<th class='bg-success'>Costo Total3</th>";	
    echo "</tr>";

    echo "<tr>";
    echo "<td>".$row['numero_orden']."</td>";	
	echo "<td>".$row['vehiculo']."</td>";
	echo "<td>".$row['servicio']."</td>";
	echo "<td>".$row['cantidad']."</td>";
	echo "<td>".$row['proveedor3']."</td>";
	echo "<td>".$row['costo_unitario3']."</td>";	
	echo "<td>".$row['costo_total3']."</td>";	
    echo "</tr>";

  echo "</tbody>";

}
 echo "</table>";

mysqli_query($con,$query) or die ("Problemas al llamar tabla".mysqli_error());
mysqli_close($con);
?>