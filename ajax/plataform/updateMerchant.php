<?php
header('Content-type: application/json');

chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('plataform.php');
chdir('../ajax/plataform');

if (isset($_GET['id']) or isset($_GET['email'])) {
    $id = "";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }else{
        $id = getMerchantByEmail($_GET['email']);
        $id = $id["id"];
    }
    
    if($id){ 
        if(isset($_GET['name'])){
            $name = $_GET['name'];
            updateMerchantName($id, $name);
        }
        
        if(isset($_GET['newEmail'])){
            $email = $_GET['newEmail'];
            updateMerchantEmail($id, $email);
        }
        
        if(isset($_GET['password'])){
            $password = $_GET['password'];
            $password = hash("sha256", $password);
            updateMerchantPassword($id, $password);
        }
        
        if(isset($_GET['status'])){
            $status = $_GET['status'];
            updateMerchantStatus($id, $status);
        }
        echo json_encode(Array("result"=>"ok"));
    }else{
        echo json_encode(Array("result"=>"invalidUser"));
    }
    

}
else {
    echo json_encode(Array("result"=>"missingParams"));
}

?>