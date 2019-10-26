<?php include 'menu.php';
error_reporting(0);
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Búsqueda de Reporte por factura</title>
    
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
<h3 align="center">Búsqueda de Reporte por factura
<i class="fa fa-search fa-2x"></i></h3> 
</div> 

<div style="margin: 20px;" class="oculto-impresion">
 <div class="text-center card-box text-white bg-dark">
  <legend>Reporte por factura
    <img src="img/factura.png">
  </legend>

 <form class="container" id="reportefactura" method="POST">
  <div class="form-row">
  <div class="form-group col-md-2"></div> 
   
  <div class="form-group col-md-4"> 
  <label for="">Número de Factura</label>
  <div class="input-group mb-3">
  <div class="input-group-prepend">
  <button class="input-group-text btn btn-outline-success" type="button" onclick="muestradatos()"><i class="fa fa-search" style="color: #20c997;"></i></button>
  </div>
  <input type="text" class="form-control" name="factura" id="factura" placeholder="Búsqueda: CD123">
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
<div class="form-group col-md-4"></div>   
<div class="form-group col-md-2"> 
<button type="button" onclick="window.print();" class="btn btn-primary hvr-pop oculto-impresion" ><i class="fa fa-print"></i> Imprimir</button>
</div> 
<div class="form-group col-md-2">
<button type="button" class="btn btn-primary hvr-pop" id="excel"><i class="fa fa-cloud-download fa-fw"></i> Exportar a excel</button>
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

    var factura = document.getElementById("factura").value; 
    var empresa = document.getElementById("empresa").value;

    ObjetoAjax = new XMLHttpRequest();

    ObjetoAjax.open("POST", "scripts/tabla_reporte_factura.php", true);
    ObjetoAjax.onreadystatechange = procesaPeticion;

    ObjetoAjax.setRequestHeader("content-Type","application/x-www-form-urlencoded");

    parametro = "factura=" + factura +  "&empresa=" + empresa;

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
    filename: "Reporte por Facturas",
    fileext: ".xls",
    preserveColors: true
  }); 
});
</script>
</body>
</html>