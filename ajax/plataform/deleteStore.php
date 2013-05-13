<?php
header('Content-type: application/json');

chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('plataform.php');
chdir('../ajax/plataform');

if (isset($_GET['id'])) {
    deleteStore($_GET['id']);
    echo json_encode(Array("result"=>"ok"));
} else {
    echo json_encode(Array("result"=>"missingParams"));
}
?>