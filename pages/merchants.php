<?php
    require_once('../common/init.php');
    require_once('../database/plataform.php');
    if(!isset($_SESSION['permission']) or $_SESSION['permission']!='admin'){
        header("Location: index.php");
    }
    $smarty->assign('BASE_URL',$BASE_URL);
    $smarty->assign('title','Merchants');
    $smarty->assign('loggedin',isset($_SESSION['id']));
    $smarty->assign('merchants',getMerchants());
    $smarty->display('merchants.tpl');
?>