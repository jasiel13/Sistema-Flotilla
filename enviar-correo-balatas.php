<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$vehiculo=$_POST['vehiculo'];

$body = "<h2 align='center'>Vehículo: $vehiculo</h2>"."<h4 align='center'><a href='http://localhost/control_flotilla/reg_cambio_balatas.php' style='text-decoration: none;
    padding: 10px;
    font-weight: 300;
    font-size: 15px;
    color: #ffffff;
    background-color: #1883ba;
    border-radius: 6px;
    border: 2px solid black;'>Ir a Registrar Balatas</a></h4>".
    "<br><h4 align='center'><a href='http://localhost/control_flotilla/alertas_balatas.php' style='text-decoration: none;
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
    $mail->Password   = 'T3cn0l0g145csn*';                               // SMTP password
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

    $mail->Subject = 'Alerta de Cambio de Balatas';
    $mail->Body    = "<div style='color:white;background:#434444;width:500px;border-radius: 15px;border: 3px #00AFFF outset;'>
    <legend><h2 align='center'>Usted tiene un cambio de Balatas pendiente del:</h2>   
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