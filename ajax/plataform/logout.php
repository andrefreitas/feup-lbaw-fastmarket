<?php
header('Content-type: application/json');
require_once('../../common/init.php');
require_once('../../database/plataform.php');
session_destroy();
echo json_encode(Array("result"=>"ok"));
?>