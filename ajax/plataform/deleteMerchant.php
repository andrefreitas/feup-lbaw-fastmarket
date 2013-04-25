<?php
	 require_once('../common/init.php');
     require_once('../database/plataform.php');
     header('Content-type: application/json');
     
     if(isset($_GET['id'])){
     
     	
     	deleteMerchant($_GET['id']);
     	echo json_encode(Array("result"=>"ok"));
        
     }else{
         echo json_encode(Array("result"=>"error"));
     }
?>