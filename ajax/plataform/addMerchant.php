<?php
     header('Content-type: application/json');
	 require_once('../../common/init.php');
     require_once('../../database/plataform.php');
     if(isset($_GET['name']) and isset($_GET['email']) and isset($_GET['password'])){
     
     	$user=getUserByEmail($_GET['email']);
     	if(isset($user) and ($user['privilege']=='merchant' or $user['privilege']=='admin' ))
     	{
     		echo json_encode(Array("result"=>"userAlreadyExists"));
     	}else
     	{
	     	 try{
	         	$id=createMerchant($_GET['name'], $_GET['email'], $_GET['password']);
	         	echo json_encode(Array("result"=>"ok","id"=>$id));
	         } 
	         catch(Exception $e){
	         	 echo json_encode(Array("result"=>"error"));
	         }
         }
     }
     else{ 
         echo json_encode(Array("result"=>"error"));
     }
?>