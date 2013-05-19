<?php
header('Content-type: application/json');

chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('plataform.php');
chdir('../ajax/plataform');

if(isset($_GET["status"])){
    $merchants = array();
    if($_GET["status"]=="any"){
        $merchants = getMerchants();
    }else {
        $merchants = getMerchants($_GET["status"]);
    }
    echo json_encode($merchants);
}else if (isset($_GET["search"])){
    $term = $_GET["search"];
    $merchants = searchMerchants($term);
    echo json_encode($merchants);
}

else{
    $merchants = getMerchants();
    echo json_encode($merchants);
}


?>