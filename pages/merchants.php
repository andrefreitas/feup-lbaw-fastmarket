<?php
chdir('../common');
require_once('init.php');
chdir('../database');
require_once('plataform.php');
chdir('../pages');

if(!isset($_SESSION['permission']) or $_SESSION['permission']!='admin'){
    header("Location: index.php");
}

$smarty->assign('title','Merchants');
$smarty->assign('loggedin',isset($_SESSION['id']));
$smarty->assign('merchants',getMerchants());
$smarty->display('merchants.tpl');
?>