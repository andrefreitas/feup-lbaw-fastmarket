<?php
header('Content-type: application/json');

chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('plataform.php');
chdir('../actions');
require_once('plataform.php');
chdir('../ajax/plataform');

if( isset($_GET['year'])){
    $year = intval($_GET['year']);
    $stores = $storesByMonths = getNewStoresByMonths($year);
    echo json_encode(Array("result"=>"ok", "stores" => $stores));
}
else{
    echo json_encode(Array("result"=>"missingParams"));
}
 
?>