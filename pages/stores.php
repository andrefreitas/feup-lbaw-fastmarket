<?php
chdir('../common');
require_once('init.php');
chdir('../database');
require_once('plataform.php');
chdir('../pages');

if(isset($_SESSION['permission']) and $_SESSION['permission']=='admin'){
    $stores = getStores();
    $total = count($stores);
    $smarty->assign('title','Stores');
    $smarty->assign('loggedin',isset($_SESSION['id']));
    $smarty->assign('stores',$stores);
    $smarty->assign('total', $total);
    $smarty->display('stores.tpl');
}else{
    header("Location: index.php");
}

?>