<?php
chdir('../../common');
require_once('init.php');
chdir('../pages/store');

$smarty->assign('title', "Welcome");
$smarty->display('store/home.tpl');

?>