<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

//checking for the request method
$req_method = $_SERVER['REQUEST_METHOD'];
if ($req_method === 'POST') {
  $requested_body = file_get_contents('php://input');
  $data = json_decode($requested_body, true);
  $name = $data[0]['value'];
  $email =$data[1]['value'];
  $subject =$data[2]['value'];
  $body = $data[3]['value'];


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
  //Server settings
  // $mail->SMTPDebug = SMTP::DEBUG_SERVER;           
  $mail->isSMTP();                                        
  $mail->Host       = 'smtp.gmail.com';                     
  $mail->SMTPAuth   = true;                                   
  $mail->Username   = 'melchizedekfelix80@gmail.com';                     
  $mail->Password   = 'rimwsnfgaijlzrfr';                               
  $mail->SMTPSecure = 'ssl';
  // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   
  $mail->Port       = 465;  

  //Recipients
  $mail->setFrom($email, $name);
  $mail->addAddress('Kiboolif@gmail.com'); 
  // $mail->addReplyTo('info@example.com', 'Information');

  //Content
  $mail->isHTML(true);                                
  $mail->Subject = ("$email ($subject)");
  $mail->Body    = $body;
  $mail->send();
  echo json_encode(['success'=> 'Message has been sent']);
} catch (Exception $e) {
  echo json_encode(['error'=> "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
}

}
?>

