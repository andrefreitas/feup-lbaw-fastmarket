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

