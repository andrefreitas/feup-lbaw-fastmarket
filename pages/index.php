<?php
chdir('../common');
require_once('init.php');
chdir('../pages');

if(isset($_SESSION["id"]))
    header("Location: administration.php");
if(isset($_GET["welcome"])){
    $smarty->assign('welcome',$_GET["welcome"]);
}

$smarty->assign('title','Welcome to Fastmarket');
$smarty->assign('loggedin',isset($_SESSION['id']));
$smarty->display('home.tpl');
?>