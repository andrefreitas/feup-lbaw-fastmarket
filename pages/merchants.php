<?php
chdir('../common');
require_once('init.php');
chdir('../database');
require_once('plataform.php');
chdir('../pages');

if(isset($_SESSION['permission']) and $_SESSION['permission']=='admin'){
    $merchants = getMerchants();
    $total = count($merchants);
    $smarty->assign('title','Merchants');
    $smarty->assign('loggedin',isset($_SESSION['id']));
    $smarty->assign('merchants',$merchants);
    $smarty->assign('total', $total);
    $smarty->display('merchants.tpl');
}

?>