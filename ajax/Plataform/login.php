<?php
	 require_once('../common/init.php');
     require_once('../database/plataform.php');
     header('Content-type: application/json');
     
     if(isset($_GET['email']) and isset($_GET['password'])){
         $id=login($_GET['email'], $_GET['password']);
         if($id==true)
         {
         	 $user=getUserByEmail($_GET['email']);
         	 $_SESSION['id']=$user['id'];
         	 $_SESSION['permission']=$user['privilege'];
         	 echo json_encode(Array("result"=>"ok"));
         }else
         {
         	 echo json_encode(Array("result"=>"error"));
         }
         
     }else{
         echo json_encode(Array("result"=>"error"));
     }
?>