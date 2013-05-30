<?php
header('Content-type: application/json');
chdir('../../common');
require_once('init.php');

chdir('../ajax/store');


$_SESSION['storesLogin'][$_GET['storeId']]['userId']=null;
echo json_encode(Array("result"=>"ok"));
 
?>