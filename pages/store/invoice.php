<?php
chdir("../../common");
require_once("init.php");
if(isset($_GET["orderId"])){
    $smarty->display('store/invoice.tpl');
}
?>