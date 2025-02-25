<?php 

require '../Assets/class/database.class.php';
require '../Assets/class/function.class.php';
if($_POST){
$post = $_POST;

if($post['otp'])
{

    $otp=$post['otp'];

    if($fn->getSession('otp')==$otp){

    $fn->setAlert('Email and Otp verified!');    
    $fn->redirect('../change-password.php');
    }
    else{
        $fn->setError('Incorrect Otp');
        $fn->redirect('../verification.php');
    }

}

else{
    $fn->setError('Please enter 6 digit verification code');
    $fn->redirect('../verification.php');
}
}
else{
    $fn->redirect('../verification.php');
}
?>