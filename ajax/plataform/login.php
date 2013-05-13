<?php
chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('plataform.php');
chdir('../ajax/plataform');

header('Content-type: application/json');

if (isset($_GET['email']) and isset($_GET['password'])) {
    $id = login($_GET['email'], $_GET['password']);
    if ($id==true) {
        $user=getUserByEmail($_GET['email']);
        $_SESSION['id'] = $user['id'];
        $_SESSION['permission'] = $user['privilege'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        echo json_encode(Array("result" => "ok"));
    } else {
        echo json_encode(Array("result" => "error"));
    }
     
}else{
    echo json_encode(Array("result"=>"missingParams"));
}
?>