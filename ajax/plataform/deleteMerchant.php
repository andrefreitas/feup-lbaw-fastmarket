<?php
//header('Content-type: application/json');

chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('plataform.php');
chdir('../ajax/plataform');

if (isset($_GET['id'])) {
    delete_merchant($_GET['id']);
    echo json_encode(Array("result"=>"ok"));
    
} else if(isset($_GET['email'])) {
    $email = $_GET['email'];
    $id = getMerchantByEmail($email);
    if($id){
        $id = $id["id"];
        delete_merchant($id);
        
        echo json_encode(Array("result"=>"ok"));
    }else{
        echo json_encode(Array("result"=>"error"));
    }
}
else {
    echo json_encode(Array("result"=>"missingParams"));
}

?>