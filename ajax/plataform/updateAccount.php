<?php
header('Content-type: application/json');

chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('plataform.php');
chdir('../ajax/plataform');

if (isset($_GET['email'])) {
    $email = $_GET['email'];
    
    if(isset($_GET['name'])){
        updateAccountName($email, $_GET['name']);
        $_SESSION["name"] = $_GET['name'];
    }
    
    if(isset($_GET['password'])){
        updateAccountPassword($email, $_GET['password']);
    }
    
    if(isset($_GET['newEmail'])){
        updateAccountEmail($email, $_GET['newEmail']);
        $_SESSION["email"] = $_GET['newEmail'];
    }

    echo json_encode(Array("result"=>$_GET));
}
else {
    echo json_encode(Array("result"=>"missingParams"));
}

?>