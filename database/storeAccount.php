<?php
chdir('../common');
require_once('database.php');
chdir('../database');
/*
 * Login
*/

function login($userEmail, $pass)
{
	$sql = "SELECT * FROM users
			WHERE email=? AND password=?";
	return query($sql, array($userEmail,$pass));
}

/*
 * Login on store
*/

function loginOnStore($userEmail, $pass, $store)
{
	$sql = "SELECT users.id, users.name, users.email, users.privilege_id 
			FROM users, stores_users
			WHERE email=? AND password=? AND stores_users.user_id=users.id AND stores_users.store_id=?";
	return query($sql, array($userEmail,$pass ,$store ));
}

/*
 * Register new costumer 1º step
*/

function register1Step($userName, $userEmail, $pass)
{
	$sql = "INSERT INTO users(name,email,password,registration_date,privilege_id)
			VALUES (?,?,?,CURRENT_TIMESTAMP,(SELECT id FROM privileges WHERE name='costumer'))";
	return query($sql, array($userName, $userEmail, $pass));
}

/*
 * Register new costumer 2º step
*/

function register2Step($userId, $storeId)
{
	$sql = "INSERT INTO stores_users(user_id,store_id) VALUES(?,?)";
	return query($sql, array($userId, $storeId));
}

/** 
 * Adds a new costumer
 */

function addCostumer($storeId, $name, $email, $password){
    $sql = "INSERT INTO users(name,email,password,registration_date,privilege_id) "
	     . "VALUES (?,?,?,CURRENT_TIMESTAMP,(SELECT id FROM privileges WHERE name='costumer')) "
	     . "RETURNING id";
    $id = query($sql, array($name, $email, $password));
    $id = $id[0]["id"];
    $sql = "INSERT INTO stores_users(user_id,store_id) VALUES(?,?)";
    
    // Activate user
    activateUserById($id);
    
    return query($sql, array($id , $storeId));
}

/*
 *  Activate user
 */

function activateUserById($userId){
    $sql = "UPDATE users "
         . "SET active='true' "
         . "WHERE id = ?";
    query($sql, array($userId));
}

/*
 * Activate user by hash
*/

function activateUserByHash($hash){
    $userID = getActivationUserId($hash);
    if($userID){
        $sql = "UPDATE FROM users "
             . "SET active = 'true' "
             . "WHERE id = ?";
        query($sql, array($sql));
        return true;
    }
    return false;
}

/*
 * Get Subscriptions of user
*/

function getSubscriptions($userId)
{
	$sql = "SELECT products.id, products.name, products.description, products.base_cost AS price, 
			categories.name AS category, files.path AS file
			FROM products,categories,files,products_subscriptions
			WHERE products.category_id=categories.id AND files.id=products.image_id 
			AND products.id=products_subscriptions.product_id AND products_subscriptions.user_id=?
			ORDER BY subscription_date DESC";
	return query($sql, array($userId));
}

/*
 * Remove Subscription of user to some product
*/

function removeSubscription($userId, $productId)
{
	$sql = "DELETE FROM products_subscriptions
			WHERE user_id=? AND product_id=?";
	return query($sql, array($userId, $productId));
}

/*
 * Get account info of user
*/

function getAccount($userId)
{
	$sql = "SELECT * FROM users
			WHERE id=?";
	return query($sql, array($userId));
}

/*
 * Get favorites of user
*/

function getFavorites($userId)
{
	$sql = "SELECT products.id, products.name, products.description, products.base_cost AS price, 
			categories.name AS category, files.path AS file
			FROM products,categories,files,favorites
			WHERE products.category_id=categories.id AND files.id=products.image_id 
			AND products.id=favorites.product_id AND favorites.user_id=?";
	return query($sql,array($userId));
}

/*
 * Remove favorite of user
*/

function removeFavorite($userId, $productId)
{
	$sql = "DELETE FROM favorites
			WHERE user_id=? AND product_id=?";
	return query($sql,array($userId,$productId));
}

/*
 * Update account name
*/

function setAccountName($userId, $name)
{
	$sql = "UPDATE users
			SET name=?
			WHERE id=?";
	return query($sql,array($name,$userId));
}

/*
 * Update account email
*/

function setAccountEmail($userId, $email)
{
	$sql = "UPDATE users
			SET email=?
			WHERE id=?";
	return query($sql,array($email, $userId));
}

/*
 * Update account password
*/

function setAccountPass($userId, $pass)
{
	$sql = "UPDATE users
			SET password=?
			WHERE id=?";
	return query($sql,array($pass, $userId));
}

/*
 * Get orders of user
*/

function getOrders($userId)
{
	$sql = "SELECT orders.id, order_date AS DATE,invoice.total
			FROM orders,invoice
			WHERE costumer_id=? AND orders.id=invoice.order_id";
	return query($sql,array($userId));
}

/*
 * Get products of user
*/

function getProductsOfOrder($orderId)
{
	$sql = "SELECT products.id, products.name, products.description, products.base_cost AS price, 
			categories.name AS category, files.path AS file
			FROM products,categories,files,orders_products
			WHERE products.category_id=categories.id AND files.id=products.image_id 
			AND products.id=orders_products.product_id AND orders_products.order_id=?";
	return query($sql, array($orderId));
}

/*
 * Get invoice of order
*/

function getInvoice($orderId)
{
	$sql = "SELECT * 
			FROM invoice
			WHERE order_id=?";
	return query($sql,array($orderId));
}

/**
 * Costumer Exists
 */

function costumerExists($storeId, $email){
    $sql = "SELECT * "
            . "FROM users, stores_users "
                    . "WHERE users.id = stores_users.user_id AND stores_users.store_id = ? AND users.email = ? ";
    $result = query($sql, array($storeId, $email));
    return isset($result[0]);
}
?>