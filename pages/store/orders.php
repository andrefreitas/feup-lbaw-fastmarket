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
$logoPath = getStoreLogo($domain);

// Categories
$categories = getCategories($storeId);

// Orders
$orders = array();


// Vat
$vat_oux = getStoreById($storeId);
$vat=$vat_oux[0]["vat"];

//loged in user

$smarty->assign('userPermission', 'guest');
if(isset($_SESSION['storesLogin'][$storeId]['userId'])){
    $userInfo = $_SESSION['storesLogin'][$storeId]['userId'];
    $orders = getOrdersOfUser($userInfo);
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

$storeName = getStoreName($domain);
$smarty->assign('title', $storeName . " My Orders");
$smarty->assign('logoPath', $logoPath);
$smarty->assign('categories', $categories);
$smarty->assign('orders', $orders);
$smarty->assign('storeDomain', $domain);
$smarty->assign('storeId', $storeId);
$smarty->assign('vat', $vat);

$smarty->display('store/orders.tpl');

?>