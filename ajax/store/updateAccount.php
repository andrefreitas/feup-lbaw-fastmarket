<?php
chdir("../../database");
require_once("storeAccount.php");
if(isset($_GET["userId"]) && $_GET["userId"] >= 0){

	if(isset($_GET["name"]) && strlen($_GET["name"])>=1)
	{
		setAccountName($_GET["userId"],$_GET["name"]);
	}
	
	if(isset($_GET["email"]) && strlen($_GET["email"])>=1)
	{
		setAccountEmail($_GET["userId"],$_GET["email"]);
	}
	
	if(isset($_GET["password"]) && strlen($_GET["password"])>=1)
	{
		$password = hash('sha256',$_GET['password']);
		setAccountPass($_GET["userId"],$password);
	}
	
    echo json_encode(array("result" => "ok"));
	
}else{
    echo json_encode(array("result" => "missingParams"));
}
?>