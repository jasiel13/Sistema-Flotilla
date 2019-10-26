<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Tabla de alertas de vencimiento del mtto</title>
    
    <!--jquery librerias-->
    <script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>  
    <script type="text/javascript" src="jquery/jquery.table2excel.min.js"></script>
    <script type="text/javascript" src="jquery/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="jquery/dataTables.bootstrap4.min.js"></script>
    
    <!--boostrap librerias-->
    <link rel="stylesheet" type="text/css" href="bootstrap_4.3.1/css/bootstrap.min.css"> 

    <!--librerias para crear efecto hover-->
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">     
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap_tables.css">   
  </head>
<body>

<!--codigo para generar la tabla de data-table-->
<div class="dataWrapper">
<table class="table table-hover table-sm table-bordered table-condensed" id="exportar">

<div class="form-row">
<div class="form-group col-md-3"></div>
<div class="form-group col-md-3">
<label for="">Fecha Inicio del Mtto</label>  
<input id="min" name="min" type="text" placeholder="Fecha iniciar busqueda" class="form-control">
</div>
<div class="form-group col-md-3"> 
<label for="">Fecha Inicio del Mtto(cerrar rango)</label>  
<input id="max" name="max" type="text" placeholder="Fecha cerrar busqueda" class="form-control">
</div> 
</div>	

<thead class="thead-dark text-center">
<tr>
<th>ID_mtto</th>	
<th>Vehículo</th>
<th>Servicio</th>
<th>Tipo_Mtto</th>
<th>Observaciones</th>
<th>Fecha Inicio</th>
<th>Fecha Final</th>
<th>Vencimiento</th>
<th>Generar Alerta</th>
</tr>
</thead>
<tbody>
<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
$query="SELECT id_mtto,vehiculo,servicio,tipo_mtto,observaciones,fecha_inicio,fecha_final FROM mantenimiento ORDER BY id_mtto DESC";
$result=mysqli_query($con, $query) or die (mysqli_error());

  date_default_timezone_set('America/Mexico_City'); 
  $fecha_actual = new DateTime(date('Y-m-d'));//nueva variable para vencimiento//

  while ($row=mysqli_fetch_array($result)){ 

  $fecha_final = new DateTime($row['fecha_final']);
  $dias = $fecha_actual->diff($fecha_final)->format('%r%a');

// Si la fecha final es igual a la fecha actual o anterior

if ($dias <= 0) {
  $status= "<h6 class='text-danger''><img src='img/alerta_alta.png' style='width:25px'>Mantenimiento Vencido</h6>";
} elseif ($dias == 1) {
  $status= "<h6 class='text-warning'><img src='img/alerta_media.png' style='width:25px'>Mañana vence</h6>";
} elseif ($dias <= 2) {
  $status= "<h6 class='text-info'><img src='img/alerta_baja.png' style='width:25px'>Está a " . $dias . " días de vencer</h6>";
} else {
  $status= "<h6 class='text-success'>Aún quedan días para vencer</h6>";
}

$datos=$row['id_mtto']."||".
$row['vehiculo']."||".
$row['servicio']."||".
$row['tipo_mtto']."||".
$row['observaciones']."||".
$row['fecha_inicio']."||".
$row['fecha_final'];
?>
  <tr> 
    <td class="text-center"><?php echo$row['id_mtto']?></td>  
    <td class="text-center"><?php echo$row['vehiculo']?></td>
    <td class="text-center"><?php echo$row['servicio']?></td>
    <td class="text-center"><?php echo$row['tipo_mtto']?></td>
    <td><?php echo$row['observaciones']?></td>
    <td class="text-center"><?php echo$row['fecha_inicio']?></td>
    <td class="text-center"><?php echo$row['fecha_final']?></td>
    <td class="text-center">
    <?php echo $status?>
    </td>
    <td class="text-center">
    <button class="btn btn-warning fa fa-bell" onclick="enviar('<?php echo $row['id_mtto']?>')"></button>
    </td>   
  </tr>  
<?php
 }
mysqli_query($con,$query) or die ("Problemas al llamar tabla".mysqli_error());
mysqli_close($con);
?>
</tbody>
</table>
</div>
<!--codigo para generar la tabla de data-table-->

<script type="text/javascript">
//CODIGO PARA EJECUTAR LA TABLA CON EL PLUGIN DATA-TABLE  
  $(document).ready( function () {
    $('#exportar').DataTable();
} );

$( ()=> {
  $('#exportar').DataTable();
  $(document).on('click', '#btn', function(){

  if( !$('.dataWrapper').is(':visible') ) {
    $('.dataWrapper').show();
  } else {
    $('.dataWrapper').hide();
  }
  });
});

//rango de fechas
$(document).ready(function() {  
    var table = $('#exportar').DataTable();
    $('#min,#max').keyup( function() {
        table.draw();
    });
});

$.fn.dataTable.ext.search.push(
    function( oSettings, aData, iDataIndex ) {

        var dateIni = $('#min').val();
        var dateFin = $('#max').val();

        var indexCol = 5;

        dateIni = dateIni.replace(/-/g, "");
        dateFin= dateFin.replace(/-/g, "");

        var datofini = aData[indexCol].replace(/-/g, "");

        if (dateIni === "" && dateFin === "")
        {
            return true;
        }

        if(dateIni === "")
        {
            return datofini <= dateFin;
        }

        if(dateFin === "")
        {
            return datofini >= dateIni;
        }

        return datofini >= dateIni && datofini <= dateFin;
    }
);
//rango de fechas

//ENVIAR DATOS
function enviar(id){  
  $.ajax({
      url : 'enviar-correo-mttoalerta.php',
      data : { id : id },
      type : 'POST',
      success : function(res) {
         if(res == 1){
                     //alert("Fallo al agregar");
                  Swal.fire({
                   type: 'error',
                   title: 'Oops...',
                   text: 'Fallo al enviar',                  
                   });
                } else {
                    //alert("Vehículo agregado con éxito!!");
                    Swal.fire({
                     position:'center',
                     type: 'success',
                     title: 'Alerta generada y enviada al correo!!',
                     showConfirmButton: false,
                     timer: 1500
                     });                   
                }                        
              }
            });    
          }

//exportar a excel
$("#excel").click(function(){
  $("#exportar").table2excel({
    name: "Hoja 1",
    filename: "Mantenimientos vencidos",
    fileext: ".xls",
    preserveColors: true
  }); 
});
</script>	
</body>
</html>