<?php include 'menu.php';
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Registro de vehículo checklist</title>
    
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
<h3 align="center">Checklist 
<i class="fa fa-clipboard fa-2x"></i></h3> 
</div> 

<!--MODAL-->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Agregar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form class="container" id="frmagregar" method="POST">
      <div class="form-row">
      <div class="form-group col-md-12">
      <label for="">Partes y Accesorios</label>
    <input type="text" class="form-control" name="partes" id="partes" placeholder="Exteriores e interiores">
      <p id="ms" style="display:none" class="fallo">El campo Partes y Accesorios no puede estar vacío</p>
  
      </div>        
      </div>   
    </form>
     
    </div>
    <div class="modal-footer bg-info"> 
    <button type="button" id="btnagregar" class="btn btn-dark">Enivar</button>    
     
    </div>
    </div>
  </div>
</div>
<!--modal-->

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Formato de Resguardo del Vehículo
    <img src="img/checklist.png">
  </legend>

 <form class="container" id="frmcheck" method="POST">
  <div class="form-row">
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
    <p id="ms1" style="display:none" class="error">El campo vehículo no puede estar vacío</p>
    </div>    
  
   <div class="form-group col-md-4">
      <label for="">Número de indentificación</label>
    <input type="text" class="form-control" name="numero_identificacion" id="numero_identificacion" placeholder="123">
    <p id="ms2" style="display:none" class="error">El campo número identificación no puede estar vacío</p>
    </div>  

    <div class="form-group col-md-3">
   <label for="">Observaciones</label>
  <textarea name="observaciones" id="observaciones"></textarea>
  <p id="ms3" style="display:none" class="error">Describe el problema</p>
  </div>     
  </div>

   <div class="form-row">
    <div class="form-group col-md-4">
      <label for="">Fecha de Registro</label>
       <div class="input-group mb-3">
      <div class="input-group-prepend">
     <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
     </div> 
      <?php 
      date_default_timezone_set('America/Mexico_City');        
      $fecha = date("Y/m/d");
      ?>
     <input type="text" class="form-control" name="fecha" id="fecha" 
      value="<?php echo $fecha; ?>">
    </div>
     </div> 
     <div class="form-group col-md-4">
      <label for="">Entregado por:</label>
      <select  name="entregado_por" id="entregado_por" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM usuarios";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['usuario'].'">'.$row['usuario'].'</option>';
          }
        ?>  
      </select>
      <p id="ms4" style="display:none" class="error">El campo entregado no puede estar vacío</p>
     </div>
     <div class="form-group col-md-4">
      <label for="">Recibido por:</label>
      <select  name="recibido_por" id="recibido_por" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM usuarios";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['usuario'].'">'.$row['usuario'].'</option>';
          }
        ?>  
      </select>
      <p id="ms5" style="display:none" class="error">El campo recibido no puede estar vacío</p>
     </div>  
   </div>

<hr>
<div class="form-row">
<div class="form-group col-md-12">      
<button type="button" id="btnguardar" class="btn btn-warning hvr-sink">Enviar</button>
<button type="button" class="btn btn-primary hvr-pop" onclick="location.href='ver_checklist.php'">Ver Checklist
</button>
<!--<button class="btn btn-primary hvr-sink" type="button" id="btnagregar" data-toggle="modal" data-target=".bd-example-modal-sm">Agregar P&A</button>--> 
</div>   
</div>

<hr>
<div class="text-left">
    </div>
   </div>
  </div> <!-- end card-box -->

<div class="container">
<table class="table table-sm table-bordered table-condensed">
<thead class="thead-dark text-center"> 
  <tr>
    <th>Partes y Accesorios</th>   
    <th>Cantidad</th>
    <th>Estado</th>
  </tr>
  <tr>
 </thead> 
 <tbody class="text-center" >
 <tr> 
 <tr>
 <th colspan="8" scope="rowgroup" class=" bg-info text-center">Frente exterior</th>
</tr>
<td>
<input type="text" name="nombre[]" id="emblemas" value="Emblemas" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>


<tr> 
<td>
<input type="text" name="nombre[]" id="unidades" value="Unidades" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>


<tr> 
<td>
<input type="text" name="nombre[]" id="defensa_delantera" value="Defensa delantera" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>


<tr> 
<td>
<input type="text" name="nombre[]" id="direccionales" value="Direccionales" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr>
 <th colspan="8" scope="rowgroup" class=" bg-info text-center">Interior del Motor</th>
</tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="bateria_marca" value="Bateria marca" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="tapa_radiador" value="Tapa Radiador" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="tapa_aceite" value="Tapa Aceite" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>


<tr> 
<td>
<input type="text" name="nombre[]" id="varilla_medidora" value="Varilla medidora aceite" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>


<tr> 
<td>
<input type="text" name="nombre[]" id="correas_ventilador" value="Correas de ventilador" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>


<tr> 
<td>
<input type="text" name="nombre[]" id="claxon" value="Claxon" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr>
 <th colspan="8" scope="rowgroup" class=" bg-info text-center">Frente Superior</th>
</tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="parabrisas" value="Parabrisas" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="brazos_limpia_parabrisas" value="Brazos limpia parabrisas" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>


<tr> 
<td>
<input type="text" name="nombre[]" id="Cuchillo_limpia_parabrisas" value="Cuchillo limpia parabrisas" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="antena radio" value="Antena radio" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr>
 <th colspan="8" scope="rowgroup" class=" bg-info text-center">Costado Izquierdo</th>
</tr>


<tr> 
<td>
<input type="text" name="nombre[]" id="vidrios laterales" value="Vidrios laterales" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="manija" value="Manija" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="cerraduras" value="Cerraduras" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>


<tr> 
<td>
<input type="text" name="nombre[]" id="copas ruedas" value="Copa ruedas" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr>
 <th colspan="8" scope="rowgroup" class=" bg-info text-center">Estribos</th>
</tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="estribo derecho" value="Estribo derecho" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="estribo izquierdo" value="Estribo izquierdo" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>


<tr>
 <th colspan="8" scope="rowgroup" class=" bg-info text-center">Costado Trasero</th>
</tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="emblemas2" value="Emblemas" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="defensa_trasera" value="Defensa trasera" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="stop frenos" value="Stop Frenos" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>


<tr> 
<td>
<input type="text" name="nombre[]" id="luces_parqueo" value="Luces de parqueo" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>


<tr> 
<td>
<input type="text" name="nombre[]" id="tercer stop" value="Tercer stop" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="direccionales" value="Direccionales" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="reversos" value="Reversos" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="vidrios traseros" value="Vidrios traseros" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="tapa gasolina" value="Tapa de tanque gasolina" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr>
 <th colspan="8" scope="rowgroup" class=" bg-info text-center">Costado Derecho</th>
</tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="vidrios_laterales2" value="Vidrios Laterales" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="manijas2" value="Manijas" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="cerraduras2" value="Cerraduras" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>


<tr> 
<td>
<input type="text" name="nombre[]" id="copas_ruedas2" value="Copas ruedas" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr>
 <th colspan="8" scope="rowgroup" class=" bg-info text-center">Llaves</th>
</tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="puertas" value="Puertas" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="ignicion" value="Ignición" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr>
 <th colspan="8" scope="rowgroup" class=" bg-info text-center">Interior del Vehículo</th>
</tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="consola" value="Consola" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="radio marca" value="Radio marca" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>


<tr> 
<td>
<input type="text" name="nombre[]" id="guantera" value="Guantera" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="seguro puerta" value="Seguro puerta" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="manija puerta" value="Manija puerta" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>


<tr> 
<td>
<input type="text" name="nombre[]" id="manija vidrio" value="Manija vidrio" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="luz interior" value="Luz interior" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="cojinera" value="Cojinera" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="forros" value="Forros" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="tapetes" value="Tapetes" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="cenicero" value="Cenicero" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="descansabrazos" value="Descansabrazos" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="descasacabezas" value="Descansacabezas" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="espejo_retrovisor" value="Espejo retrovisor" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr>
 <th colspan="8" scope="rowgroup" class=" bg-info text-center">Tablero de controles</th>
</tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="switch ignicion" value="Switch ignicón" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="interruptor_luces_delanteras" value="Int luces delanteras" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

  <tr> 
<td>
<input type="text" name="nombre[]" id="interruptor_luces_parqueo" value="Int luces parqueo" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

  <tr> 
<td>
<input type="text" name="nombre[]" id="direccionales3" value="Direccionales" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="claxon2" value="Claxon" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="sirena" value="Sirena" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="calefaccion" value="Calefacción" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="tacometro" value="Tacómetro" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="encendedor cigarrillos" value="Encendedor cigarrillos" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="velocimetro" value="Velocimetro" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="medidor_gasolina" value="Medidor de gasolina" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="medidor_temperatura" value="Medidor de temperatura" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="medidor_aceite" value="Medidor de aceite" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr>
 <th colspan="8" scope="rowgroup" class=" bg-info text-center">Herramientas</th>
</tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="gato_hidrauilico" value="Gato hidrahulico" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>


<tr> 
<td>
<input type="text" name="nombre[]" id="crucetas" value="Crucetas" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="pinzas mecanicas" value="Pinzas mecanicas" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="palancas" value="Palancas" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>


<tr> 
<td>
<input type="text" name="nombre[]" id="desarmador plano" value="Desarmador plano" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="desarmador estrella" value="Desarmador estrella" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="llaves fijas" value="Llaves fijas" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="llaves expansion" value="Llaves de expansión" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="mixtas" value="Mixtas" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="lampara_mano" value="Lampara de mano" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="cable_pasacorriente" value="Cable pasacorriente" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

  <tr> 
<td>
<input type="text" name="nombre[]" id="bandas" value="Bandas" style=" border: 0;" readonly>
</td>
<td>
<input type="text" name="cantidad[]" id="cantidad" style=" border: 0;">
</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="bueno">Bueno
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="malo">Malo
      </label>    
    
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no_aplica">NA
      </label>    
  </td>
  </tr>

<tr>
 <th colspan="8" scope="rowgroup" class=" bg-info text-center">Señales de advertencia de peligro</th>
</tr>

 <tr> 
<td>
<input type="text" name="nombre[]" id="traingulos_advertencia" value="Triangulos advertencia" style=" border: 0;" readonly>
</td>
<td>

</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="si">Si
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no">No
      </label>    
         
  </td>
  </tr>


 <tr> 
<td>
<input type="text" name="nombre[]" id="lamparas_luzintermitentes" value="Lamparas intermitentes" style=" border: 0;" readonly>
</td>
<td>
</td>
    <td>
         <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="si">Si
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no">No
      </label>  
  </td>
  </tr>

 <tr> 
<td>
<input type="text" name="nombre[]" id="tacos_bloqueo" value="Tacos para bloquear" style=" border: 0;" readonly>
</td>
<td>

</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="si">Si
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no">No
      </label>   
  </td>
  </tr>

 <tr> 
<td>
<input type="text" name="nombre[]" id="extinguidor" value="Extinguidor" style=" border: 0;" readonly>
</td>
<td>

</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="si">Si
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no">No
      </label> 
  </td>
  </tr>

<tr>
 <th colspan="8" scope="rowgroup" class=" bg-info text-center">Documentos</th>
</tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="manual" value="Manual vehículo" style=" border: 0;" readonly>
</td>
<td>

</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="si">Si
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no">No
      </label> 
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="poliza" value="Poliza de seguro" style=" border: 0;" readonly>
</td>
<td>

</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="si">Si
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no">No
      </label> 
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="placas2" value="Placas" style=" border: 0;" readonly>
</td>
<td>

</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="si">Si
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no">No
      </label> 
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="tarjeta circulacion" value="Tarjeta de circulación" style=" border: 0;" readonly>
</td>
<td>

</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="si">Si
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no">No
      </label> 
  </td>
  </tr>

<tr> 
<td>
<input type="text" name="nombre[]" id="licencia" value="Licencia de conducir" style=" border: 0;" readonly>
</td>
<td>

</td>
    <td>
        <label class="checkbox-inline">
        <input type="checkbox" name="estado[]" value="si">Si
        </label>      
     
      <label class="checkbox-inline">
      <input type="checkbox" name="estado[]" value="no">No
      </label> 
  </td>
  </tr>

</tbody>
</table>
</div>
</form>

<script type="text/javascript">
   function validaForm(){
    if($("#partes").val() == ""){       
        $("#ms").delay(100).fadeIn("slow");
        $("#partes").focus();
        return false;
    }
    else
    {
      $("#ms").fadeOut();      
    }
     return true;}

$(document).ready( function() { 
 $("#btnagregar").click( function() {
  if(validaForm()){ 
  $.post("scripts/reg_partesaccesorios.php",$("#frmagregar").serialize(),function(res){
 
                if(res == 1){                 
                  Swal.fire({
                   type: 'error',
                   title: 'Oops...',
                   text: 'Fallo al agregar',                  
                   });
                } else {                  
                    Swal.fire({
                     position:'center',
                     type: 'success',
                     title: 'P&A agregados con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("frmagregar").reset();
                }
            });
        }
    });    
});


function validaForm1(){
    // Campos de texto
    if($("#vehiculo").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms1").delay(100).fadeIn("slow");
        $("#vehiculo").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms1").fadeOut();      
    }

    if($("#numero_identificacion").val() == ""){        
        $("#ms2").delay(100).fadeIn("slow");
        $("#nuemro_identificacion").focus();
        return false;
    }
    else
    {
      $("#ms2").fadeOut();      
    }

     if($("#observaciones").val() == ""){        
        $("#ms3").delay(100).fadeIn("slow");
        $("#obseravaciones").focus();
        return false;
    }
    else
    {
      $("#ms3").fadeOut();      
    }

  if($("#entregado_por").val() == ""){        
        $("#ms4").delay(100).fadeIn("slow");
        $("#entregado_por").focus();
        return false;
    }
    else
    {
      $("#ms4").fadeOut();      
    }
  if($("#recibido_por").val() == ""){        
        $("#ms5").delay(100).fadeIn("slow");
        $("#recibido_por").focus();
        return false;
    }
    else
    {
      $("#ms5").fadeOut();      
    }
      return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnguardar").click( function() {
// Primero validará el formulario.
  if(validaForm1()){ 
  $.post("scripts/reg_checklist.php",$("#frmcheck").serialize(),function(res){
 
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
                     title: 'Checklist agregado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("frmcheck").reset();//codigo para limpiar datos del form
                }
            });
        }
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

