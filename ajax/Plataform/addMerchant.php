<?php
	 require_once('../common/init.php');
     require_once('../database/plataform.php');
     header('Content-type: application/json');
     
     
     if(isset($_GET['name']) and isset($_GET['email']) and isset($_GET['password'])){
     
     	 try{
         	$id=createMerchant($_GET['name'], $_GET['email'], $_GET['password']);
         	echo json_encode(Array("result"=>"ok","id"=>$id));
         }catch(Exception $e)
         {
         	 echo json_encode(Array("result"=>"error"));
         }
     }else{
         echo json_encode(Array("result"=>"error"));
     }

?>