<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$con=mysqli_connect("localhost","root","","controldeflotilla") or die(mysqli_error());

$query="SELECT id_incidente,conductor,vehiculo,servicio,fecha_inicio,prioridad,incidente,descripcion,
fecha_final FROM incidentes WHERE id_incidente= '".$_POST["id"]."' ";
$result=mysqli_query($con, $query) or die (mysqli_error());
while ($row=mysqli_fetch_array($result)){ 
$id=$row['id_incidente'];
$conductor=$row['conductor'];
$vehiculo=$row['vehiculo'];
$servicio=$row['servicio'];
$fecha_inicio=$row['fecha_inicio'];
$prioridad=$row['prioridad'];
$incidente=$row['incidente'];
$descripcion=$row['descripcion'];
$fecha_final=$row['fecha_final'];
}

$body = "<h3 align='center'>No_incidente: $id </h3>"."<h3 align='center'>Conductor: $conductor</h3>"."<h3 align='center'>Vehículo: $vehiculo </h3>"."<h3 align='center'>Servicio: $servicio</h3>"."<h3 align='center'>Fecha_inicio: $fecha_inicio</h3>"."<h3 align='center'>Prioridad: $prioridad</h3>"."<h3 align='center'>Incidente: $incidente</h3>"."<h3 align='center'>Descripción: $descripcion</h3>"."<h3 align='center' style='color:#00e676;'>Fecha_final: $fecha_final</h3>"."<h4 align='center'><a href='http://localhost/control_flotilla/reg_mantenimiento.php' style='text-decoration: none;
    padding: 10px;
    font-weight: 300;
    font-size: 15px;
    color: #ffffff;
    background-color: #1883ba;
    border-radius: 6px;
    border: 2px solid black;'>Ir a Mantenimiento</a></h4>".
    "<br><h4 align='center'><a href='http://localhost/control_flotilla/alertas_incidentes.php' style='text-decoration: none;
    padding: 10px;
    font-weight: 300;
    font-size: 15px;
    color: #ffffff;
    background-color: #1883ba;
    border-radius: 6px;
    border: 2px solid black;'>Revisar Alerta</a></h4>";

require 'enviar-correo-phpmailer/Exception.php';
require 'enviar-correo-phpmailer/PHPMailer.php';
require 'enviar-correo-phpmailer/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP     servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'soporte.flotilla@gmail.com';                     // SMTP username
    $mail->Password   = 'T3cn0l0g14513*';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('soporte.flotilla@gmail.com');
    $mail->addAddress('soporte.flotilla@gmail.com'); // Add a recipient
    $mail->addAddress('jasiel.becerra@csn.ac'); 
    //$mail->addAddress('fernando.casas@csn.ac');
    //$mail->addAddress('reginaldo.deanda@serviciosecoambientales.com');     
    
    // Content
    $mail->isHTML(true); // Set email format to HTML

    //$mail->msgHTML('<img src="img/mensaje.php">');  
    //$mail->AddAttachment("img/mensaje.png");  

    $mail->Subject = 'Alerta de Atención a Incidente';
    $mail->Body    = "<div style='color:white;background:#434444;width:500px;border-radius: 15px;border: 3px #00AFFF outset;'>
    <legend><h2 align='center'>Alerta de Atención a Incidente:</h2>   
    </legend>
     $body</div>";
    $mail->CharSet= 'UTF-8'; 
    
    $mail->send();
    echo '<script>
    alert ("El mensaje se envío correctamente");
    window.history.go(-1);
    </script>';
} catch (Exception $e) {
    echo "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
}
?>