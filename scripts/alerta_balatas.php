<?php
$vehiculo=$_POST['vehiculo'];
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$query="SELECT  SUM(km_final) AS totalkilometros, vehiculo FROM carga_combustible WHERE vehiculo ='$vehiculo'";
$result=mysqli_query($con, $query) or die (mysqli_error());

 $total=0;
 while ($row=mysqli_fetch_array($result)){
 $totalkm=$total+$row[0];
 $auto=$row['vehiculo'];
 $t=$totalkm;//para poder mostar la cantidad de kilometraje sin modificar tal como se trae de la consulta y para hacer el mensaje de baja antes de completar los 3000km
}

//para comenzar a entrar al ciclo primero el kilometraje debe llegar a 3000km una vez que llegue se mete al ciclo,marcara la alerta "media" cuando por ejemplo sean 14,000km dira que supero los 12,000 y cuando ya diga 15,000 la alerta cambiara y dira que esta cerca de llegar a los 18,000.Cambia cada 3000km para decidir si es alta,media,baja.
   $excedido = 0;
    $mensaje;
    while($totalkm >= 6000){
      $excedido += 6000;
      $totalkm-= 6000;
    }
    $mensaje = "Superó los:<br>".$excedido."km";
    $prioridad ="Alta<img src='img/alerta_alta.png' style='width:40px'";
    $boton="<a href='reg_mantenimiento.php' class='btn btn-danger'><img src='img/mtto1.png' style='width:25px'></a>";

    if($totalkm >= 3000 && $totalkm < 6000){
        $excedido += 6000;
        $mensaje = "Esta por llegar a los:<br>".$excedido."km";
        $prioridad ="Media<img src='img/alerta_media.png' style='width:40px'>";
        $boton="<a href='reg_mantenimiento.php' class='btn btn-warning'><img src='img/mtto1.png' style='width:25px'></a>";
    } 

    if($t<=3000){
        $mensaje="Aún no necesita cambio de Balatas";
        $prioridad ="Baja<img src='img/alerta_baja.png' style='width:40px'";
        $boton="<a href='reg_mantenimiento.php' class='btn btn-info'><img src='img/mtto1.png' style='width:25px'></a>";
    }

echo "<div class='container'style='width:500px'>
<table class='table table-hover table-sm table-bordered table-condensed'>
<thead class='thead-dark text-center'>
<tr>
<th>Vehículo</th>
<th>Total de kilometraje</th>
<th>Mensaje de Alerta</th>
<th>Prioridad</th>
<th>Mantenimiento</th>
</tr>
</thead>
<tbody class='text-center'>
<tr>
<td>$auto</td>
<td>$t</td>
<td>$mensaje</td>
<td>$prioridad</td>
<td>$boton</td>
</tr>
</tbody>
</table>
</div>";
mysqli_close($con);
?>