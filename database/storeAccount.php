<?php
if(isset($_SERVER['HTTP_HOST']) and  $_SERVER['HTTP_HOST'] == 'gnomo.fe.up.pt')
    require_once('/opt/lbaw/lbaw12503/public_html/fastmarket/common/database.php');
else{
    $documentRoot = $_SERVER["DOCUMENT_ROOT"];
    if($_SERVER["DOCUMENT_ROOT"] == ""){
        $documentRoot = "/home/andre/git";
    }
    require_once($documentRoot .'/fastmarket/common/database.php');
}

function login($userEmail, $pass)
{
	$sql = "SELECT * FROM users
			WHERE email=? AND password=?;";
	return query($sql, array($userEmail,$pass));
}

function register1Step($userName, $userEmail, $pass)
{
	$sql = "INSERT INTO users(name,email,password,registration_date,privilege_id)
			VALUES (?,?,?,CURRENT_TIMESTAMP,(SELECT id FROM privileges WHERE name='costumer'));";
	return query($sql, array($userName, $userEmail, $pass));
}

function register2Step($userId, $storeId)
{
	$sql = "INSERT INTO stores_users(user_id,store_id) VALUES(?,?);";
	return query($sql, array($userId, $storeId));
}

function getSubscriptions($userId)
{
	$sql = "SELECT products.id, products.name, products.description, products.base_cost AS price, 
			categories.name AS category, files.path AS file
			FROM products,categories,files,products_subscriptions
			WHERE products.category_id=categories.id AND files.id=products.image_id 
			AND products.id=products_subscriptions.product_id AND products_subscriptions.user_id=?
			ORDER BY subscription_date DESC;";
	return query($sql, array($userId));
}

function removeSubscription($userId, $productId)
{
	$sql = "DELETE FROM products_subscriptions
			WHERE user_id=? AND product_id=?;";
	return query($sql, array($userId, $productId));
}

function getAccount($userId)
{
	$sql = "SELECT * FROM users
			WHERE id=?;";
	return query($sql, array($userId));
}

function getFavorites($userId)
{
	$sql = "SELECT products.id, products.name, products.description, products.base_cost AS price, 
			categories.name AS category, files.path AS file
			FROM products,categories,files,favorites
			WHERE products.category_id=categories.id AND files.id=products.image_id 
			AND products.id=favorites.product_id AND favorites.user_id=?;";
	return query($sql,array($userId));
}

function removeFavorite($userId, $productId)
{
	$sql = "DELETE FROM favorites
			WHERE user_id=? AND product_id=?; ";
	return query($sql,array($userId,$productId));
}

function setAccountName($userId, $name)
{
	$sql = "UPDATE users
			SET name=?
			WHERE id=?;";
	return query($sql,array($name,$userId));
}

function setAccountEmail($userId, $email)
{
	$sql = "UPDATE users
			SET email=?
			WHERE id=?;";
	return query($sql,array($email, $userId));
}

function setAccountPass($userId, $pass)
{
	$sql = "UPDATE users
			SET password=?
			WHERE id=?;";
	return query($sql,array($pass, $userId));
}

function getOrders($userId)
{
	$sql = "SELECT orders.id, order_date AS DATE,invoice.total
			FROM orders,invoice
			WHERE costumer_id=? AND orders.id=invoice.order_id;";
	return query($sql,array($userId));
}

function getProductsOfOrder($orderId)
{
	$sql = "SELECT products.id, products.name, products.description, products.base_cost AS price, 
			categories.name AS category, files.path AS file
			FROM products,categories,files,orders_products
			WHERE products.category_id=categories.id AND files.id=products.image_id 
			AND products.id=orders_products.product_id AND orders_products.order_id=?;";
	return query($sql, array($orderId));
}

function getInvoice($orderId)
{
	$sql = "SELECT * 
			FROM invoice
			WHERE order_id=?;";
	return query($sql,array($orderId));
}
?>