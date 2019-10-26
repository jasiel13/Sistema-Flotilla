<?php
$vehiculo=$_POST['vehiculo'];
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());

$query="SELECT COUNT(*) AS total_mtto,vehiculo FROM mantenimiento WHERE tipo_mtto = 'preventivo' and vehiculo ='$vehiculo'";
$result=mysqli_query($con, $query) or die (mysqli_error());

 $total=0;
 while ($row=mysqli_fetch_array($result)){
 $total_mtto=$total+$row[0];
 $auto=$row['vehiculo'];
 $t=$total_mtto;//para poder mostar la cantidad de mantenimientos sin modificar tal como se trae de la consulta y para hacer el mensaje de baja antes de completar los 6mttos
}
//para comenzar a entrar al ciclo primero los mttos deben de llegar a 3 una vez que llegue se mete al ciclo,marcara la alerta "media" cuando por ejemplo sean 7 o 8 dira que supero los 6 mttos y cuando ya diga 9,10,11 la alerta cambiara y dira que esta cerca de llegar a los 12 mttos.Cambia cada 3 mttos para decidir si es alta,media,baja.
    $excedido = 0;
    $mensaje;
    while($total_mtto >= 6){
      $excedido += 6;
      $total_mtto-= 6;
    }
    $mensaje = "Superó los:<br>".$excedido."mtto´s";
    $prioridad = "<h7 style='color:#dc3545;'><strong>Alta: Necesita cambio de llantas</strong></h7>";
    $boton= "<a href='registrar_llantas.php' class='btn btn-danger'><img src='img/tire.png' style='width:25px'></a>";


    if($total_mtto >= 3 && $total_mtto <= 5){
        $excedido += 6;
        $mensaje = "Esta por llegar a los:<br>".$excedido."mtto´s";
        $prioridad="<h7 style='color:#ffc107;'><strong>Media: Próximo a cambio de llantas </strong></h7>";
        $boton="<a href='registrar_llantas.php' class='btn btn-warning'><img src='img/tire.png' style='width:25px'></a>";
         } 

    if($t<3){
    $mensaje="Aún no tiene suficientes mtto´s";
    $prioridad="<h7 style='color:#17a2b8;'><strong>Baja: Aún no necesita cambio de llantas</strong></h7>";
    $boton="<a href='registrar_llantas.php' class='btn btn-info'><img src='img/tire.png' style='width:25px'></a>";
    }

echo "<div class='container' style='width:500px'>
<table class='table table-hover table-sm table-bordered table-condensed'>
<thead class='thead-dark text-center'>
<tr>
<th>Vehículo</th>
<th>Total de Mtto's</th>
<th>Mensaje</th>
<th>Prioridad de cambio</th>
<th>Registar Cambio de Neumáticos</th>
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