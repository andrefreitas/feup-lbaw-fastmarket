<?php
chdir('../common');
require_once('init.php');
chdir('../pages');

$smarty->assign('title','Merchant registration');
$smarty->assign('loggedin',isset($_SESSION['id']));
$smarty->display('register.tpl');
?>