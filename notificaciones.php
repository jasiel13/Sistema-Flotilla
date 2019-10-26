<?php include 'menu.php';
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Notificaciones</title>
	
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
<h3 align="center">Alertas
<i class="fa fa-bell fa-2x"></i></h3> 
</div>

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Alertas de Mantenimiento
  <img src="img/alerta_media.png">
  </legend>


<form class="container" id="mtto" method="POST">
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
<button type="button" onclick="location.href='alertas_mtto_ven.php'" class="btn btn-info hvr-sink">
 Alertas Mtto. a vencer   
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
<label for="">Fecha Final del Mtto</label>  
<input id="min" name="min" type="text" placeholder="Fecha iniciar busqueda" class="form-control">
</div>
<div class="form-group col-md-3"> 
<label for="">Fecha Final del Mtto(cerrar rango)</label>  
<input id="max" name="max" type="text" placeholder="Fecha cerrar busqueda" class="form-control">
</div> 
</div>  
<caption class="bg-dark text-center text-white">Esta tabla indica cual vehículo esta cerca de alcanzar mantenimineto por kilometraje & también indica el mtto. por fecha</caption>
<thead class="thead-dark text-center"> 
<tr>
<th>ID_mtto</th>  
<th>Vehículo</th>
<th>Servicio</th>
<th>Frecuencia del servicio x Km</th>
<th>Tipo_Mtto</th>
<th>Fecha Final del Mtto</th>
<th>Fecha del próximo Mantenimiento</th>
<th>Vencimiento</th>
<th>Revisar alerta x Kilometraje</th>
</tr>
</thead>
<tbody>
<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
$query="select m.id_mtto,m.vehiculo,m.servicio,m.tipo_mtto,m.fecha_final,t.kilometraje from mantenimiento m inner join tipos_servicios t on m.servicio= t.tipo_servicio where m.servicio = t.tipo_servicio order by id_mtto desc";
$result=mysqli_query($con, $query) or die (mysqli_error());

  date_default_timezone_set('America/Mexico_City'); 

  while ($row=mysqli_fetch_array($result)){
//codigo para generar la fecha del proximo mantenimiento
  $kilometraje=$row['kilometraje'];
  $fecha_final=$row['fecha_final'];

    if($kilometraje==10000){
    $f=date($fecha_final);
    $fecha_proximo=date('Y-m-d', strtotime($f.' +6 month'));    
    }
    elseif($kilometraje==5000){
    $f=date($fecha_final);
    $fecha_proximo=date('Y-m-d', strtotime($f.' +3 month')); 
    }  
//codigo para generar la fecha del proximo mantenimiento

$fecha_final1 = new DateTime($fecha_final);
$fecha_proximomtto = new DateTime($fecha_proximo);
$dias = $fecha_final1->diff($fecha_proximomtto)->format('%r%a'); 

//Si la fecha final es igual a la fecha actual o anterior
if ($dias <= 0) {
  $status= "<h6 class='text-danger''><img src='img/alerta_alta.png' style='width:25px'>Mantenimiento Vencido</h6>";
} elseif ($dias == 15) {
  $status= "<h6 class='text-warning'><img src='img/alerta_media.png' style='width:25px'>Está a " . $dias . " días de vencer</h6>";
} elseif ($dias <= 30) {
  $status= "<h6 class='text-info'><img src='img/alerta_baja.png' style='width:25px'>Está a " . $dias . " días de vencer</h6>";
} else {
  $status= "<h6 class='text-success'>Aún quedan días para vencer</h6>";
}

$datos=$row['id_mtto']."||".
$row['vehiculo']."||".
$row['servicio']."||".
$row['kilometraje']."||".
$row['tipo_mtto']."||".
$row['fecha_final']."||".
$row['fecha_final'];
?>
  <tr> 
    <td class="text-center"><?php echo$row['id_mtto']?></td>  
    <td class="text-center"><?php echo$row['vehiculo']?></td>
    <td class="text-center"><?php echo$row['servicio']?></td>
    <td class="text-center"><?php echo$row['kilometraje']?></td>
    <td class="text-center"><?php echo$row['tipo_mtto']?></td>
    <td class="text-center"><?php echo$row['fecha_final']?></td>
     <td class="text-center">
    <?php echo $fecha_proximo?>  
    <button class="btn btn-outline-dark btn-sm fa fa-pencil agregarfecha"></button>    
    </td>      
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
       url: "scripts/not2.php",                    
       data: $("#mtto").serialize(),
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
   $.post("enviar-correo-alerta.php",$("#mtto").serialize(),function(res){
 
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
                    document.getElementById("mtto").reset();//codigo para limpiar datos del form
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

//exportar a excel
$("#excel").click(function(){
  $("#exportar").table2excel({
    name: "Hoja 1",
    filename: "Mantenimientos vencidos por fechas",
    fileext: ".xls",
    preserveColors: true
  }); 
});


//codigo para actualizar la fecha seleccionandola de la tabla html e insertandola en la bd el campo servicio de la bd de la tabla mantenimiento se puso en nulo=si
$(document).ready(function() {
$(".agregarfecha").click(function() {
  var  fecha_prox_mtto = $(this).parents("tr").find("td")[6].innerHTML;
  var id = $(this).parents("tr").find("td")[0].innerHTML;

  //este codigo si funciona muy muy bien pero con seleccion por td y no por boton
  //var fecha_prox_mtto = $(this).find("td:eq(6)").text();
  //var id = $(this).find("td:eq(0)").text();


  //este codigo funciona pero solo te recoje el mismo dato siempre
  //var fecha_prox_mtto=document.getElementsByTagName("td")[6].innerHTML;
  //var id=document.getElementsByTagName("td")[0].innerHTML;

  //codigo para realizar purbas en consola
  //console.log(fecha_prox_mtto);
  //alert(fecha_prox_mtto); 
   $.ajax({
            type: "POST",
            url: "scripts/reg_fechadelproximomtto.php",
            data: {fecha_prox_mtto:fecha_prox_mtto,id:id},
            success: function(data){
            //console.log(data); 
            if(data == 1){                    
                  Swal.fire({
                   type: 'error',
                   title: 'Oops...',
                   text: 'Fallo al agregar',                  
                   });
                } else {                   
                    Swal.fire({
                     position:'center',
                     type: 'success',
                     title:'Fecha del próximo Mtto. agregada con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });                  
                }
              }
          });
      });
 });

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