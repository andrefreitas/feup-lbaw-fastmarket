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


function getStoreProducts($storeId, $limit){
    $sql = "SELECT products.id, products.name, products.description, products.base_cost AS price, "
         . "categories.name AS category, files.path AS file "
         . "FROM products,categories,files "
         . "WHERE products.category_id = categories.id AND categories.store_id = ? "
         . "AND files.id = products.image_id "
         . "ORDER BY insertion_date DESC "
         . "LIMIT ?";
    return query($sql, array($storeId, $limit)); 
}

function getStoreProductsOnStock($storeId, $limit){
    $sql = "SELECT products.id, products.name, products.description, products.base_cost AS price, "
         . "categories.name AS category, files.path AS file "
         . "FROM products,categories,files "
         . "WHERE products.category_id = categories.id AND categories.store_id = ? "
         . "AND files.id = products.image_id AND products.stock > 0"
         . "ORDER BY insertion_date DESC "
         . "LIMIT ?";
    return query($sql, array($storeId, $limit)); 
}

function getCategories($storeId)
{
	$sql = "SELECT categories.id, categories.name
			FROM categories
			WHERE store_id=?";
	
	return query($sql, array($storeId));

}

function searchOnStore($storeId, $searchTerm, $limit)
{
	$sql = "SELECT products.id, products.name, products.description, products.base_cost AS price, 
			categories.name AS category, files.path AS file
			FROM products,categories,files
			WHERE products.category_id=categories.id AND categories.store_id=? AND files.id=products.image_id
			AND (products.description ~* ? OR products.name ~* ? OR categories.name ~* ?)
			ORDER BY insertion_date DESC
			LIMIT ?";
	return query($sql, array($storeId, $searchTerm, $searchTerm, $searchTerm, $limit));
}

function getProduct($productId)
{
	$sql = "SELECT products.id, products.name, products.description, products.base_cost AS price, 
			products.stock, products.score, categories.name AS category, files.path AS file
			FROM products,categories,files
			WHERE products.id=? AND products.category_id=categories.id AND files.id=products.image_id";
	return query($sql, array($productId));
}

function getCommentsOfProduct($productId)
{
	$sql = "SELECT comments.id, comments.body,comments.comment_date AS DATE, users.name
			FROM comments,users
			WHERE comments.product_id=? AND comments.user_id=users.id";
	return query($sql, array($productId));
}

function setFavorite($userId, $productId){
	$sql = "INSERT INTO favorites(user_id,product_id) VALUES(?,?)";
	
	query($sql, array($userId,$productId));

}

function insertComment($productId, $userId, $comment)
{
	$sql = "INSERT INTO comments(product_id, user_id,body,comment_date)
			VALUES (?,?,?,CURRENT_TIMESTAMP)";
	return query($sql, array($productId, $userId, $comment));

}

function setSubscription($userId, $productId)
{
	$sql = "INSERT INTO products_subscriptions(product_id,user_id,subscription_date)
			VALUES (?,?,CURRENT_TIMESTAMP)";
	return query($sql, array($productId,$userId));
}

function getContactsFile($storeId)
{
	$sql = "SELECT path
			FROM files,stores_files
			WHERE files.id=stores_files.file_id AND name ~* 'contacts' AND stores_files.store_id=?";
	return query($sql,array($storeId));
}

function getProductsOfCategory($categoryId)
{
	$sql = "SELECT products.id, products.name, products.description, products.base_cost AS price, 
			products.stock, products.score, categories.name AS category, files.path AS file
			FROM products,categories,files
			WHERE categories.id=? AND products.category_id=categories.id AND files.id=products.image_id";
	return query($sql,array($categoryId));
}

function evaluateProduct($productId, $userId, $score)
{
	$sql = "INSERT INTO products_scores(product_id,user_id,score) VALUES (?,?,?)";
	return query($sql, array($productId, $userId, $score));
}

function newOrder($userId )
{
	$sql = "INSERT INTO orders(costumer_id,paid,order_date) VALUES (?,'false',CURRENT_TIMESTAMP)";
	return query($sql, array($userId));
}

function addProductToOrder($orderId, $productId, $quantity, $baseCost)
{
	$sql = "INSERT INTO orders_products(product_id,order_id,quantity,base_cost) 
			VALUES(?,?,?,?)";
	return query($sql, array($productId, $orderId, $quantity, $baseCost));
}

function getAboutFile($storeId)
{
	$sql = "SELECT path
			FROM files,stores_files
			WHERE files.id=stores_files.file_id AND name ~* 'about' AND stores_files.store_id=?";
	return query($sql, array($storeId));
}

?>