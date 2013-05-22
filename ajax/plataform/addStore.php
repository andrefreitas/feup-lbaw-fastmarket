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
	and isset($_GET['domain']) and isset($_GET['logo']) ){
     
    createStore($_GET['name'],$_GET['slogan'],$_GET['vat'],$_GET['domain'],$_GET['logo']);
}
else{
    echo json_encode(Array("result"=>"missingParams"));
}
 
?>