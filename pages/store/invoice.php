<?php
chdir("../../common");
require_once("init.php");
chdir("../database");
require_once("storeAccount.php");
if(isset($_GET["orderId"])){
    
   
    $orderId = intval($_GET["orderId"]);
    $userId = getOrderUserId($orderId);
    $storeId = getUserStoreID($userId);
    
    
    if( isset($_SESSION['storesLogin'][$storeId]['userId'])){
        $permission =  getAccountPermission($_SESSION['storesLogin'][$storeId]['userId']);
        $permission = $permission["name"];
        if($_SESSION['storesLogin'][$storeId]['userId'] == $userId  or 
        $permission == "merchant"){
            $items = getOrderItens($orderId);
            $smarty->assign("items", $items);
            $invoice = getOrderInvoice($orderId);
            $order = getOrder($orderId);
            $paid = $order["paid"];
            $smarty->assign("invoice", $invoice);
            $smarty->assign("order", $order);
            $smarty->assign("paid", $paid);
            $smarty->display('store/invoice.tpl');
        }
    }
  


    
}
?>