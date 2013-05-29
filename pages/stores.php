<?php
chdir('../common');
require_once('init.php');
chdir('../database');
require_once('plataform.php');
chdir('../pages');

if(isset($_SESSION['permission']) and ($_SESSION['permission']=='admin' or $_SESSION['permission']=='merchant') ){
    if($_SESSION['permission']=='merchant'){
        $stores = getStores($_SESSION['id']);
    }else{
        $stores = getStores();
    }
   
    $total = count($stores);
    $smarty->assign('title','Stores');
    $smarty->assign('loggedin',isset($_SESSION['id']));
    $smarty->assign('stores',$stores);
    $smarty->assign('total', $total);
    $smarty->assign('user', $_SESSION["name"]);
    $smarty->assign('permission', $_SESSION['permission']);
    $smarty->display('stores.tpl');
}else{
    header("Location: index.php");
}

?>