<?php
	require_once('../common/database.php');
	
	function register_merchant($name,$email,$password){
		global $db;
		$result=$db->prepare("INSERT INTO users(name,email,password,registration_date,privilege_id)".
				    "VALUES(?,?,?,CURRENT_TIMESTAMP,(SELECT id FROM privileges WHERE name='merchant'))");
		$result->execute(array($name,$email,$password));
	}
?>