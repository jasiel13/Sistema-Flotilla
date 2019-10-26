<?php include 'menu.php';
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Búsqueda de checklist mantenimiento</title>
    
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
  </head>

<body>
<button type="button" class="btn btn-info btn-circle up" style="position: fixed;
  bottom:20px; right:20px; display:none;"><i class="fa fa-arrow-up"></i></button>  
<!--codigo para la cabecera debajo del menu-->  
<div class="bg-info clearfix">
<h3 align="center">Buscar Checklist Previo a Mantenimiento
<i class="fa fa-search fa-2x"></i></h3> 
</div> 

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Revisión de Vehículo Entre los Lapsos de Tiempo & Kilometraje para Mantenimiento
    <img src="img/checklist.png">
  </legend>

 <form class="container" id="frmcheckbuscar" method="POST">
  <div class="form-row">
    <div class="form-group col-md-4"></div>
     
    <!--es un selec que hace lo mismo que el input funcional de abajo pero me parecio mejor alternativa que el select--> 
    <!--<div class="form-group col-md-4">      
    <label for="">Número de checklist</label>   
    <select  name="numero" id="numero" class="form-control" onclick="muestradatos()">
        <option value="">Seleccione...</option>
        <?php
            //$query="SELECT  * FROM checklist_revision";
            //$result=mysqli_query($con, $query) or die (mysqli_error());
            //while ($row=mysqli_fetch_array($result)){ 
            //echo '<option value="'.$row['numero_check'].'">'.$row['numero_check'].'</option>';
          //}
        ?>
      </select>    
    </div> -->

  <div class="form-group col-md-4"> 
  <label for="">Número de checklist</label>
  <div class="input-group mb-3">
  <div class="input-group-prepend">
  <button class="input-group-text btn btn-outline-success" type="button" onclick="muestradatos()"><i class="fa fa-search" style="color: #20c997;"></i></button>
  </div>
  <input type="text" class="form-control" name="numero" id="numero" placeholder="Búsqueda: 123">
  </div>
  </div>

</div>
<hr>
<div class="form-row">
<div class="form-group col-md-12">      
<button type="button" class="btn btn-primary hvr-pop" id="excel"><i class="fa fa-cloud-download fa-fw"></i> Exportar a excel</button>
<button type="button" class="btn btn-info hvr-pop" onclick="location.href='checklist_mtto.php'">Checklist Mtto
</button>
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

    var numero = document.getElementById("numero").value;  

    ObjetoAjax = new XMLHttpRequest();

    ObjetoAjax.open("POST", "scripts/tabla_ver_checklist_mtto.php", true);
    ObjetoAjax.onreadystatechange = procesaPeticion;

    ObjetoAjax.setRequestHeader("content-Type","application/x-www-form-urlencoded");

    parametro = "numero=" + numero;

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
    filename: "Checklist_Mtto",
    fileext: ".xls",
    preserveColors: true
  }); 
});

//codigo para el boton de desplazar pagina hacia arriba
$(document).ready(function(){ 
  $('.up').click(function(){
    $('body, html').animate({
      scrollTop: '0px'
    }, 300);
  });
 
  $(window).scroll(function(){
    if( $(this).scrollTop() > 0 ){
      $('.up').slideDown(300);
    } else {
      $('.ir-up').slideUp(300);
    }
  });
 
});
</script>
</body>
</html>