<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../Assets/class/database.class.php';
require '../Assets/class/function.class.php';

require '../Assets/packages/phpmailer/src/Exception.php';
require '../Assets/packages/phpmailer/src/PHPMailer.php';
require '../Assets/packages/phpmailer/src/SMTP.php';

if($_POST){
$post = $_POST;

if($post['email_id'])
{

    $email_id = $db->real_escape_string($post['email_id']);
    
    $result=$db->query("SELECT id,full_name FROM users WHERE (email_id = '$email_id')");


    $result = $result->fetch_assoc();

    if($result){
        $otp = rand(100000,999999);
        $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'khushmankalsi.code@gmail.com';                    
    $mail->Password   = 'vdsfwepludayejof';                               
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    

    $mail->setFrom('khushmankalsi.code@gmail.com', 'Resume Builder');
    $mail->addAddress($email_id);     
    
    $mail->isHTML(true);                                 
    $mail->Subject = 'Forgot Password of Resume Builder ?';
    $mail->Body    = 'This is your 6 digit verification code <b>'.$otp.'</b>';

    $mail->send();

    $fn->setSession('otp',$otp);
    $fn->setSession('email',$email_id);

    $fn->redirect('../verification.php');


} catch (Exception $e) {
    $fn->setError($mail->ErrorInfo.'not registered');
    $fn->redirect('../forgot-password.php');
}

    }
    else{
        $fn->setError($email_id.'not registered');
        $fn->redirect('../forgot-password.php');
    }

   
}
else{
    $fn->setError('Please enter the email id');
    $fn->redirect('../forgot-password.php');
}
}
else{
    $fn->redirect('../forgot-password.php');
}
?>