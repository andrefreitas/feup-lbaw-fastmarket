<?php
chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('storeFrontend.php');
require_once('storeAccount.php');
require_once('store_backoffice.php');
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

//customers orders
$ordersInfo= getCustomersOrders($storeId);

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
}else{
	header("Location: ../store/index.php?store=" . $domain);
}
/* END -- Get store data */


$smarty->assign('title', "Welcome");
$smarty->assign('logoPath', $logoPath);
$smarty->assign('categories', $categories);
$smarty->assign('storeId', $storeId);
$smarty->assign('storeDomain', $domain);
$smarty->assign('ordersInfo', $ordersInfo);
$smarty->display('store/customersorders.tpl');

?>