<?php include 'menu.php';
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Búsqueda de Reporte Comparativo</title>
    
    <!--jquery librerias-->
    <script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="jquery/sweetalert2.min.js"></script>
    <script type="text/javascript" src="jquery/jquery.table2excel.min.js"></script> 
    <script type="text/javascript" src="charts/Chart.min.js"></script>  

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
    <link rel="stylesheet" type="text/css" href="charts/Chart.min.css">
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
<h3 align="center">Búsqueda de Reporte Comparativo
<i class="fa fa-search fa-2x"></i></h3> 
</div> 

<div style="margin: 20px;" class="oculto-impresion">
 <div class="text-center card-box text-white bg-dark">
  <legend>Reporte Comparativo de Ordenes de Servicio
    <img src="img/comparativa.png">
  </legend>

 <form class="container" id="reportecomparativo" method="POST">
  <div class="form-row">
  <div class="form-group col-md-2"></div>

   <div class="form-group col-md-4"> 
  <label for="">Número de Orden de Servicio</label>
  <div class="input-group mb-3">
  <div class="input-group-prepend">
  <button class="input-group-text btn btn-outline-success" type="button" onclick="muestradatos()"><i class="fa fa-search" style="color: #20c997;"></i></button>
  </div>
  <input type="text" class="form-control" name="numero_orden" id="numero_orden" placeholder="Búsqueda: OS123">
  </div>
  </div>

    <div class="form-group col-md-4">
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
    </div>
</div>

<hr>
<div class="form-row">
<div class="form-group col-md-3"></div>   
<div class="form-group col-md-2"> 
<button type="button" onclick="window.print();" class="btn btn-primary hvr-pop oculto-impresion" ><i class="fa fa-print"></i> Imprimir</button>
</div> 
<div class="form-group col-md-2">
<button type="button" class="btn btn-primary hvr-pop" id="excel"><i class="fa fa-cloud-download fa-fw"></i> Exportar a excel</button>
</div>
<div class="form-group col-md-2">
<button type="button" class="btn btn-info hvr-rotate" id="vergrafica">Ver Gráfica</button>  
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
<br>

<div class="container">
<canvas id="grafica"></canvas>
</div>

<script type="text/javascript">
function muestradatos(){

    var numero_orden = document.getElementById("numero_orden").value;
    var vehiculo = document.getElementById("vehiculo").value;  

    ObjetoAjax = new XMLHttpRequest();

    ObjetoAjax.open("POST", "scripts/tabla_reporte_comparativo.php", true);
    ObjetoAjax.onreadystatechange = procesaPeticion;

    ObjetoAjax.setRequestHeader("content-Type","application/x-www-form-urlencoded");

    parametro = "numero_orden=" + numero_orden +  "&vehiculo=" + vehiculo;

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
    filename: "Reporte de Comparativos",
    fileext: ".xls",
    preserveColors: true
  }); 
});

//codigo para generar la grafica///////////////////////////////////////////////////////
  $("#vergrafica").click(function(){      
            showGraph();
        });
        function showGraph()
        {
            {                 
                $.post("scripts/grafica_compartivo.php",$("#reportecomparativo").serialize(),function (data)
                {
                    //console.log(data);
                    var servicio = [];
                    var costo_unitario1 = [];
                    var costo_total1 = [];
                    var costo_unitario2 = [];
                    var costo_total2 = [];
                    var costo_unitario3 = [];
                    var costo_total3 = [];                   

                    for (var i in data) {
                        servicio.push(data[i].servicio);
                        costo_unitario1.push(data[i].costo_unitario1);
                        costo_total1.push(data[i].costo_total1);
                        costo_unitario2.push(data[i].costo_unitario2);
                        costo_total2.push(data[i].costo_total2);
                        costo_unitario3.push(data[i].costo_unitario3);
                        costo_total3.push(data[i].costo_total3);                        
                    }

                    var chartdata = {
                        labels: servicio,
                        datasets: [
                            {
                                label: 'Costo unitario1',
                                backgroundColor: '#212529',
                                borderColor: '#212529',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: costo_unitario1
                            },
                            {
                                label: 'Costo Total1',
                                backgroundColor: '#212529',
                                borderColor: '#212529',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: costo_total1
                            },
                              {
                                label: 'Costo Unitario2',
                                backgroundColor: '#ffc107',
                                borderColor: '#ffc107',
                                hoverBackgroundColor: '#FDFF8B',
                                hoverBorderColor: '#FDFF8B  ',
                                data: costo_unitario2
                            },
                              {
                                label: 'Costo Total2',
                                backgroundColor: '#ffc107',
                                borderColor: '#ffc107',
                                hoverBackgroundColor: '#FDFF8B',
                                hoverBorderColor: '#FDFF8B',
                                data: costo_total2
                            },
                            {
                                label: 'Costo Unitario3',
                                backgroundColor: '#28a745',
                                borderColor: '#28a745',
                                hoverBackgroundColor: '#80A98A',
                                hoverBorderColor: '#80A98A',
                                data: costo_unitario3
                            },
                            {
                                label: 'Costo total3',
                                backgroundColor: '#28a745',
                                borderColor: '#28a745',
                                hoverBackgroundColor: '#80A98A',
                                hoverBorderColor: '#80A98A',
                                data: costo_total3
                            }

                        ]
                    };

                    var graphTarget = $("#grafica");
                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
            }
        } 
</script>
</body>
</html>