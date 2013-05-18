<?php
header('Content-type: application/json');
chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('plataform.php');
chdir('../ajax/plataform');

if (isset($_GET['email']) and isset($_GET['password'])) {
    $password = hash('sha256',$_GET['password']);
    $id = login($_GET['email'], $password);
    if($id)
        echo json_encode(Array("result"=>"ok"));
    else 
       echo json_encode(Array("result"=>"invalid"));
}
else {
    echo json_encode(Array("result"=>"missingParams"));
}
?>