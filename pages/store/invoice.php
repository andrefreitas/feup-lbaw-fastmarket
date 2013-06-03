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
    $smarty->display('store/invoice.tpl');
}
?>