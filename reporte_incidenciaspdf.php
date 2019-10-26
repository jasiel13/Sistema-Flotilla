<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Reporte de Incidencias</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/stylepdf2.css">
    <script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>    
    
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="img/csn.png">
      </div>
      <div id="company">
        <h2 class="name">Reporte de Incidencias</h2>
      <?php
       date_default_timezone_set('America/Mexico_City');  
      $fecha = date("d/m/Y");
      ?>
      <div><?php echo $fecha; ?></div>      
      </div>     
    </header>

    <main>
      <div id="details" class="clearfix">
      <div id="client">
      <div class="to"><h2>Por medio de este documento se informa la siguiente:</h2></div>
      <div id="invoice">
      <h1>Incidencia</h1>    
       
      <select  name="incidente" id="incidente" class="oculto-impresion" onchange="mipdf(this.value)">
        <option value="">Seleccione...</option>
        <?php
        $con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
            $query1="SELECT  * FROM incidentes";
            $result1=mysqli_query($con, $query1) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result1)){
            echo '<option value="'.$row['id_incidente'].'">'.$row['incidente'].'</option>';
          }
        ?>
      </select> 
        </div>
       </div>
      </div>       
   
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>         
            <th class="no">Id_Incidente</th>
            <th class="no">Conductor</th>
            <th class="no">Vehículo</th>
            <th class="no">Servicio</th>
          </tr>
          
        </thead>


        <tbody>
          <tr>
            <td class="unit"><input type="text" id="id_incidente" readonly></td>
            <td class="unit"><input type="text" id="conductor" readonly ></td>
            <td class="unit"><input type="text" id="vehiculo" readonly></td>
            <td class="unit"><input type="text" id="servicio" readonly></td>
          </tr>
          <tr>
            <th class="no">Fecha de reporte</th>            
            <th class="no">Incidente</th>
            <th class="no">Descripción</th>
            <th class="no">Kilometraje al momento</th>
          </tr>
          <tr>  
            <td class="unit"><input type="text" id="fecha_inicio" readonly></td>            
            <td class="unit"><input type="text" id="incidente2" readonly></td>
            <td class="unit"><textarea type="text" id="descripcion" readonly> </textarea></td>
            <td class="unit"><input type="text" id="odometro" readonly></td>
                   
          </tr>       
        </tbody>

        <tfoot>          
          <tr> 
          <td></td> 
          <td></td> 
          <td></td>         
          <td colspan="2">Control de flotilla</td>          
          </tr>
        </tfoot>
      </table>
     

      <div id="notices">
        <div><p style="text-align: center; font-size: x-large;">Firma del conductor</p>
        <p style="text-align: center;">_______________________________</p>
        </div>
        <div class="notices" style="text-align: center;">    
        Este documento se usa en Almácen como registro de incidencias de los vehículos      
      </div>     

<script type="text/javascript">
  function mipdf(valor){
    $.ajax({ 
     // la URL para la petición    
      url : 'scripts/cargar_valorespdf2.php',
     // la información a enviar en este caso el valor de lo que seleccionaste en el select     
      data : { valor : valor },
     // especifica si será una petición POST o GET
      type : 'POST',
     // el tipo de información que se espera de respuesta
      dataType : 'json',
      success : function(json) {
        //aqui recibimos el "echo" del php(carga_valores.php)
        //y ahora solo colocas el valor en los campos     
        $("#id_incidente").val(json.id_incidente);
        $("#conductor").val(json.conductor);
        $("#vehiculo").val(json.vehiculo);
        $("#servicio").val(json.servicio);
        $("#fecha_inicio").val(json.fecha_inicio);
        $("#prioridad").val(json.prioridad);
        $("#incidente2").val(json.incidente2);
        $("#descripcion").val(json.descripcion);
        $("#odometro").val(json.odometro);
      },
      // código a ejecutar si la petición falla;
        error : function(xhr, status) {
        alert('Disculpe, existió un problema');
      }
    });
  }
</script>
<button onclick="window.print();" class="oculto-impresion btn" >Imprimir</button> 
<button type="button" onClick="history.back()" class="oculto-impresion btn">
  Regresar
</button>

</body>
</html>