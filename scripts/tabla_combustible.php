<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$query="SELECT  * FROM tipo_combustible";
$result=mysqli_query($con, $query) or die (mysqli_error());

echo "<table class='table table-hover table-sm table-bordered table-condensed'>
<thead class='thead-dark text-center'>
<tr>
<th>Tipos de combustible</th>
</tr>
</thead>";

while ($row=mysqli_fetch_array($result))
{   echo "<tbody class='text-center'>";
	echo "<tr>";
	echo "<td>".$row['tipo']."</td>";	
	echo "</tr>";
	echo "</tbody>";

}
echo "</table>";

mysqli_query($con,$query) or die ("Problemas al llamar tabla".mysqli_error());

mysqli_close($con);

?>