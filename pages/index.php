<?php
    require_once('../common/init.php');
    $smarty->assign('BASE_URL',$BASE_URL);
    $smarty->assign('title','Welcome to Fastmarket');
    $smarty->assign('loggedin',isset($_SESSION['id']));
    $smarty->display('home.tpl');
?>