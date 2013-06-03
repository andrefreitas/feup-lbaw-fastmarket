<?php
chdir("../../database");
require_once("storeAccount.php");
if(isset($_GET["invoiceCode"])){
    $invoiceCode = $_GET["invoiceCode"];
    payInvoice($invoiceCode);
    echo json_encode(array("result" => "ok"));
}else{
    echo json_encode(array("result" => "missingParams"));
}
?>