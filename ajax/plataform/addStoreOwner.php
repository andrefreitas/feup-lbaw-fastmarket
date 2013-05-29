<?php
header('Content-type: application/json');

chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('plataform.php');
chdir('../actions');
require_once('plataform.php');
chdir('../ajax/plataform');

if( isset($_GET['email']) and isset($_GET['domain']) ){
    $merchantEmail = (string) $_GET['email'];
    $storeDomain = (string) $_GET['domain'];
    $merchantId = getMerchantByEmail($merchantEmail)["id"];
    $storeId = getStoreId($storeDomain);
    addStoreOwner($storeId, $merchantId );
    echo json_encode(Array("result"=>"ok"));
}
else{
    echo json_encode(Array("result"=>"missingParams"));
}
 
?>