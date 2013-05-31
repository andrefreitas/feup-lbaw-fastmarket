<?php
chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('storeFrontend.php');
require_once('storeAccount.php');
chdir('../pages/store');

if(!isset($_GET["store"]) or !storeExists($_GET["store"])){
    header("Location: ../index.php");
}else if(!isset($_SESSION["id"])) {
    
    header("Location: ". $_GET["store"]);
}

// Update paths

function updatePath($elem){
	$elem["file"] = "../../files/" . $elem["file"];
    return $elem;
};


/* BEGIN -- Get store data */
$domain = $_GET["store"];
$storeId = getStoreId($domain);

// Logo
$logoPath = "../../files/" . getStoreLogo($domain);

// Categories
$categories = getCategories($storeId);

// User data
$account = getAccount($_SESSION["id"]);

/* END -- Get store data */


$smarty->assign('title', "Welcome");
$smarty->assign('logoPath', $logoPath);
$smarty->assign('categories', $categories);
$smarty->assign('storeId', $storeId);
$smarty->assign('account', $account);
$smarty->display('store/account.tpl');

?>