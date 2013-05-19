<?php
header('Content-type: application/json');

chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('plataform.php');
chdir('../ajax/plataform');

if(isset($_GET["status"])){
    $merchants = getMerchants($_GET["status"]);
    echo json_encode($merchants);
}else{
    $merchants = getMerchants();
    echo json_encode($merchants);
}


?>