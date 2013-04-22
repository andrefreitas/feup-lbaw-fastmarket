<?php
	require_once('../common/database.php');
	
	/*usar add_merchant() em vez deste
		só usar este para registar admins
	*/
	function register($name,$email,$password,$privilege_id){
		global $db;
		$result=$db->prepare("INSERT INTO users(name,email,password,registration_date,privilege_id)".
				    "VALUES(?,?,?,CURRENT_TIMESTAMP,?)");
		$result->execute(array($name,$email,$password,$privilege_id));
	}
	
	function login($name,$password)
	{
		global $db;
        $result = $db->prepare("SELECT privilege_id FROM users WHERE name = ? AND password = ?");
        $result->execute(array($name, $password));
        $user = $result->fetch();
		
		return $user?$user['privilege_id']:false;
	}
	
	function get_recent_created_stores()
	{
		global $db;
		$result = $db->prepare("SELECT stores.creation_date, stores.id, stores.name, users.name".
							   "FROM stores, users, stores_users, privileges".
							   "WHERE stores.id=stores_users.store_id AND stores_users.user_id=users.id AND".
									"users.privilege_id=privileges.id AND privileges.name='merchant'".
							   "ORDER BY stores.creation_date DESC");
		return $result->fetchAll();
	}
	
	function get_stores_logos()
	{
		global $db;
		$result = $db->prepare("SELECT stores.id, files.path".
							   "FROM stores, files".
							   "WHERE stores.logo_id=files.id");
		return $result->fetchAll();
	} 
	
	function get_stores_profits($init_date, $end_date)
	{
		global $db;
		$result = $db->prepare("SELECT stores.id, stores.name, SUM(invoice.total)".
								"FROM invoice, orders, stores_users, transactions, stores".
								"WHERE invoice.order_id=orders.id AND stores.id=stores_users.store_id AND".
									"orders.costumer_id=stores_users.user_id AND orders.paid='true' AND".
									"orders.transaction_id=transactions.id AND ".
									"transactions.transaction_date >= '2013-04-01' AND". 
									"transactions.transaction_date < '2013-05-01'".
								"GROUP BY stores.id");
		return $result->fetchAll();
	}
	
	function get_about_file()
	{
		global $db;
		$result = $db->prepare("SELECT path".
								"FROM files".
								"WHERE name ~* 'about' AND name ~* 'plataform'");
		return $result->fetchAll();
	}
	
	function get_all_stores()
	{
		global $db;
		$result = $db->prepare("SELECT * FROM stores");
		return $result->fetchAll();
	}
	
	function get_user($user_id)
	{
		global $db;
		$result = $db->prepare("SELECT * FROM users WHERE id=?");
		$result->execute(array($user_id));
		return $result->fetchAll();
	}
	
	function update_account($user_id,$name, $email, $password, $privilege_id)
	{
		global $db;
		$result = $db->prepare("UPDATE users SET name = ?, email = ?, password = ?, privilege_id=? WHERE id = ?");
		$result->execute(array($name,$email,$password,$privilege_id,$user_id));
			
	}
	
	function add_store($name,$slogan,$domain,$vat,$logo_id)
	{
		global $db;
		$result = $db->prepare("INSERT INTO stores(name,slogan,DOMAIN,vat,creation_date,logo_id)". 
								"VALUES(?,?,?,?,CURRENT_TIMESTAMP,?)");
		$result->execute(array($name,$slogan,$domain,$vat,$logo_id));
	}
	
	function update_store($store_id,$name,$slogan,$domain,$vat,$logo_id)
	{
		global $db;
		$result = $db->prepare("UPDATE stores SET name=?,slogan=?,DOMAIN=?,vat=?,logo_id=? WHERE id = ?");
		$result->execute(array($name,$slogan,$domain,$vat,$logo_id,$store_id));
	}
	
	function delete_store($store_id)
	{
		global $db;
		$result = $db->prepare("DELETE FROM stores WHERE id=?");
		$result->execute(array($store_id));
	}
	
	function get_merchants()
	{
		global $db;
		$result = $db->prepare("SELECT * FROM users, privileges WHERE users.privilege_id=privileges.id AND privileges.name='merchant'");
		return $result->fetchAll();
	}
	
	function add_merchant($name,$email,$password){
		global $db;
		$result=$db->prepare("INSERT INTO users(name,email,password,registration_date,privilege_id)".
				    "VALUES(?,?,?,CURRENT_TIMESTAMP,(SELECT id FROM privileges WHERE name='merchant'))");
		$result->execute(array($name,$email,$password));
	}
	
	function update_merchant($merchant_id,$name,$email,$password)
	{
		global $db;
		$result=$db->prepare("UPDATE users SET name=?,email=?,password=? WHERE id = ?");
		$result->execute(array($name,$email,$password,$merchant_id));
	}
	
	function delete_merchant($merchant_id)
	{
		global $db;
		$result=$db->prepare("DELETE FROM users WHERE id=?");
		$result->execute(array($merchant_id));
	}
	
	
?>