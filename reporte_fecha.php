<?php include 'menu.php';
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Búsqueda de Reporte por fecha</title>
    
    <!--jquery librerias-->
    <script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="jquery/sweetalert2.min.js"></script>
    <script type="text/javascript" src="jquery/jquery.table2excel.min.js"></script>   

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
    <style type="text/css">
      @media print{
     .oculto-impresion, .oculto-impresion *{
      display: none !important;
      }
     }
    </style>       
  </head>

<body>
<!--codigo para la cabecera debajo del menu-->  
<div class="bg-info clearfix oculto-impresion">
<h3 align="center">Búsqueda de Reporte por fecha
<i class="fa fa-search fa-2x"></i></h3> 
</div> 

<div style="margin: 20px;" class="oculto-impresion">
 <div class="text-center card-box text-white bg-dark">
  <legend>Reporte por fecha
    <img src="img/fecha.png">
  </legend>

 <form class="container" id="reportefactura" method="POST">
  <div class="form-row">
   
 <div class="form-group col-md-4">
      <label for="">Fecha Inicio</label>
       <div class="input-group mb-3">
      <div class="input-group-prepend">
     <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
     </div>   
     <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
    </div>
 </div>

 <div class="form-group col-md-4">
      <label for="">Fecha Final</label>
       <div class="input-group mb-3">
      <div class="input-group-prepend">
     <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
     </div>   
     <input type="date" class="form-control" name="fecha_final" id="fecha_final">
    </div>
 </div>

   <div class="form-group col-md-4">
      <label for="">Empresa</label>
      <select name="empresa" id="empresa" class="form-control">
        <option value="">Seleccione...</option>
        <option value="csn">CSN</option>
        <option value="sea">SEA</option>
        <option value="cta">CTA</option>      
      </select>     
    </div>

</div>
<hr>
<div class="form-row">
<div class="form-group col-md-3"></div>  
<div class="form-group col-md-2">
<button type="button" class="btn btn-info hvr-pop" id="buscar" onclick="muestradatos()"><i class="fa fa-search"></i>  Buscar</button>
</div>
<div class="form-group col-md-2">     
<button type="button" class="btn btn-primary hvr-pop" id="excel"><i class="fa fa-cloud-download fa-fw"></i> Exportar a excel</button>
</div>
<div class="form-group col-md-2"> 
<button type="button" onclick="window.print();" class="btn btn-primary hvr-pop oculto-impresion" ><i class="fa fa-print"></i> Imprimir</button>
</div>
</div>
</form>
<hr>
<div class="text-left">
    </div>
   </div>
  </div> <!-- end card-box -->
<div class="container">
<div id="resultado" class="table-responsive"></div>
</div>

<script type="text/javascript">
function muestradatos(){

    var fecha_inicio = document.getElementById("fecha_inicio").value; 
    var fecha_final = document.getElementById("fecha_final").value; 
    var empresa = document.getElementById("empresa").value;

    ObjetoAjax = new XMLHttpRequest();

    ObjetoAjax.open("POST", "scripts/tabla_reporte_fecha.php", true);
    ObjetoAjax.onreadystatechange = procesaPeticion;

    ObjetoAjax.setRequestHeader("content-Type","application/x-www-form-urlencoded");

    parametro = "fecha_inicio=" + fecha_inicio +  "&fecha_final=" + fecha_final + "&empresa=" + empresa;

    ObjetoAjax.send(parametro);

    function procesaPeticion(){
      if (ObjetoAjax.readyState == 4 && ObjetoAjax.status==200) {

        var div = document.getElementById("resultado");
        div.innerHTML = ObjetoAjax.responseText;

      } 
    }
  }

//exportar a excel en esta ocacion se pone el id del div contenedor en vez del id de cada tabla
$("#excel").click(function(){
  $("#resultado").table2excel({
    name: "Hoja 1",
    filename: "Reporte por Fechas",
    fileext: ".xls",
    preserveColors: true
  }); 
});
</script>
</body>
</html>