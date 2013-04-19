/* SQL for the pages of the store frontend module */

/* #P001 HomePage */
-- Products(store_id,limit)
SELECT products.id, products.name, products.description, products.base_cost as price, categories.name as category, files.path as file
FROM products,categories,files
WHERE products.category_id=categories.id AND categories.store_id=1 AND files.id=products.image_id
ORDER BY insertion_date DESC
LIMIT 20;
-- Categories(store_id)
SELECT categories.id, categories.name
FROM categories
WHERE store_id=1;

/* #P002 Search */
-- Products(search_term,limit)
SELECT products.id, products.name, products.description, products.base_cost as price, categories.name as category, files.path as file
FROM products,categories,files
WHERE products.category_id=categories.id AND categories.store_id=1 AND files.id=products.image_id
AND (products.description ~* 'ferrari' or products.name ~* 'ferrari' or categories.name ~* 'ferrari')
ORDER BY insertion_date DESC
LIMIT 20;

/* #P003 Product */
-- Product(product_id)
SELECT products.id, products.name, products.description, products.base_cost as price, products.stock, products.score, categories.name as category, files.path as file
FROM products,categories,files
WHERE products.id=1 AND products.category_id=categories.id AND files.id=products.image_id;
-- Comments(product_id)
SELECT comments.id, comments.body,comments.comment_date AS date, users.name
FROM comments,users
WHERE comments.product_id=1 and comments.user_id=users.id;

/* #P004 Make Favorite */
-- Params(user_id, product_id)
INSERT INTO favorites(user_id,product_id) VALUES(1,1);

/* #P005 Insert Comment */
-- Params(product_id,user_id,comment)
INSERT INTO comments(product_id, user_id,body,comment_date)
VALUES (1,1,'A cool comment',CURRENT_TIMESTAMP);

/* #P007 Make Subscription */
-- Params(user_id,product_id)
INSERT INTO products_subscriptions(product_id,user_id,subscription_date)
VALUES (1,1,CURRENT_TIMESTAMP);

/* #P008 Contacts*/
-- Params(store_id)
SELECT path
FROM files,stores_files
WHERE files.id=stores_files.file_id AND name ~* 'contacts' AND stores_files.store_id=1;

/* #P009 Category */
-- Products(category_id)
SELECT products.id, products.name, products.description, products.base_cost as price, products.stock, products.score, categories.name as category, files.path as file
FROM products,categories,files
WHERE categories.id=1 AND products.category_id=categories.id AND files.id=products.image_id;


/* #P010 Evaluate */
-- Params(product_id,user_id,score)
INSERT INTO products_scores(product_id,user_id,score) VALUES (1,1,3);

/* #P013 Checkout */
-- Insert order (costumer_id)
BEGIN;
INSERT INTO orders(costumer_id,paid,order_date) VALUES (1,'false',CURRENT_TIMESTAMP);
LOCK TABLE orders;
-- Add product to order(product_id,quantity,base_cost)
INSERT INTO orders_products(product_id,order_id,quantity,base_cost) VALUES(1,(SELECT last_value FROM orders_id_seq),2,40500);
-- Add product to order(product_id,quantity,base_cost)
INSERT INTO orders_products(product_id,order_id,quantity,base_cost) VALUES(2,(SELECT last_value FROM orders_id_seq),1,1500);
COMMIT;

/* #P015 About*/
-- Params(store_id)
SELECT path
FROM files,stores_files
WHERE files.id=stores_files.file_id AND name ~* 'about' AND stores_files.store_id=1;
