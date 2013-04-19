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
FROM products, users, stores_users, orders, invoice, orders_products, transactions
WHERE products.id=orders_products.product_id and orders_products.order_id=orders.id and
		invoice.order_id=orders.id and orders.costumer_id = stores_users.user_id and
		stores_users.store_id=1 and stores_users.user_id=users.id and
		orders.paid='true' and orders.transaction_id=transactions.id
ORDER BY transactions.transaction_date DESC;


