<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Carta Responsiva</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/stylepdf.css">
    <script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>    
    
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="img/csn.png">
      </div>
      <div id="company">
        <h2 class="name">Carta Responsiva</h2>
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
      <div class="to"><h2>Por medio de este documento se hace responsable del vehículo a:</h2></div>
      <div id="invoice">
      <h1>Datos del conductor:</h1>    
       
      <select  name="conductor" id="conductor" class="oculto-impresion" onchange="mipdf(this.value)">
        <option value="">Seleccione...</option>
        <?php
        $con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
            $query1="SELECT  * FROM conductor";
            $result1=mysqli_query($con, $query1) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result1)){
            echo '<option value="'.$row['id_conductor'].'">'.$row['nombre'].'</option>';
          }
        ?>
      </select> 
        </div>
       </div>
      </div>       
   
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>         
            <th class="no">Id_conductor</th>
            <th class="no">Nombre</th>
            <th class="no">Vehículo</th>
            <th class="no">Reasignacón</th>
          </tr>
        </thead>


        <tbody>
          <tr>
            <td class="unit"><input type="text" id="id_conductor" readonly></td>
            <td class="unit"><input type="text" id="nombre" readonly ></td>
            <td class="unit"><input type="text" id="vehiculo" readonly></td>
            <td class="unit"><input type="text" id="fecha_modificacion" readonly></td>
                   
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
        Este documento se usa en Almácen como registro de reasignaciones de los vehículos      
      </div>     

<script type="text/javascript">
  function mipdf(valor){
    $.ajax({ 
     // la URL para la petición    
      url : 'scripts/cargar_valorespdf.php',
     // la información a enviar en este caso el valor de lo que seleccionaste en el select     
      data : { valor : valor },
     // especifica si será una petición POST o GET
      type : 'POST',
     // el tipo de información que se espera de respuesta
      dataType : 'json',
      success : function(json) {
        //aqui recibimos el "echo" del php(carga_valores.php)
        //y ahora solo colocas el valor en los campos     
        $("#id_conductor").val(json.id_conductor);
        $("#nombre").val(json.nombre);
        $("#vehiculo").val(json.vehiculo);
        $("#fecha_modificacion").val(json.fecha_modificacion);
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