<?php
chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('storeFrontend.php');
require_once('storeAccount.php');
//require_once('plataform.php');
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
//print_r($products);
$products = array_map("updatePath", $products);

// Vat
$vat_oux = getStoreById($storeId);
$vat=$vat_oux[0]["vat"];

//loged in user

$smarty->assign('userPermission', 'guest');
if(isset($_SESSION['storesLogin'][$storeId]['userId'])){
    $userInfo = $_SESSION['storesLogin'][$storeId]['userId'];
    
    if(isset($userInfo))
    {
    	$userInfo = getAccount($userInfo);
    	$userPermission = getAccountPermission($userInfo["id"]);
    	$userPermission = $userPermission["name"];
    }
    $smarty->assign('userInfo', $userInfo);
    $smarty->assign('userPermission', $userPermission);
}
/* END -- Get store data */


$smarty->assign('title', "Welcome");
$smarty->assign('logoPath', $logoPath);
$smarty->assign('categories', $categories);
$smarty->assign('products', $products);
$smarty->assign('storeDomain', $domain);
$smarty->assign('storeId', $storeId);
$smarty->assign('vat', $vat);

$smarty->display('store/home.tpl');

?>