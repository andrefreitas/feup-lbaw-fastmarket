/* SQL for the pages of the plataform module */

-- #P301 - Home


-- #P302 - Login
-- param(email, password)
SELECT id
FROM users
WHERE email='my@email.com' and password='dnsajkndklsa';

-- #P303 - Administration
-- show recent created stores

SELECT stores.creation_date, stores.id, stores.name, users.name
FROM stores, users, stores_users, privileges
WHERE stores.id=stores_users.store_id and stores_users.user_id=users.id and
		users.privilege_id=privileges.id and privileges.name='merchant'
ORDER BY stores.creation_date DESC;

-- stores logos

SELECT stores.id, files.path
FROM stores, files
WHERE stores.logo_id=files.id;

-- stores profits by month
-- param(initDate, endDate)
SELECT stores.id, stores.name, SUM(invoice.total)
FROM invoice, orders, stores_users, transactions, stores
WHERE invoice.order_id=orders.id and stores.id=stores_users.store_id and
		orders.costumer_id=stores_users.user_id and orders.paid='true' and
		orders.transaction_id=transactions.id and 
		transactions.transaction_date >= '2013-04-01' and 
		transactions.transaction_date < '2013-05-01'
GROUP BY stores.id;

-- #P304 - About
SELECT path
FROM files
WHERE name ~* 'about' and name ~* 'plataform';

-- #P305 - Stores
SELECT *
FROM stores;

-- #P306 - Account
-- param(user_id)
SELECT *
FROM users
WHERE id=1;

-- #P307 - Update Account
-- param(user_id, name, email, password, privilege_id)
UPDATE users SET name = 'Novo Nome', email = 'novo@email.com', password = 'nova_pass', privilege_id=1
            WHERE id = 1;

-- #P308 - Add Store
-- param(name,slogan,domain,vat,creation_date,logo_id)
INSERT INTO stores(name,slogan,domain,vat,creation_date,logo_id) 
VALUES('New store','New slogan','newstore.com',0.23,'2013-01-05',1);

-- #P309 - Update Store
-- param(store_id, name,slogan,domain,vat,creation_date,logo_id)
UPDATE stores SET name='New store',slogan='New slogan',domain='newstore.com',vat=0.23,
					creation_date='2013-01-05',logo_id=1
WHERE id = 1;

-- #P310 - Delete Store
-- param(store_id)
DELETE FROM stores WHERE id=1;

-- #P311 - Merchants

SELECT * 
FROM users, privileges
WHERE users.privilege_id=privileges.id;


-- #P312 - Add Merchant
-- param(name,email,password,registration_date)
INSERT INTO users(name,email,password,registration_date,privilege_id) 
VALUES('New Merchant','merchant@merchantlandia.com',
'7fe0eb49c3719f1b97142c1e7bb9f91706d3e2a9167e271fda8b3d7545389cfe',
'2013-02-01',2);

-- #P313 - Update Merchant
-- param(merchant_id, name,email,password,registration_date)
UPDATE users SET name='New Merchant',email='new@email.com',
password='fijdsojfilsdjfljaslfjoasjfo',registration_date='2013-01-05'
WHERE id = 2;


-- #P314 - Delete Merchant
-- param(merchant_id)
DELETE FROM users WHERE id=2;

-- #P315 - Register
-- param(name,email,password,registration_date,privilege_id)
INSERT INTO users(name,email,password,registration_date,privilege_id) 
VALUES('New Merchant','merchant@merchantlandia.com',
'7fe0eb49c3719f1b97142c1e7bb9f91706d3e2a9167e271fda8b3d7545389cfe',
'2013-02-01',2);
