<?php
chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('storeFrontend.php');
require_once('plataform.php');
chdir('../pages/store');

if(!isset($_GET["store"]) or !storeExists($_GET["store"])){
    header("Location: ../index.php");
}else if(!isset($_GET["id"])) {
    
    header("Location: ". $_GET["store"]);
}

// Update paths
/*
$updatePath = function($elem){
    $elem["file"] = "../../files/" . $elem["file"];
    return $elem;
};
*/
/*
function updatePath($elem){
	$elem["file"] = "../../files/" . $elem["file"];
    return $elem;
};
*/

/* BEGIN -- Get store data */
$domain = $_GET["store"];
$storeId = getStoreId($domain);
$vat_oux = getStoreById($storeId);
$vat=$vat_oux[0]["vat"];

// Logo
$logoPath = "../../files/" . getStoreLogo($domain);

// Categories
$categories = getCategories($storeId);

// Product
$id = intval($_GET["id"]);
$product = getProduct($id);
$product["file"] = "../../files/".$product["file"];
$price=$product["price"]*(1+$vat);

$comments=getCommentsOfProduct($id);

if(isset($_SESSION['storesLogin'][$storeId]['userId'])){
    $userInfo = $_SESSION['storesLogin'][$storeId]['userId'];
    $smarty->assign('userInfo', $userInfo);
    if(isset($userInfo))
    {
        $userInfo = getuserById($userInfo);
    }
}
/* END -- Get store data */


$smarty->assign('title', "Product");
$smarty->assign('logoPath', $logoPath);
$smarty->assign('categories', $categories);
$smarty->assign('product', $product);
$smarty->assign('productId', $id);
$smarty->assign('storeDomain', $domain);
$smarty->assign('storeId', $storeId);
$smarty->assign('price', $price);
$smarty->assign('comments', $comments);
$smarty->display('store/product.tpl');

?>
