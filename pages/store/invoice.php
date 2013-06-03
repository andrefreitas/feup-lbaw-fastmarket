<?php
chdir("../../common");
require_once("init.php");
chdir("../database");
require_once("storeAccount.php");
if(isset($_GET["orderId"])){
    // Get order itens
    $orderId = intval($_GET["orderId"]);
    $items = getOrderItens($orderId);
    $smarty->assign("items", $items);
    $invoice = getOrderInvoice($orderId);
    $order = getOrder($orderId);
    $paid = $order["paid"];
    $smarty->assign("invoice", $invoice);
    $smarty->assign("paid", $paid);
    $smarty->display('store/invoice.tpl');
}
?>