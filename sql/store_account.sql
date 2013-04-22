/* SQL for the pages of the account module */

/* P102 Login */
-- Params(email, password)
SELECT * FROM users
WHERE email='josep@gmail.com' AND password='d35aa290d06ae9cb981c71250356ce6d415a4e9299500dd2742cdbac5ef78b12'; 

/* P112 Register Action*/
-- Params(name,email,password:sha256)
INSERT INTO users(name,email,password,registration_date,privilege_id)
VALUES ('Joseph Adams','josep@gmail.com','d35aa290d06ae9cb981c71250356ce6d415a4e9299500dd2742cdbac5ef78b12',
CURRENT_TIMESTAMP,(SELECT id FROM privileges WHERE name='costumer'));

/* P104 Subscriptions */
-- Params(user_id)
SELECT products.id, products.name, products.description, products.base_cost as price, categories.name as category, files.path as file
FROM products,categories,files,products_subscriptions
WHERE products.category_id=categories.id AND files.id=products.image_id 
AND products.id=products_subscriptions.product_id AND products_subscriptions.user_id=1
ORDER BY subscription_date DESC;

/* P106 Remove Subscription*/
-- Params(user_id,product_id)
DELETE FROM products_subscriptions
WHERE user_id=1 and product_id=1;

/* P105 Account */
-- Params(user_id)
SELECT * FROM users
WHERE id=1;

/* P108 Favorites */
-- Params(user_id)
SELECT products.id, products.name, products.description, products.base_cost as price, categories.name as category, files.path as file
FROM products,categories,files,favorites
WHERE products.category_id=categories.id AND files.id=products.image_id 
AND products.id=favorites.product_id AND favorites.user_id=4;

/* P111 Remove Favorite */
-- Params(user_id,product_id)
DELETE FROM favorites
WHERE user_id=4 and product_id=3;

/* P110 Update Account */
-- Change name(user_id,name)
UPDATE users
SET name='Carl Foxx'
WHERE id=1;

-- Change email(user_id,email)
UPDATE users
SET email='carlsfoox@yahoo.com'
WHERE id=1;

-- Change password(user_id,password:sha256)
UPDATE users
SET password='x35aa290d06ae9cb981c71250356ce6d415a4e9299500dd2742cdbac5ef78b12'
WHERE id=1;

/* P107 Orders */ 
-- Params(costumer_id)
SELECT orders.id, order_date as date,invoice.total
FROM orders,invoice
WHERE costumer_id=3 AND orders.id=invoice.order_id;

/* P112 Orders Items */
-- Params(order_id)
SELECT products.id, products.name, products.description, products.base_cost as price, categories.name as category, files.path as file
FROM products,categories,files,orders_products
WHERE products.category_id=categories.id AND files.id=products.image_id 
AND products.id=orders_products.product_id AND orders_products.order_id=1;

/* P109 Payment */
-- Params(order_id)
SELECT * 
FROM invoice
WHERE order_id=1;
