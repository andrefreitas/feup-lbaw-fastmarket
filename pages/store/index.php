<?php
chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('storeFrontend.php');
require_once('plataform.php');
chdir('../pages/store');

if(!isset($_GET["store"]) or !storeExists($_GET["store"])){
    header("Location: ../index.php");
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

// Products
$products = getStoreProductsOnStock($storeId, 10);
$products = array_map("updatePath", $products);

//loged in user

print_r($_SESSION);

$userInfo = $_SESSION['storesLogin'][$_GET['storeId']]['userId'];
if(isset($userInfo))
{
	$userInfo = getuserById($userInfo);
}

/* END -- Get store data */


$smarty->assign('title', "Welcome");
$smarty->assign('logoPath', $logoPath);
$smarty->assign('categories', $categories);
$smarty->assign('products', $products);
$smarty->assign('storeDomain', $domain);
$smarty->assign('storeId', $storeId);
$smarty->assign('userInfo', $userInfo);
$smarty->display('store/home.tpl');

?>