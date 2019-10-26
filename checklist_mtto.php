<?php include 'menu.php';
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Revision de vehículo para mantenimiento checklist</title>
    
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
  bottom:40px; right:40px; display:none;"><i class="fa fa-arrow-up"></i></button>  
<!--codigo para la cabecera debajo del menu-->  
<div class="bg-info clearfix">
<h3 align="center">Checklist 
<i class="fa fa-clipboard fa-2x"></i></h3> 
</div> 

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Revisión Previa a los Mantenimientos
    <img src="img/checklist.png">
  </legend>

 <form class="container" id="checkmtto" method="POST">
  <div class="form-row">
  <div class="form-group col-md-3">
  <label for="">Número de checklist</label>
  <input type="text" class="form-control" name="numero" id="numero" placeholder="123">
  <p id="m" style="display:none" class="error">El campo número de checklist no puede estar vacío</p>
  </div>

    <div class="form-group col-md-3">      
    <label for="">Responsable de Unidad</label>   
    <select  name="conductor" id="conductor" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM conductor";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['nombre'].'">'.$row['nombre'].'</option>';
          }
        ?>
      </select>
    <p id="ms" style="display:none" class="error">El campo responsable de unidad no puede estar vacío</p>
    </div> 

    <div class="form-group col-md-3">      
    <label for="">Unidad en Revisión</label>   
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
    <p id="ms1" style="display:none" class="error">El campo unidad de revisión no puede estar vacío</p>
    </div>    
  
    <div class="form-group col-md-3">
      <label for="">Kilometraje</label>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">KM</span>
    </div>
      <input type="text" class="form-control numerico" name="kilometraje" id="kilometraje">
    </div>
  <p id="ms2" style="display:none" class="error">El campo kilometraje no puede estar vacío</p> 
     </div>
</div>

<div class="form-row">
<div class="form-group col-md-2"></div>

<div class="form-group col-md-4">
      <label for="">Fecha de Revisión</label>
       <div class="input-group mb-3">
      <div class="input-group-prepend">
     <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
     </div>      
     <input type="date" class="form-control" name="fecha_revision" id="fecha_revision">
    </div>  
    <p id="ms3" style="display:none" class="error">El campo fecha revisión no puede estar vacío</p> 
   </div>

<div class="form-group col-md-4">
<label for="">Hora de Revisión</label>
<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"><i class="fa fa-hourglass"></i></span>
</div>
<input type="time" class="form-control" name="hora_revision" id="hora_revision">
</div>
<p id="ms4" style="display:none" class="error">El campo hora revisión no puede estar vacío</p> 
</div> 
</div>

<h6>Tabla del Estado Diagnóstico del Vehículo</h6>
<hr style="border:1px dotted white;">

<div class="form-row">
<div class="container">
<table class="table bg-light table-sm table-bordered table-condensed table-hover">
<thead class="thead bg-warning text-center"> 
  <tr>
    <th>Descripción</th>   
    <th>Estado</th>   
  </tr>
  <tr>
 </thead> 
 <tbody class="text-center" >

<tr>
<td><label><h6>Luces Delanteras Baja</h6></label>  
</td>  
<td>    
<label class="radio-inline">
<input type="radio" name="luces_delanteras_baja" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="luces_delanteras_baja" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline">
<input type="radio" name="luces_delanteras_baja" class="form-input" value="malo">Malo<br>
</label>
  </td>
</tr>

<tr>
<td><label><h6>Luces Delanteras Alta</h6></label>  </td>
<td>
<label class="radio-inline">
<input type="radio" name="luces_delanteras_alta" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="luces_delanteras_alta" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline">
<input type="radio" name="luces_delanteras_alta" class="form-input" value="malo">Malo<br>
</label>
  </td>
</tr>

<tr>
<td><label><h6>Luces Traseras</h6></label>  </td>
<td>
<label class="radio-inline">
<input type="radio" name="luces_traseras" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="luces_traseras" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline">
<input type="radio" name="luces_traseras" class="form-input" value="malo">Malo<br>
</label> 
  </td>
</tr>

<tr>
<td><label><h6>Luces de Freno</h6></label></td>
<td>
<label class="radio-inline">
<input type="radio" name="luces_freno" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="luces_freno" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="luces_freno" class="form-input" value="malo">Malo<br>
</label>
</td>
</tr>

<tr>
<td><label><h6>Luces de Cruce Delantera</h6></label></td>
<td>
<label class="radio-inline">
<input type="radio" name="luces_cruce_delantera" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="luces_cruce_delantera" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="luces_cruce_delantera" class="form-input" value="malo">Malo<br>
</label>
</td>
</tr>

<tr>
<td><label><h6>Luces de Cruce Trasera</h6></label></td>
<td>
<label class="radio-inline">
<input type="radio" name="luces_cruce_trasera" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="luces_cruce_trasera" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="luces_cruce_trasera" class="form-input" value="malo">Malo<br>
</label>
</td>
</tr>

<tr>
<td><label><h6>Luces Intermitentes Delanteras</h6></label></td>
<td>
<label class="radio-inline">
<input type="radio" name="intermitentes_delanteras" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="intermitentes_delanteras" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="intermitentes_delanteras" class="form-input" value="malo">Malo<br>
</label>
</td>
</tr>

<tr>
<td><label><h6>Luces Intermitentes Traseras</h6></label></td>
<td>
<label class="radio-inline">
<input type="radio" name="intermitentes_trasera" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="intermitentes_trasera" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="intermitentes_trasera" class="form-input" value="malo">Malo<br>
</label>
</td>
</tr>

<tr>
<td><label><h6>Aceite de Transmisión</h6></label></td>  
<td>  
<label class="radio-inline">
<input type="radio" name="aceite_transmision" class="form-input" value="min"> Min<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="aceite_transmision" class="form-input" value="med"> Med<br>
</label>
<label class="radio-inline">
<input type="radio" name="aceite_transmision" class="form-input" value="max"> Max<br>
</label>
</td>
</tr>

<tr>
<td><label><h6>Aceite de Motor</h6></label></td>  
<td>  
<label class="radio-inline">
<input type="radio" name="aceite_motor" class="form-input" value="min"> Min<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="aceite_motor" class="form-input" value="med"> Med<br>
</label>
<label class="radio-inline">
<input type="radio" name="aceite_motor" class="form-input" value="max"> Max<br>
</label>
</td>
</tr>

<tr>
<td><label><h6>Aceite de Dirección</h6></label></td>  
<td>  
<label class="radio-inline">
<input type="radio" name="aceite_direccion" class="form-input" value="min"> Min<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="aceite_direccion" class="form-input" value="med"> Med<br>
</label>
<label class="radio-inline">
<input type="radio" name="aceite_direccion" class="form-input" value="max"> Max<br>
</label>
</td>
</tr>

<tr>
<td><label><h6>Refrigerante</h6></label></td>  
<td>  
<label class="radio-inline">
<input type="radio" name="refrigerante" class="form-input" value="min"> Min<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="refrigerante" class="form-input" value="med"> Med<br>
</label>
<label class="radio-inline">
<input type="radio" name="refrigerante" class="form-input" value="max"> Max<br>
</label>
</td>
</tr>

<tr>
<td><label><h6>Radiador</h6></label></td>
<td>
<label class="radio-inline">
<input type="radio" name="radiador" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="radiador" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="radiador" class="form-input" value="malo">Malo<br>
</label>
</td>
</tr>

<tr>
<td><label><h6>Liga de Freno</h6></label></td>
<td>
<label class="radio-inline">
<input type="radio" name="liga_freno" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="liga_freno" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="liga_freno" class="form-input" value="malo">Malo<br>
</label>
</td>
</tr>

<tr>
<td><label><h6>Indicador de Combustible</h6></label></td>
<td>
<label class="radio-inline">
<input type="radio" name="indicador_combustible" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="indicador_combustible" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="indicador_combustible" class="form-input" value="malo">Malo<br>
</label>
</td>
</tr>


<tr>
<td><label><h6>Indicador de Temperatura</h6></label></td>
<td>
<label class="radio-inline">
<input type="radio" name="indicador_temperatura" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="indicador_temperatura" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="indicador_temperatura" class="form-input" value="malo">Malo<br>
</label>
</td>
</tr>


<tr>
<td><label><h6>Indicador de Presion de Aceite</h6></label></td>
<td>
<label class="radio-inline">
<input type="radio" name="indicador_presion" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="indicador_presion" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="indicador_presion" class="form-input" value="malo">Malo<br>
</label>
</td>
</tr>

<tr>
<td><label><h6>Bocina</h6></label></td>
<td>
<label class="radio-inline">
<input type="radio" name="bocina" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="bocina" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="bocina" class="form-input" value="malo">Malo<br>
</label>
</td>
</tr><tr>
<td><label><h6>Alarma</h6></label></td>
<td>
<label class="radio-inline">
<input type="radio" name="alarma" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="alarma" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="alarma" class="form-input" value="malo">Malo<br>
</label>
</td>
</tr>

<tr>
<td><label><h6>Gato Hidráulico</h6></label></td>
<td>
<label class="radio-inline">
<input type="radio" name="gato_hidraulico" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="gato_hidraulico" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="gato_hidraulico" class="form-input" value="malo">Malo<br>
</label>
</td>
</tr>

<tr>
<td><label><h6>Retrovisores</h6></label></td>
<td>
<label class="radio-inline">
<input type="radio" name="retrovisores" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="retrovisores" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="retrovisores" class="form-input" value="malo">Malo<br>
</label>
</td>
</tr>

<tr>
<td><label><h6>Vidrio Delantero</h6></label></td>
<td>
<label class="radio-inline">
<input type="radio" name="vidrio_delantero" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="vidrio_delantero" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="vidrio_delantero" class="form-input" value="malo">Malo<br>
</label>
</td>
</tr>

<tr>
<td><label><h6>Vidrio Trasero</h6></label></td>
<td>
<label class="radio-inline">
<input type="radio" name="vidrio_trasero" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="vidrio_trasero" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="vidrio_trasero" class="form-input" value="malo">Malo<br>
</label>
</td>
</tr>

<tr>
<td><label><h6>Vidrio Lateral Delantero</h6></label></td>
<td>
<label class="radio-inline">
<input type="radio" name="vidrio_lateral_delantero" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="vidrio_lateral_delantero" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="vidrio_lateral_delantero" class="form-input" value="malo">Malo<br>
</label>
</td>
</tr>

<tr>
<td><label><h6>Vidrio Lateral Trasero</h6></label></td>
<td>
<label class="radio-inline">
<input type="radio" name="vidrio_lateral_trasero" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="vidrio_lateral_trasero" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="vidrio_lateral_trasero" class="form-input" value="malo">Malo<br>
</label>
</td>
</tr>

<tr>
<td><label><h6>Dirección</h6></label></td>
<td>
<label class="radio-inline">
<input type="radio" name="direccion" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="direccion" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="direccion" class="form-input" value="malo">Malo<br>
</label>
</td>
</tr>

<tr>
<td><label><h6>Suspensón Delantera</h6></label></td>
<td>
<label class="radio-inline">
<input type="radio" name="suspension_delantera" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="suspension_delantera" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="suspension_delantera" class="form-input" value="malo">Malo<br>
</label>
</td>
</tr>

<tr>
<td><label><h6>Suspensión Trasera</h6></label></td>
<td>
<label class="radio-inline">
<input type="radio" name="suspension_trasera" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="suspension_trasera" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="suspension_trasera" class="form-input" value="malo">Malo<br>
</label>
</td>
</tr>

<tr>
<td><label><h6>Pintura Carrocería</h6></label></td>
<td>
<label class="radio-inline">
<input type="radio" name="pintura" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="pintura" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="pintura" class="form-input" value="malo">Malo<br>
</label>
</td>
</tr>

<tr>
<td><label><h6>Orden Limpieza</h6></label></td>
<td>
<label class="radio-inline">
<input type="radio" name="limpieza" class="form-input" value="bueno">Bueno<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="limpieza" class="form-input" value="regular">Regular<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="limpieza" class="form-input" value="malo">Malo<br>
</label>
</td>
</tr>

<tr>
<td><label><h6>¿Se tienen las 2 Placas?</h6></label></td>
<td>
<label class="radio-inline">
<input type="radio" name="placas" class="form-input" value="si">SI<br>
</label>
<label class="radio-inline"> 
<input type="radio" name="placas" class="form-input" value="no">NO<br>
</label>
</td>
</tr>
</tbody>
</table>
</div>
</div>

<hr style="border:1px dotted white;">

<div class="form-row">
<div class="form-group col-md-3">
<label for="">Revisión del estado del Parabrisas</label>
<textarea name="parabrisas" id="parabrisas"></textarea>
<p id="ms5" style="display:none" class="error">Describe el problema</p>
</div>

<div class="form-group col-md-3">
      <label for="">Nivel de Gasolina</label>
      <select name="nivel_gasolina" id="nivel_gasolina" class="form-control">
        <option value="">Seleccione...</option>
        <option value="1/4">1/4</option>
        <option value="1/2">1/2</option>
        <option value="3/4">3/4</option>
        <option value="100">100</option>             
      </select>
      <p id="ms6" style="display:none" class="error">Seleccione una opción</p>
    </div>

<div class="form-group col-md-3">
      <label for="">Revisión del estado de las llantas</label>
      <select name="estado_llantas" id="estado_llantas" class="form-control">
        <option value="">Seleccione...</option>
        <option value="D-P">D-P</option>
        <option value="D-C">D-C</option>
        <option value="T-P">T-P</option>
        <option value="T-C">T-C</option>             
      </select>
      <p id="ms7" style="display:none" class="error">Seleccione una opción</p>
    </div>

    <div class="form-group col-md-3">
      <label for="">Licencia de manejo vigente</label>
       <div class="input-group mb-3">
      <div class="input-group-prepend">
     <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
     </div>      
     <input type="date" class="form-control" name="licencia" id="licencia">
    </div>
    <p id="ms8" style="display:none" class="error">Indique la fecha de expiración</p>
    </div> 
</div>


<div class="form-row">
    <div class="form-group col-md-3">
      <label for="">Póliza de seguro del vehículo</label>
       <div class="input-group mb-3">
      <div class="input-group-prepend">
     <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
     </div>      
     <input type="date" class="form-control" name="poliza" id="poliza">
    </div>
    <p id="ms9" style="display:none" class="error">Indique la fecha de expiración</p>
    </div>

    <div class="form-group col-md-3">
      <label for="">Tarjeta de circulación</label>
       <div class="input-group mb-3">
      <div class="input-group-prepend">
     <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
     </div>      
    <input type="date" class="form-control" name="tarjeta_circulacion" id="tarjeta_circulacion">
    </div>
    <p id="ms10" style="display:none" class="error">Indique la fecha de expiración</p>
    </div>

    <div class="form-group col-md-3">
      <label for="">Código de Batería</label> 
    <input type="text" class="form-control" name="codigo_bateria" id="codigo_bateria" placeholder="123">
     <p id="ms11" style="display:none" class="error">Indique el Código de la Batería</p>
    </div>

<div class="form-group col-md-3">
<label for="">Observaciones</label>
<textarea name="observaciones" id="observaciones"></textarea>
<p id="ms12" style="display:none" class="error">Describe el problema</p>
</div>       
</div>

<div class="form-row">
<div class="form-group col-md-4">
<label for="">Horómetro</label> 
<input type="time" class="form-control" name="horometro" id="horometro" placeholder="12:30">
<p id="ms13" style="display:none" class="error">Indique el Horómetro</p>
</div>

<div class="form-group col-md-4">
<label for="">Tacómetro</label> 
<input type="text" class="form-control numerico" name="tacometro" id="tacometro" placeholder="123">
<p id="ms14" style="display:none" class="error">Indique el Tacómetro</p>
</div>

<div class="form-group col-md-4">
<label for="">Velocímetro</label> 
<input type="text" class="form-control numerico" name="velocimetro" id="velocimetro" placeholder="123">
<p id="ms15" style="display:none" class="error">Indique el Velocimetro</p>
</div>
</div>

</form>
<hr>
<div class="form-row">
<div class="form-group col-md-12">      
<button type="button" id="btnguardar" class="btn btn-warning hvr-sink">Enviar</button>
<button type="button" class="btn btn-primary hvr-pop" onclick="location.href='ver_checklist_mtto.php'">Ver Checklist Mtto
</button>
</div>   
</div>

<hr>
<div class="text-left">
    </div>
   </div>
  </div> <!-- end card-box -->


<script type="text/javascript">   
function validaForm(){
  if($("#numero").val() == ""){        
        $("#m").delay(100).fadeIn("slow");
        $("#numero").focus();
        return false;
    }
    else
    {
      $("#m").fadeOut();      
    }
    // Campos de texto
    if($("#conductor").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms").delay(100).fadeIn("slow");
        $("#conductor").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms").fadeOut();      
    }

    if($("#vehiculo").val() == ""){        
        $("#ms1").delay(100).fadeIn("slow");
        $("#vehiculo").focus();
        return false;
    }
    else
    {
      $("#ms1").fadeOut();      
    }

     if($("#kilometraje").val() == ""){        
        $("#ms2").delay(100).fadeIn("slow");
        $("#kilometraje").focus();
        return false;
    }
    else
    {
      $("#ms2").fadeOut();      
    }

  if($("#fecha_revision").val() == ""){        
        $("#ms3").delay(100).fadeIn("slow");
        $("#fecha_revision").focus();
        return false;
    }
    else
    {
      $("#ms3").fadeOut();      
    }
  if($("#hora_revision").val() == ""){        
        $("#ms4").delay(100).fadeIn("slow");
        $("#hora_revision").focus();
        return false;
    }
    else
    {
      $("#ms4").fadeOut();      
    }

if($("#parabrisas").val() == ""){        
        $("#ms5").delay(100).fadeIn("slow");
        $("#parabrisas").focus();
        return false;
    }
    else
    {
      $("#ms5").fadeOut();      
    }
if($("#nivel_gasolina").val() == ""){        
        $("#ms6").delay(100).fadeIn("slow");
        $("#nivel_gasolina").focus();
        return false;
    }
    else
    {
      $("#ms6").fadeOut();      
    }
if($("#estado_llantas").val() == ""){        
        $("#ms7").delay(100).fadeIn("slow");
        $("#estado_llantas").focus();
        return false;
    }
    else
    {
      $("#ms7").fadeOut();      
    }
if($("#licencia").val() == ""){        
        $("#ms8").delay(100).fadeIn("slow");
        $("#licencia").focus();
        return false;
    }
    else
    {
      $("#ms8").fadeOut();      
    }
if($("#poliza").val() == ""){        
        $("#ms9").delay(100).fadeIn("slow");
        $("#poliza").focus();
        return false;
    }
    else
    {
      $("#ms9").fadeOut();      
    }

if($("#tarjeta_circulacion").val() == ""){        
        $("#ms10").delay(100).fadeIn("slow");
        $("#tarjeta_circulacion").focus();
        return false;
    }
    else
    {
      $("#ms10").fadeOut();      
    }

    if($("#codigo_bateria").val() == ""){        
        $("#ms11").delay(100).fadeIn("slow");
        $("#codigo_bateria").focus();
        return false;
    }
    else
    {
      $("#ms11").fadeOut();      
    }

if($("#observaciones").val() == ""){        
        $("#ms12").delay(100).fadeIn("slow");
        $("#observaciones").focus();
        return false;
    }
    else
    {
      $("#ms12").fadeOut();      
    }


if($("#horometro").val() == ""){        
        $("#ms13").delay(100).fadeIn("slow");
        $("#horometro").focus();
        return false;
    }
    else
    {
      $("#ms13").fadeOut();      
    }

if($("#tacometro").val() == ""){        
        $("#ms14").delay(100).fadeIn("slow");
        $("#tacometro").focus();
        return false;
    }
    else
    {
      $("#ms14").fadeOut();      
    }

if($("#velocimetro").val() == ""){        
        $("#ms15").delay(100).fadeIn("slow");
        $("#velocimetro").focus();
        return false;
    }
    else
    {
      $("#ms15").fadeOut();      
    }
      return true; // Si todo está correcto
}


// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnguardar").click( function() {
// Primero validará el formulario.
  if(validaForm()){ 
  $.post("scripts/reg_checklistmtto.php",$("#checkmtto").serialize(),function(res){
  console.log();
                if(res == 1){
                     //alert("Fallo al agregar");
                  Swal.fire({
                   type: 'error',
                   title: 'Oops...',
                   text: 'Fallo al agregar',                  
                   });
                } else {
                    //alert("Vehículo agregado con éxito!!");
                    Swal.fire({
                     position:'center',
                     type: 'success',
                     title: 'Checklist Previo a Mantenimientos!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("checkmtto").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
}); 


//VALIDAR QUE SEAN SOLO NUMEROS ENTEROS Y DECIMALES DENEGAR LETRAS
const inputs = document.querySelectorAll('.numerico');

Array.from(inputs).forEach(function(input) {
  input.addEventListener('keypress', function(e) {
    // keyCode del punto decimal, también se puede cambiar por la coma que sería el 44
    const decimalCode = 46;
    // chequeo que el keyCode corresponda a las teclas de los números y al punto decimal
    if ((e.keyCode < 48 || e.keyCode > 57) && e.keyCode != decimalCode) {
      e.preventDefault();
    }
    // chequeo que sólo exista un punto decimal
    else if (e.keyCode == decimalCode && /\./.test(this.value)) {
      event.preventDefault();
    }
  }, true)
});

function numero(numero) {
  return document.getElementById(numero);
}
numero('numero').addEventListener('input',function() {
  var val = this.value;
  this.value = val.replace(/\D|\-/,'');
});

function numero(numero) {
  return document.getElementById(numero);
}
numero('codigo_bateria').addEventListener('input',function() {
  var val = this.value;
  this.value = val.replace(/\D|\-/,'');
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

