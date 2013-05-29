<?php
chdir("../../database");
require_once("storeAccount.php");

if(isset($_GET["storeId"]) and isset($_GET["name"]) and isset($_GET["email"]) and isset($_GET["password"])){

	$password = hash('sha256',$_GET['password']);
    addCostumer($_GET["storeId"], $_GET["name"], $_GET["email"], $password);
    echo json_encode(array("result" => "ok"));
}else{
    echo json_encode(array("result" => "missingParams"));
}
?>