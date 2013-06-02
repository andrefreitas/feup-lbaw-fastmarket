<?php
chdir('../common');
require_once('database.php');
chdir('../database');
	
	
	/*
		get profits by months
	*/
	function getProfitsByMonths($store_id, $init_date, $end_date)
	{
		$sql= "SELECT SUM(invoice.total)
				FROM invoice, orders, stores_users, transactions
				WHERE invoice.order_id=orders.id AND stores_users.store_id=? AND
					orders.costumer_id=stores_users.user_id AND orders.paid='true' AND
					orders.transaction_id=transactions.id AND
					transactions.transaction_date >= ? AND 
					transactions.transaction_date < ?";
		return query($sql,array($store_id, $init_date, $end_date));
	}
	
	/*
		get profits by products
	*/
	function getProfitsByProducts($store_id)
	{
		$sql="SELECT orders_products.product_id, SUM(orders_products.base_cost*(invoice.vat+1.0)) AS profits
				FROM orders_products, invoice, orders, stores_users
				WHERE invoice.order_id=orders.id AND stores_users.store_id=? AND
						orders.costumer_id=stores_users.user_id AND orders.paid='true' AND
						orders_products.order_id=orders.id
				GROUP BY orders_products.product_id
				ORDER BY profits DESC";
		return query($sql,array($store_id));
	
	}
	
	/*
		get last paid orders (by products)
	*/
	function getLastPaidOrders($store_id)
	{
		$sql="SELECT products.id AS productId, products.name, users.name, users.id AS userId, 
				orders_products.base_cost*(invoice.vat+1.0) AS profit, 
				orders.id, transactions.transaction_date
				FROM products, users, stores_users, orders, invoice, orders_products, transactions, privileges
				WHERE products.id=orders_products.product_id AND orders_products.order_id=orders.id AND
						invoice.order_id=orders.id AND orders.costumer_id = stores_users.user_id AND
						stores_users.store_id=? AND stores_users.user_id=users.id AND 
						privileges.name='costumer' AND privileges.id=users.privilege_id AND
						orders.paid='true' AND orders.transaction_id=transactions.id
				ORDER BY transactions.transaction_date DESC";
		return query($sql,array($store_id));
	}
	
	/*
		get costumers
	*/
	function getCostumers($store_id)
	{
		$sql="SELECT users.id, users.name, users.registration_date, users.email
				FROM users, stores_users, privileges
				WHERE stores_users.user_id=users.id AND stores_users.store_id=? AND
						users.privilege_id=privileges.id AND privileges.name='costumer'";
		return query($sql, array($store_id));
	}
	
	/*
		get costumers (with filter)
	*/
	function getCostumersFilter($store_id,$filter)
	{
		$sql="SELECT users.id, users.name, users.registration_date, users.email
				FROM users, stores_users, privileges
				WHERE stores_users.user_id=users.id AND stores_users.store_id=? AND
						users.privilege_id=privileges.id AND privileges.name='costumer' AND
						users.name ~* ?";
		return query($sql,array($store_id,$filter));
	}
	
	/*
		get transactions
	*/
	function getTransactions($store_id)
	{
		$sql="SELECT * 
				FROM transactions
				WHERE transactions.store_id=? 
				ORDER BY transactions.transaction_date DESC";
		return query($sql,array($store_id));
	}
	
	/*
		get design files
	*/
	function getDesignFiles($store_id)
	{
		$sql_old="SELECT * 
				FROM stores LEFT OUTER JOIN 
				    (SELECT * 
				     FROM stores_files, files 
				     WHERE files.id=stores_files.file_id) AS foo
				ON (foo.store_id=stores.id)";
		$sql = "SELECT files.path
				FROM stores, files, stores_files
				WHERE stores.id=? AND files.id=stores_files.file_id AND stores.id=stores_files.store_id";
		return query($sql,array($store_id));
	}
	
	/*
		update costumer
	*/
	function updateCostumer($costumer_id, $name, $email, $password, $privilege_id)
	{
		$sql="UPDATE users SET name = ?, email = ?, password = ?, privilege_id=?
            WHERE id = ?";
		return query($sql,array($name, $email, $password, $privilege_id, $costumer_id));
	}
	
	/*
		get costumer
	*/
	function getCostumer($costumer_id)
	{
		$sql="SELECT *
				FROM users
				WHERE users.id=?";
		return query($sql,array($costumer_id));
	}
	
	/*
		Add Transaction
	*/
	function addTransaction($amount, $description, $store_id)
	{
		$sql="INSERT INTO transactions(transaction_date,amount,description,store_id) 
				VALUES (CURRENT_TIMESTAMP,?,?,?)";
		return query($sql,array($amount, $description, $store_id));
	}
	
	/*
		update design
	*/
	function updateDesign($file_id, $store_id, $fileName, $path)
	{
		$sql="DELETE FROM files WHERE id=?";
		query($sql,array($file_id));
		
		$sql="INSERT INTO files (name , path) 
				VALUES (?,?);
				INSERT INTO stores_files (file_id, store_id) 
				VALUES ((SELECT last_value FROM files_id_seq),?)";
		query($sql,array($fileName, $path, $store_id));
	}
	
	/*
		get orders
	*/
	function getOrders($store_id)
	{
		$sql="SELECT *
				FROM orders, stores_users, users
				WHERE orders.costumer_id=stores_users.user_id AND stores_users.store_id=? AND
						users.id=stores_users.user_id";
		return query($sql,array($store_id));
	}
	
	/*
		get products
	*/
	function getProducts($store_id)
	{
		$sql="SELECT *
				FROM products, categories, products_images, files
				WHERE categories.store_id=? AND products.category_id=categories.id AND
						products_images.product_id=products.id AND products_images.file_id=files.id";
		return query($sql,array($store_id));
	}
	
	/*
		get file
	*/
	function getFile($file_id)
	{
		$sql="SELECT * 
				FROM files
				WHERE id=?";
		return query($sql,array($file_id));
	}
	
	/*
		get order
	*/
	function getOrder($order_id)
	{
		$sql="SELECT *
				FROM orders, users, invoice
				WHERE orders.costumer_id=users.id AND orders.id=? AND invoice.order_id=orders.id";
		return query($sql,array($order_id));
	}
	
	/*
		add product
	*/
	function addProduct($name,$description,$base_cost,$stock,$category_id,$image_id)
	{
		$sql="INSERT INTO products(name,description,base_cost,stock,insertion_date,category_id,image_id) 
				VALUES(?,?,?,?,CURRENT_TIMESTAMP,?,?)";
		return query($sql,array($name,$description,$base_cost,$stock,$category_id,$image_id));
	}
	
	/*
		remove product
	*/
	function removeProduct($product_id)
	{
		$sql="UPDATE products SET stock = 0
           		 WHERE id = ?";
		return query($sql,array($product_id));
	}
	
	/*
		search
	*/
	function serchUsers($store_id,$filter)
	{
		$sql="SELECT * 
				FROM users, stores_users
				WHERE users.id=stores_users.user_id AND
				stores_users.store_id=? AND users.name ~* ?";
		return query($sql,array($store_id,$filter));
	}
	function searchProductsAndCategories($store_id,$filter)
	{
		$sql="SELECT * 
				FROM products, categories 
				WHERE products.category_id=categories.id AND categories.store_id=? AND
						(products.name ~* ? OR categories.name ~* ?)";
		return query($sql,array($store_id,$filter,$filter));
	}
	
	/*
		update product
	*/
	function updateProduct($product_id, $name, $description, $base_cost, $stock, $category_id, $image_id)
	{
		$sql="UPDATE products SET 
				name=?, description=?, base_cost=?,	stock=?, category_id=?, image_id=?
				WHERE id = ?";
		return query($sql,array($name, $description, $base_cost, $stock, $category_id, $image_id, $product_id));
	}
	
	/*
		remove category
	*/
	function removeCategory($category_id)
	{
		$sql="DELETE FROM categories WHERE id=?";
		return query($sql,array($category_id));
	}
	
	/*
		add category
	*/
	function addCategory($name,$store_id,$image_id)
	{
		$sql="INSERT INTO categories(name,store_id,image_id) 
				VALUES(?,?,?)";
		return query($sql,array($name,$store_id,$image_id));
	}
	
	/*
		check category
	*/
	function checkCategory($name,$store_id)
	{
		$sql="SELECT * FROM categories WHERE name=? and store_id=?";
		return query($sql,array($name,$store_id));
	}
?>