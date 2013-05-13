<?php
chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('plataform.php');
chdir('../ajax/plataform');

header('Content-type: application/json');
session_destroy();
echo json_encode(Array("result"=>"ok"));
?>