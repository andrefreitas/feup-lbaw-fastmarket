<?php
chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('storeFrontend.php');
chdir('../pages/store');

if(!isset($_GET["store"]) or !storeExists($_GET["store"])){
    header("Location: ../index.php");
}
$domain = $_GET["store"];
/* BEGIN -- Get store data */
// Logo
$logoPath = "../../files/" . getStoreLogo($domain);

// Categories
// Products
/* END -- Get store data */


$smarty->assign('title', "Welcome");
$smarty->assign('logoPath', $logoPath);
$smarty->display('store/home.tpl');

?>