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
	if($elem["filename"] != 'imageurl')
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

// Products
$userId=$_SESSION['storesLogin'][$storeId]['userId'];
if(!isset($userId))
{
	header("Location: ../store/index.php?store=" . $domain);
}
$products = getFavoriteProductsOfUser($userId);
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

$favoritesPage=1;
/* END -- Get store data */


$storeName = getStoreName($domain);
$smarty->assign('title', $storeName . " My Favorites");
$smarty->assign('logoPath', $logoPath);
$smarty->assign('categories', $categories);
$smarty->assign('products', $products);
$smarty->assign('storeDomain', $domain);
$smarty->assign('storeId', $storeId);
$smarty->assign('favoritesPage',$favoritesPage);
$smarty->assign('vat', $vat);

$smarty->display('store/home.tpl');

?>