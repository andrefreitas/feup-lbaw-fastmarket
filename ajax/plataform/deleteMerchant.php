<?php
chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('plataform.php');
chdir('../ajax/plataform');

header('Content-type: application/json');

if (isset($_GET['id'])) {
    deleteMerchant($_GET['id']);
    echo json_encode(Array("result"=>"ok"));

} else {
    echo json_encode(Array("result"=>"error"));
}

?>