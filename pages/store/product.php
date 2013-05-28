<?php
chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('storeFrontend.php');
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

// Product
$id = intval($_GET["id"]);
$product = getProduct($id);

/* END -- Get store data */


$smarty->assign('title', "Welcome");
$smarty->assign('logoPath', $logoPath);
$smarty->assign('categories', $categories);
$smarty->assign('product', $product);
$smarty->assign('storeId', $storeId);
$smarty->display('store/product.tpl');

?>