<?php
header('Content-type: application/json');

chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('plataform.php');
chdir('../ajax/plataform');

if (isset($_GET['id']) and isset($_GET['name']) and isset($_GET['slogan']) and isset($_GET['vat']) 
	and isset($_GET['domain'])) {
    $id = $_GET['id'];
    
   echo updateStore($id,$_GET['name'],$_GET['slogan'],$_GET['domain'],$_GET['vat'],null);
    
    
    echo json_encode(Array("result"=>"ok"));

}
else {
    echo json_encode(Array("result"=>"missingParams"));
}

?>