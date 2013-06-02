<?php
chdir("../../common");
require_once("init.php");
chdir("../database");
require_once("storeFrontend.php");

// Get data
$storeId = intval($_GET["storeId"]);
$userId = $_SESSION['storesLogin'][$storeId]['userId'];
$cart = $_SESSION['storesLogin'][$storeId]['cart'];

// Create order
$orderId = newOrder($userId);
$total = 0;
foreach($cart as $item){
    $productId = $item["id"];
    $quantity = $item["qt"];
    $baseCost = getProduct($productId);
    $baseCost = $baseCost["price"];
    $total += $quantity * $baseCost;
    addProductToOrder($orderId, $productId, $quantity, $baseCost);
}

// Create an invoice
$code = substr(str_shuffle(md5(time())),0,10);
$store = getStoreById($storeId);
$domain = $store[0]["domain"];
$vat = $store[0]["vat"];
$total *= 1 + $vat; 
$id = createInvoice($code, $total, $vat, $orderId);


// Clear cart
$_SESSION['storesLogin'][$storeId]['cart'] = array();

header("Location: ../../pages/store/invoice.php?id=".$id);
?>