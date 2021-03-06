<?php
header('Content-type: application/json');
chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('storeAccount.php');
chdir('../ajax/store');

if (isset($_GET['email']) and isset($_GET['password']) and isset($_GET['storeId'])) {
    $password = hash('sha256',$_GET['password']);
    $user = loginOnStore($_GET['email'], $password,$_GET['storeId']);
    
    if(isset($user[0]['id']))
    {
        $_SESSION['storesLogin'][$_GET['storeId']]['userId']=$user[0]['id'];
        echo json_encode(Array("result"=>"ok"));
    }else 
       echo json_encode(Array("result"=>"invalid"));
}
else {
    echo json_encode(Array("result"=>"missingParams"));
}
?>