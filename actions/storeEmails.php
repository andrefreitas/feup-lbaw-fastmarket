<?php 
chdir("../common");
require_once('database.php');
chdir("../database");
require_once('plataform.php');
chdir('../common');
require_once('smarty.php');
chdir("../actions");

function sendProductPriceChange($userId, $productId){
    global $smarty;
    $user = getUserById($userId);
    $userName = "André Freitas";
    $link = "http://fastmarket.com";
    $to = "p.andrefreitas@gmail.com";
    $productName = "Ferrari 548"; 
    $subject = 'Product changed price';
    $smarty->assign('user', $userName);
    $smarty->assign('link', $link);
    $smarty->assign('productName', $productName);
    $message = $smarty->fetch('emails/productPriceChange.tpl');
    $headers = "From: noreply@fastmarket.fe.up.pt\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
 
    mail($to, $subject, $message, $headers);
}

?>