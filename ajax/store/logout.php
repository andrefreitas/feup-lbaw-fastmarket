<?php
header('Content-type: application/json');
chdir('../../common');
require_once('init.php');

chdir('../ajax/store');

if(isset($_GET['storeId'])){
    unset($_SESSION['storesLogin'][$_GET['storeId']]['userId']);
echo json_encode(Array("result"=>"ok"));
}else{
echo json_encode(Array("result"=>"missingStoreId"));
}
?>