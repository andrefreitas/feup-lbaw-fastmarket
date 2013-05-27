<?php
chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('storeFrontend.php');
chdir('../pages/store');

if(!isset($_GET["store"]) or !storeExists($_GET["store"])){
    header("Location: ../index.php");
}

// Update paths
$updatePath = function($elem){
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
$products = array_map($updatePath, $products);

/* END -- Get store data */


$smarty->assign('title', "Welcome");
$smarty->assign('logoPath', $logoPath);
$smarty->assign('categories', $categories);
$smarty->assign('products', $products);
$smarty->assign('storeDomain', $domain);
$smarty->assign('storeId', $storeId);
$smarty->display('store/home.tpl');

?>