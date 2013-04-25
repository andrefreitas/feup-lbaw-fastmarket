<?php
     require_once('../common/init.php');
     require_once('../database/plataform.php');
     header('Content-type: application/json');
     
     if(isset($_GET['name']) and isset($_GET['email']) and isset($_GET['password'])){
         $id=createMerchant($_GET['name'], $_GET['email'], $_GET['password']);
         echo json_encode(Array("answer"=>"ok","id"=>$id));
     }else{
         echo json_encode(Array("answer"=>"error"));
     }
?>