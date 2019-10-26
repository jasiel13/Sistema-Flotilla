<?php include 'menu.php';
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Alerta de Balatas</title>
	
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
<h3 align="center">Alertas de Cambio de Balatas
<i class="fa fa-bell fa-2x"></i></h3> 
</div>

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Alertas de Cambio de Balatas
  <img src="img/llanta.png">
  </legend>


<form class="container" id="alertabalatas" method="POST">
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
<button type="button" onclick="location.href='reg_cambio_balatas.php'" class="btn btn-info hvr-sink">
Registrar Balatas   
</button>
 </div>
</div>
</form>
<div class="text-left">
    </div>
   </div>
  </div> <!-- end card-box -->

<div id="resp"></div>
<br>


<script type="text/javascript">
 function validaForm(){
 
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
 $(document).ready( function(){ 
  $("#btnguardar").click(function(){
   if(validaForm()){ 
    $.ajax({                        
       type: "POST",                 
       url: "scripts/alerta_balatas.php",                    
       data: $("#alertabalatas").serialize(),
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
   $.post("enviar-correo-balatas.php",$("#alertabalatas").serialize(),function(res){
 
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
                    document.getElementById("alertabalatas").reset();//codigo para limpiar datos del form
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
</script>
</body>
</html>