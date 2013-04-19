/* SQL for the pages of the store frontend module */

-- #P201 - Admin

-- profits by months
-- param(store_id, init_date, end_date)
SELECT SUM(invoice.total)
FROM invoice, orders, stores_users, transactions
WHERE invoice.order_id=orders.id and stores_users.store_id=1 and
		orders.costumer_id=stores_users.user_id and orders.paid='true' and
		orders.transaction_id=transactions.id
		transactions.transaction_date >= '2013-04-01' and transactions.transaction_date < '2013-05-01';
		
		
-- profits by products 
-- param(store_id)
SELECT orders_products.product_id, SUM(orders_products.base_cost*(invoice.vat+1.0)) as profits
FROM orders_products, invoice, orders, stores_users
WHERE invoice.order_id=orders.id and stores_users.store_id=1 and
		orders.costumer_id=stores_users.user_id and orders.paid='true' and
		orders_products.order_id=orders.id
GROUP BY orders_products.product_id
ORDER BY profits DESC;

-- last paid orders (by products)
-- param(store_id)
SELECT products.id as productId, products.name, users.name, users.id as userId, orders_products.base_cost*(invoice.vat+1.0) as profit, 
				orders.id, transactions.transaction_date
FROM products, users, stores_users, orders, invoice, orders_products, transactions, privileges
WHERE products.id=orders_products.product_id and orders_products.order_id=orders.id and
		invoice.order_id=orders.id and orders.costumer_id = stores_users.user_id and
		stores_users.store_id=1 and stores_users.user_id=users.id and 
		privileges.name='costumer' and privileges.id=users.privilege_id and
		orders.paid='true' and orders.transaction_id=transactions.id
ORDER BY transactions.transaction_date DESC;





-- #P202 - Costumers

-- show costumers
-- param(store_id)
SELECT users.id, users.name, users.registration_date, users.email
FROM users, stores_users, privileges
WHERE stores_users.user_id=users.id and stores_users.store_id=1 and
		users.privilege_id=privileges.id and privileges.name='costumer';
		
-- param(store_id,filter)
SELECT users.id, users.name, users.registration_date, users.email
FROM users, stores_users, privileges
WHERE stores_users.user_id=users.id and stores_users.store_id=1 and
		users.privilege_id=privileges.id and privileges.name='costumer' and
		users.name ~* 'tony';
		
-- #P203 - Billing
-- show transactions
-- param(store_id)
SELECT * 
FROM transactions
WHERE transactions.store_id=1 
ORDER BY transactions.transaction_date DESC;

-- #P204 - Design
-- show design files
-- param(store_id)
SELECT * 
FROM stores LEFT OUTER JOIN (SELECT * FROM stores_files, files WHERE files.id=stores_files.file_id) as foo
ON (foo.store_id=stores.id)
;
		
-- #P205 - Update Costumer
-- param(costumer_id, name, email, password, privilege_id)
UPDATE users SET name = 'Novo Nome', email = 'novo@email.com', password = 'nova_pass', privilege_id=3
            WHERE id = 3;
            
-- #P206 - Fetch Costumer
-- param(costumer_id)
SELECT *
FROM users
WHERE users.id=3;

-- #P207 - Add Transaction
-- param(current_time, amount, description, store_id)
INSERT INTO transactions(transaction_date,amount,description,store_id) 
VALUES ('2013-04-15',100000,'Private stuff',1);

-- #P208 - Update Design
-- param(store_id)
/*
 * Change css file (dont change db)
 * or
 * DELETE old css
 * INSERT new css
 * */

-- #P209 - Orders
-- param(store_id)
SELECT *
FROM orders, stores_users, users
WHERE orders.costumer_id=stores_users.user_id and stores_users.store_id=1 and
		users.id=stores_users.user_id;
		
-- #P210 - Products
-- get products
-- param(store_id)
SELECT *
FROM products, categories, products_images, files
WHERE categories.store_id=1 and products.category_id=categories.id and
		products_images.product_id=products.id and products_images.file_id=files.id;
		
-- get categories images
-- param(file_id)
SELECT * 
FROM files
WHERE id=1;

-- #P211 - Update Order
/*
 * Quando é que isto vai ser preciso?
 * */

-- #P212 - Fetch Order
--param(order_id)
SELECT *
FROM orders, users, invoice
WHERE orders.costumer_id=users.id and orders.id=1 and invoice.order_id=orders.id;

-- #P213 - Add Product
-- param(name,description,base_cost,stock,insertion_date,category_id,image_id)
INSERT INTO products(name,description,base_cost,stock,insertion_date,category_id,image_id) 
VALUES('New Product','A new description',666333,9,'2012-02-05',1,4);

-- #P214 - Remove Product
-- param(product_id)
DELETE FROM products
            WHERE id = 1;
            /*ou
             * por o stock a 0, que é mais seguro e estavel para as contagens dos lucros.
             */
UPDATE products SET stock = 0
            WHERE id = 1;
            
-- #P215 - Search
-- param(store_id, filter)
SELECT * 
FROM users, stores_users
WHERE users.id=stores_users.users_id and users.name ~* 'tony';

SELECT * 
FROM products, categories 
WHERE products.category_id=categories.id and categories.store_id=1 and
		(products.name ~* 'bmw' or categories.name ~* 'bmw');
		
-- #P216 - Update Product
-- param(product_id, name, description, base_cost, stock, category_id, image_id)
UPDATE products SET name='New name', description='New description', base_cost=3366, stock=8, category_id=2, image_id=2
            WHERE id = 1;
            
-- #P217 - Delete order
/*
 * Quando é que isto vai ser preciso?
 */
            
-- #P218 - Remove Category
-- param(category_id)
DELETE FROM categories WHERE id=2;

-- #P219 - Add Category
-- param(name,store_id,image_id)
INSERT INTO categories(name,store_id,image_id) VALUES('new category',1,3);

