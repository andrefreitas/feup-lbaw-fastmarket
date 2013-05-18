<?php
chdir('../common');
require_once('init.php');
chdir('../pages');

if(!isset($_SESSION["id"]))
    header("Location: index.php");

$smarty->assign('title','Administration');
$smarty->display('administration.tpl');
?>