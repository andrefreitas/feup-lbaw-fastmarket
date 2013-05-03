<?php 
if($_SERVER['HTTP_HOST'] == 'gnomo.fe.up.pt'){
    require_once('/opt/lbaw/lbaw12503/public_html/fastmarket/common/database.php');
    require_once('/opt/lbaw/lbaw12503/public_html/fastmarket/database/plataform.php');
}
else{
    require_once($_SERVER["DOCUMENT_ROOT"] .'/fastmarket/common/database.php');
    require_once($_SERVER["DOCUMENT_ROOT"] .'/fastmarket/database/plataform.php');
}

function sendConfirmationEmail($userID){
    $user    = getUserById($userID);
    $hash    = getUserActivation($userID);
    $to      = "p.andrefreitas@gmail.com";
    $subject = 'Please confirm your registration in Fastmarket';
    $message = 'Confirmation : ' . $hash;
    $headers = 'From: noreply@fastmarket.com' . "\r\n" .
            'Reply-To: noreply@fastmarket.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
    
    mail($to, $subject, $message, $headers);
}
?>