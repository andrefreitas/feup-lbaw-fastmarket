<?php
header('Content-type: application/json');

chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('plataform.php');
chdir('../actions');
require_once('plataform.php');
chdir('../ajax/plataform');

if( isset($_GET['name']) and isset($_GET['slogan']) and isset($_GET['vat']) 
	and isset($_GET['domain']) ){
     
     if(checkNameDomainStore($_GET['name'],$_GET['domain'])==null)
     {
     	createStore($_GET['name'],$_GET['slogan'],$_GET['domain'],$_GET['vat'],null);
     	echo json_encode(Array("result"=>"ok","id"=>$id));
     }else{
    	echo json_encode(Array("result"=>"name or domain in use"));
	}
 		   
}
else{
    echo json_encode(Array("result"=>"missingParams"));
}
 
?>