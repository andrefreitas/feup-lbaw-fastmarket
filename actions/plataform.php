<?php 
chdir("../common");
require_once('database.php');
chdir("../database");
require_once('plataform.php');
chdir('../common');
require_once('smarty.php');
chdir("../actions");

function sendConfirmationEmail($userID){
    global $smarty;
    $user    = getUserById($userID);
    $hash    = getUserActivation($userID);
    $to      = $user["email"];
    $subject = 'Please confirm your registration in Fastmarket';
    $smarty->assign('user', $user["name"]);
    $smarty->assign('hash', $hash);
    $message = $smarty->fetch('emails/confirmationEmail.tpl');
    $headers = "From: noreply@fastmarket.fe.up.pt\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    
    mail($to, $subject, $message, $headers);
}

?>