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
$logoPath = getStoreLogo($domain);

// Categories
$categories = getCategories($storeId);

// Vat
$vat_oux = getStoreById($storeId);
$vat=$vat_oux[0]["vat"];

//logged in user

$smarty->assign('userPermission', 'guest');
if(isset($_SESSION['storesLogin'][$storeId]['userId'])){
    $userInfo = $_SESSION['storesLogin'][$storeId]['userId'];
    
    if(isset($userInfo))
    {
    	$userInfo = getuserById($userInfo);
    }
    $smarty->assign('userInfo', $userInfo);
}

// Get cart products

$cartProducts = array();
$total = 0;
$totalVat = 0;
if(isset($_SESSION['storesLogin'][$storeId]["cart"])){
    $cart = $_SESSION['storesLogin'][$storeId]["cart"];
    foreach($cart as $item){
        $product = getProduct($item["id"]);
        $product["quantity"] = $item["qt"];
        $product["subtotal"] = $item["qt"] * $product["price"];
        $total += $product["subtotal"];
        $cartProducts[] = $product;
        
    }
}
$totalVat = (1 + $vat) * $total;
/* END -- Get store data */


$smarty->assign('title', "Cart");
$smarty->assign('logoPath', $logoPath);
$smarty->assign('categories', $categories);
$smarty->assign('storeDomain', $domain);
$smarty->assign('storeId', $storeId);
$smarty->assign('total', $total);
$smarty->assign('totalVat', $totalVat);
$smarty->assign('vat', $vat);
$smarty->assign('cartProducts', $cartProducts);
$smarty->display('store/cart.tpl');

?>