<?php
error_reporting(0);
$factura=$_POST['factura'];
$empresa=$_POST['empresa'];

$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

//subquery con inner join 
$query="select vehiculo,fecha_carga,rendimiento_kilometro,rendimiento_real,ticket,T.factura,costo_total,empresa,A.monto
from carga_combustible T 
INNER JOIN 
(select sum(costo_total) as monto,factura 
from carga_combustible
where factura ='$factura' and empresa='$empresa' 
GROUP BY factura ) A 
ON A.factura=T.factura 
where T.factura ='$factura' and empresa='$empresa' order by fecha_carga desc";

$result=mysqli_query($con, $query) or die (mysqli_error());

echo "<table class='table table-hover table-sm table-bordered table-condensed' id='exportar'>
<thead class='thead-dark text-center'>

<tr>
<th colspan='7' scope='rowgroup' class='bg-info text-center'><h3>Reporte de Consumos de Gasolina </h3></th>
</tr>

<tr>
<th>Vehículo</th>
<th>Fecha de Carga</th>
<th>Rendimiento x km</th>
<th>Rendiemiento Real</th>
<th>Ticket</th>
<th>Factura</th>
<th>Monto Total</th>
</tr>
</thead>";

$total=0;
while ($row=mysqli_fetch_array($result))
{  
  $totalmonto=$total+$row[8];
  $empresa=$row[7];

  echo "<tbody class='text-center'>";    
	echo "<tr>";
    echo "<td>".$row[0]."</td>";	
	echo "<td>".$row[1]."</td>";
	echo "<td>".$row[2]."</td>";
	echo "<td>".$row[3]."</td>";
	echo "<td>".$row[4]."</td>";
	echo "<td>".$row[5]."</td>";
    echo "<td>".$row[6]."</td>";      		
	echo "</tr>";
  echo "</tbody>";

}

 echo "<tr>";
 echo "<th colspan='7' scope='rowgroup' class='bg-info text-center'></th>";
 echo "</tr>";

 echo "<tr>";
 echo"<th colspan='5' class='text-center'><h5>Empresa: $empresa</h5></th>";
 echo "<td colspan='1' class='text-center'>Total:</td>";
 echo "<td colspan='1' class='text-center'>$totalmonto</td>";  
 echo "</tr>";
 echo "</table>";

mysqli_query($con,$query) or die ("Problemas al llamar tabla".mysqli_error());
mysqli_close($con);
?>