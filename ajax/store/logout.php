<?php
header('Content-type: application/json');
chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('storeAccount.php');
chdir('../ajax/store');

if (isset($_GET['storeId'])) {
    
	    $_SESSION['storesLogin'][$_GET['storeId']]['userId']=null;
	    echo json_encode(Array("result"=>"ok"));
  }
?>