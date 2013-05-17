<?php 
chdir("../common");
require_once('database.php');
chdir("../database");
require_once('plataform.php');
chdir("../actions");

function sendConfirmationEmail($userID){
    $user    = getUserById($userID);
    $hash    = getUserActivation($userID);
    $to      = $user["email"];
    $subject = 'Please confirm your registration in Fastmarket';
    $message = 'Confirmation : ' . $hash;
    $headers = 'From: noreply@fastmarket.com' . "\r\n" .
            'Reply-To: noreply@fastmarket.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
    
    mail($to, $subject, $message, $headers);
}

?>