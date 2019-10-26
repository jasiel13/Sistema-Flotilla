<?php include 'menu.php';
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Alerta de Neumáticos</title>
	
    <!--jquery librerias-->
    <script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="jquery/sweetalert2.min.js"></script>
    <script type="text/javascript" src="jquery/jquery.table2excel.min.js"></script>
    <script type="text/javascript" src="jquery/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="jquery/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="jquery/push.min.js"></script>

    <!--boostrap librerias-->
    <link rel="stylesheet" type="text/css" href="bootstrap_4.3.1/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap_4.3.1/js/popper.min.js"></script> 

    <!--librerias para crear animaciones-->
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <script type="text/javascript" src="wowjs/wow.min.js"></script>
    <script type="text/javascript">new WOW().init();</script> 

    <!--librerias para crear efecto hover-->
    <link rel="stylesheet" type="text/css" href="Hover/css/hover-min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="css/error.css">
    <link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="css/boton.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap_tables.css">
  </head>
  <body>

<div class="bg-info clearfix">
<h3 align="center">Alertas de Cambio de Neumáticos
<i class="fa fa-bell fa-2x"></i></h3> 
</div>

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Alertas de Cambio de Neumáticos
  <img src="img/llanta.png">
  </legend>


<form class="container" id="alertallanta" method="POST">
 <div class="form-row">
  <div class="form-group col-md-3">
  </div>
 <div class="form-group col-md-6">
 <label for="">Vehículo</label>
       
       <select  name="vehiculo" id="vehiculo" class="form-control">
        <option value="">Seleccione...</option>
        <?php

            $query="SELECT  * FROM vehiculo";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 

            echo '<option value="'.$row['vehiculo'].'">'.$row['vehiculo'].'</option>';
          }
        ?>
      </select>
      <p id="ms" style="display:none" class="error">Seleccione el Vehículo</p>      
     </div> 
   <div class="form-group col-md-3">
  </div>
 </div>

 <div class="form-row">
 <div class="form-group col-md-2">
 </div> 
 <div class="form-group col-md-4"> 
 <button type="button" id="btnguardar" class="btn btn-warning hvr-rotate">Enviar</button>
</div>
<div class="form-group col-md-4">
<button type="button" id="btngenerar" class="btn btn-warning hvr-sink targetet" style="display:none">
<i class="fa fa-bell"></i>
 Generar Alerta</button> 
<button type="button" onclick="location.href='registrar_llantas.php'" class="btn btn-info hvr-sink">
Registrar Neumáticos   
</button>
 </div>
  <div class="form-group col-md-12">  
  <button class="btn btn-primary hvr-pop" type="button" id="btn">Ocultar Tabla</button>
 <button type="button" class="btn btn-primary hvr-pop" id="excel"><i class="fa fa-cloud-download fa-fw"></i>  Exportar a excel</button>
 </div> 
</div>
</div>
</form>
<div class="text-left">
    </div>
   </div>
  </div> <!-- end card-box -->

<div id="resp"></div>
<br>

<!--codigo para generar la tabla de data-table-->
<div class="dataWrapper">
<table class="table table-hover table-sm table-bordered table-condensed" id="exportar"> 
<div class="form-row">
<div class="form-group col-md-3"></div>
<div class="form-group col-md-3">
<label for="">Fecha de Registro</label>  
<input id="min" name="min" type="text" placeholder="Fecha iniciar busqueda" class="form-control">
</div>
<div class="form-group col-md-3"> 
<label for="">Fecha de Registro(cerrar rango)</label>  
<input id="max" name="max" type="text" placeholder="Fecha cerrar busqueda" class="form-control">
</div> 
</div>  
<caption class="bg-dark text-center text-white">Esta tabla indica la fecha estimada para cambio de llantas de los vehículos</caption>
<thead class="thead-dark text-center"> 
<tr>
<th>ID</th>  
<th>Vehículo</th>
<th>Num_serie</th>
<th>Fecha de Registro</th>
<th>Marca</th>
<th>Cantidad</th>
<th>Costo Unitario</th>
<th>Costo Total</th>
<th>Kilometraje</th>
<th>Próximo Kilometraje</th>
<th>Próximo Cambio de Llantas</th>
<th>Vencimiento</th>
<th>Revisar Alerta de Cambio</th>
</tr>
</thead>
<tbody>
<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
$query="select id_llantas,vehiculo,num_serie,fecha,marca,cantidad,costo_unitario,costo_total,kilometraje,proximo_kilometraje,proximo_cambio from llantas order by id_llantas desc";
$result=mysqli_query($con, $query) or die (mysqli_error());

date_default_timezone_set('America/Mexico_City');
$fecha_actual = new DateTime(date('Y-m-d'));//nueva variable para vencimiento//

while ($row=mysqli_fetch_array($result)){ 

$proximo_cambio = new DateTime($row['proximo_cambio']);
$dias = $fecha_actual->diff($proximo_cambio)->format('%r%a');

if ($dias <= 0) {
  $status= "<h6 class='text-danger''><img src='img/alerta_alta.png' style='width:25px'>Cambio de llantas vencido</h6>";
} elseif ($dias == 1) {
  $status= "<h6 class='text-warning'><img src='img/alerta_media.png' style='width:25px'>Mañana vence</h6>";
} elseif ($dias <= 15) {
  $status= "<h6 class='text-info'><img src='img/alerta_baja.png' style='width:25px'>Está a " . $dias . " días de vencer</h6>";
} elseif ($dias <= 30) {
  $status= "<h6 class='text-info'><img src='img/alerta_baja.png' style='width:25px'>Está a " . $dias . " días de vencer</h6>";
}else {
  $status= "<h6 class='text-success'>Aún quedan días para vencer</h6>";
}

$datos=$row['id_llantas']."||".
$row['vehiculo']."||".
$row['num_serie']."||".
$row['fecha']."||".
$row['marca']."||".
$row['cantidad']."||".
$row['costo_unitario']."||".
$row['costo_total']."||".
$row['kilometraje']."||".
$row['proximo_kilometraje']."||".
$row['proximo_cambio'];

?>
  <tr> 
    <td class="text-center"><?php echo$row['id_llantas']?></td>  
    <td class="text-center"><?php echo$row['vehiculo']?></td>
    <td class="text-center"><?php echo$row['num_serie']?></td>
    <td class="text-center"><?php echo$row['fecha']?></td>
    <td class="text-center"><?php echo$row['marca']?></td>
    <td class="text-center"><?php echo$row['cantidad']?></td>
    <td class="text-center"><?php echo$row['costo_unitario']?></td>
    <td class="text-center"><?php echo$row['costo_total']?></td>
    <td class="text-center"><?php echo$row['kilometraje']?></td>
    <td class="text-center"><?php echo$row['proximo_kilometraje']?></td>
    <td class="text-center"><h6 style="color:#CD5C5C;"><strong><?php echo$row['proximo_cambio']?></strong></h6></td>       
    <td class="text-center">
    <?php echo $status?>
    </td>
    <td class="text-center">
    <button class="btn btn-outline-warning fa fa-bell fa fa-eye selectoption"><i class="fa fa-eye"></i></button>
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
 function validaForm(){
 
    if($("#vehiculo").val() == ""){

        $("#ms").delay(100).fadeIn("slow");
        $("#vehiculo").focus();// Esta función coloca el foco de escritura del usuario en el campo 
        return false;
    }
    else
    {
      $("#ms").fadeOut();      
    } 
   return true; 
}
 $(document).ready( function(){ 
  $("#btnguardar").click(function(){
   if(validaForm()){ 
    $.ajax({                        
       type: "POST",                 
       url: "scripts/alerta_llantas.php",                    
       data: $("#alertallanta").serialize(),
       success: function(data)            
       {
       $('#resp').html(data);           
       }
       });   
      }
    });   
  });


 $(document).ready( function(){ 
  $("#btngenerar").click(function(){
   $.post("enviar-correo-llantas.php",$("#alertallanta").serialize(),function(res){
 
                if(res == 1){
                     //alert("Fallo al agregar");
                  Swal.fire({
                   type: 'error',
                   title: 'Oops...',
                   text: 'Fallo al generar',                  
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
                    document.getElementById("alertallanta").reset();//codigo para limpiar datos del form
                }
            });  
          });   
       });


//Boton para ocultar elementos y mostrar otros
function validaForm2(){ 
    if($("#vehiculo").val() == ""){

        $("#ms").delay(100).fadeIn("slow");
        $("#vehiculo").focus();
        return false;
    }
    else
    {
      $("#ms").fadeOut();      
    } 
   return true; 
}
 
     $(document).on('click', '#btnguardar', function(){ 
     if(validaForm2()){    
        if(!$('.targetet').is(':visible') ) {
          $('.targetet').show();

        }
        else
        { 
          $('.targetet').show();

        }
      }       
   });  

 $(document).on('click', '#btngenerar', function(){  
  if(!$('.targetet').is(':visible') ) {
          $('.targetet').show();

        }
        else
        { 
          $('.targetet').hide();

        }
  }); 


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

        var indexCol = 3;

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

//exportar a excel
$("#excel").click(function(){
  $("#exportar").table2excel({
    name: "Hoja 1",
    filename: "Registro de Cambio de Neumáticos",
    fileext: ".xls",
    preserveColors: true
  }); 
});

//mandar el nombre del vehiculo al input del vehiculo
$(document).ready(function() {
      $(".selectoption").click(function() {
        var auto = $(this).parents("tr").find("td")[1].innerHTML;
        //console.log(auto);
        $('#vehiculo').val(auto);
        });
    });
</script>
</body>
</html>