DROP TABLE IF EXISTS orders_products;
DROP TABLE IF EXISTS invoice;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS products_subscriptions;
DROP TABLE IF EXISTS favorites;
DROP TABLE IF EXISTS products_scores;
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS transactions;
DROP TABLE IF EXISTS products_images;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS stores_files;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS stores_users;
DROP TABLE IF EXISTS stores;
DROP TABLE IF EXISTS files;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS privileges;

CREATE TABLE privileges(
	id SERIAL PRIMARY KEY,
	name TEXT NOT NULL UNIQUE
);

CREATE TABLE users(
     id SERIAL PRIMARY KEY,
     name TEXT NOT NULL,
     email TEXT NOT NULL,
     password TEXT NOT NULL,
     registration_date DATE NOT NULL,
     privilege_id INTEGER REFERENCES privileges(id) NOT NULL
);

CREATE TABLE files(
	id SERIAL PRIMARY KEY,
	name TEXT NOT NULL,
	path TEXT NOT NULL
);

CREATE TABLE stores(
	id SERIAL PRIMARY KEY,
	name TEXT UNIQUE NOT NULL,
	slogan TEXT NOT NULL,
	vat NUMERIC NOT NULL CHECK (vat > 0 and vat<1),
	creation_date DATE NOT NULL,
	domain TEXT NOT NULL,
	logo_id INTEGER REFERENCES files(id),
	css_id INTEGER REFERENCES files(id)
);

CREATE TABLE stores_users(
	user_id INTEGER REFERENCES users(id) NOT NULL,
	store_id INTEGER REFERENCES stores(id) NOT NULL,
	PRIMARY KEY (user_id,store_id)
);

CREATE TABLE categories(
	id SERIAL PRIMARY KEY,
	name TEXT NOT NULL,
	store_id INTEGER REFERENCES stores(id) NOT NULL,
	image_id INTEGER REFERENCES files(id)
);

CREATE TABLE stores_files(
	store_id INTEGER REFERENCES stores(id),
	file_id INTEGER REFERENCES files(id),
	PRIMARY KEY (store_id,file_id)
);

CREATE TABLE products(
	id SERIAL PRIMARY KEY,
	name TEXT NOT NULL,
	description TEXT NOT NULL,
	base_cost NUMERIC CHECK (base_cost > 0),
	stock INTEGER NOT NULL,
	insertion_date DATE NOT NULL,
	score INTEGER,
	category_id INTEGER REFERENCES categories(id)
);


CREATE TABLE products_images(
	file_id INTEGER REFERENCES files(id),
	product_id INTEGER REFERENCES products(id),
	PRIMARY KEY (file_id,product_id)
);

CREATE TABLE transactions(
	id SERIAL PRIMARY KEY,
	transaction_date DATE NOT NULL,
	ammount INTEGER NOT NULL CHECK (ammount > 0),
	description TEXT,
	store_id INTEGER REFERENCES stores(id)
);

CREATE TABLE comments(
	id SERIAL PRIMARY KEY,
	comment_date DATE NOT NULL,
	body TEXT NOT NULL,
	user_id INTEGER references users(id) NOT NULL,
	product_id INTEGER references products(id) NOT NULL
);

CREATE TABLE products_scores(
	user_id INTEGER REFERENCES users(id),
	product_id INTEGER REFERENCES products(id),
	score INTEGER NOT NULL CHECK (score>=0 and score<=5),
	PRIMARY KEY(user_id,product_id)
);

CREATE TABLE favorites(
	user_id INTEGER REFERENCES users(id),
	product_id INTEGER REFERENCES products(id),
	PRIMARY KEY(user_id,product_id)
);

CREATE TABLE products_subscriptions(
	user_id INTEGER REFERENCES users(id),
	product_id INTEGER REFERENCES products(id),
	subscription_date DATE NOT NULL,
	PRIMARY KEY(user_id,product_id)
);

CREATE TABLE orders(
	id SERIAL PRIMARY KEY,
	order_date DATE NOT NULL,
	paid BOOLEAN NOT NULL,
	costumer_id INTEGER REFERENCES users(id) NOT NULL,
	transaction_id INTEGER REFERENCES transactions(id)
);

CREATE TABLE invoice(
	id SERIAL PRIMARY KEY,
	code TEXT UNIQUE NOT NULL,
	total numeric NOT NULL CHECK (total > 0),
	vat numeric NOT NULL,
	order_id INTEGER REFERENCES orders(id) NOT NULL
);

CREATE TABLE orders_products(
	order_id INTEGER REFERENCES orders(id),
	product_id INTEGER REFERENCES products(id),
	quantity INTEGER NOT NULL CHECK (quantity > 0),
	base_cost NUMERIC NOT NULL CHECK (base_cost > 0),
	PRIMARY KEY (order_id,product_id)
);

/* Privileges */
INSERT INTO privileges (name) VALUES('admin');
INSERT INTO privileges (name) VALUES('merchant');
INSERT INTO privileges (name) VALUES('costumer');

/* Index */
DROP INDEX IF EXISTS products_name;
DROP INDEX IF EXISTS products_description;
DROP INDEX IF EXISTS categories_name;
DROP INDEX IF EXISTS users_name;
DROP INDEX IF EXISTS users_email;
DROP INDEX IF EXISTS stores_name;
DROP INDEX IF EXISTS orders_date;

CREATE UNIQUE INDEX products_name ON products (name);
CREATE INDEX products_description ON products USING gin(to_tsvector('english', description));
CREATE UNIQUE INDEX categories_name ON categories(name);
CREATE UNIQUE INDEX users_name ON users(name);
CREATE UNIQUE INDEX users_email ON users(email);
CREATE UNIQUE INDEX stores_name on stores(name);
CREATE UNIQUE INDEX orders_date on orders(order_date);

/* Triggers */
DROP TRIGGER IF EXISTS delete_store ON stores;

CREATE OR REPLACE FUNCTION delete_store() RETURNS void as 'SELECT NULL::void'
    BEGIN

        DELETE FROM users
        USING stores_users,privileges
        WHERE NEW.id = stores_users.store_id AND
              stores_users.user_id=users.id AND
              users.privilege_id=privileges.id AND 
              privileges.name = 'costumer';
 
 
        DELETE FROM files
        USING stores
        WHERE NEW.id = stores.id AND
              (files.id = stores.logo_id OR
               files.id = stores.css_id);
 
        DELETE FROM files
        USING categories
        WHERE NEW.id = categories.store_id AND
              files.id = categories.image_id;
 
        DELETE FROM files
        USING categories,products_images,products
        WHERE NEW.id = categories.store_id AND
              categories.id=products.category_id AND
              products_images.product_id=products.id AND
              files.id=products_images.file_id;
 
        DELETE FROM files
        USING stores_files
        WHERE NEW.id = stores_files.store_id AND
              stores_files.file_id = files.id;
 
        DELETE FROM stores
        WHERE NEW.id = stores.id;
 
        DELETE FROM products
        USING categories
        WHERE category_id=categories.id AND store_id = NEW.id;
 

        RETURN;
    END;
$delete_store$ LANGUAGE plpgsql;
 
CREATE TRIGGER delete_store INSTEAD OF DELETE ON stores
    FOR EACH ROW EXECUTE PROCEDURE delete_store();
