<?php
chdir('../common');
require_once('init.php');
chdir('../database');
require_once('plataform.php');
chdir('../pages');

if(!isset($_SESSION["id"]))
    header("Location: index.php");

// Last merchants
$lastMerchants = getMerchants();
$lastMerchants = array_slice($lastMerchants, 0, 5);
$smarty->assign('lastMerchants', $lastMerchants);

// Stores profits
$storesProfits = getStoresProfits('2010-01-01', '2014-01-01');
$storesProfits = array_slice($storesProfits, 0, 3);
$smarty->assign('storesProfits', $storesProfits);

// Get last stores logos
$storesLogos = getStoresLogos();
$storesLogos = array_slice($storesLogos, 0, 3);

// Update paths
function updatePath($elem){
    $elem["file"] = "../files/" . $elem["file"];
    return $elem;
};
$storesLogos = array_map("updatePath", $storesLogos);
$smarty->assign('storesLogos', $storesLogos);

$smarty->assign('user', $_SESSION["name"]);
$smarty->assign('title','Administration');
$smarty->display('administration.tpl');
?>