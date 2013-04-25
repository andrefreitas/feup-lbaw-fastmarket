<?php
    require_once('../common/init.php');
    $smarty->assign('BASE_URL',$BASE_URL);
    $smarty->assign('title','Merchant registration');
    $smarty->display('register.tpl');
?>