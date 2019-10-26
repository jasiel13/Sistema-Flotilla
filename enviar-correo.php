<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$fecha=$_POST['fecha'];
$usuario=$_POST['usuario'];
$prioridad=$_POST['prioridad'];
$problema=$_POST['problema'];

$body = "<h2 align='center'>Usuario: $usuario</h2>" ."<h2 align='center'>Prioridad: $prioridad</h2>"."<h2 align='center'>Problema: $problema</h2>"."<h2 align='center'>Fecha: $fecha</h2>".
    "<h4 align='center'><a href='http://localhost/control_flotilla/solicitud_soporte.php' style='text-decoration: none;
    padding: 10px;
    font-weight: 300;
    font-size: 15px;
    color: #ffffff;
    background-color: #1883ba;
    border-radius: 6px;
    border: 2px solid black;'>Revisar Solicitudes</a></h4>";

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
    $mail->setFrom('soporte.flotilla@gmail.com', $usuario);
    $mail->addAddress('soporte.flotilla@gmail.com'); // Add a recipient
    $mail->addAddress('jasiel.becerra@csn.ac'); 
    //$mail->addAddress('fernando.casas@csn.ac');
    //$mail->addAddress('reginaldo.deanda@serviciosecoambientales.com');      
    
    // Content
    $mail->isHTML(true); // Set email format to HTML

    //$mail->msgHTML('<img src="img/mensaje.php">');  
    //$mail->AddAttachment("img/mensaje.png");  

    $mail->Subject = 'Solicitud de Soporte';
    $mail->Body    = "<div style='color:white;background:#434444;width:500px;border-radius: 15px;border: 3px #00AFFF outset;'>
    <legend><h1 align='center'>Datos de la solicitud</h1>   
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