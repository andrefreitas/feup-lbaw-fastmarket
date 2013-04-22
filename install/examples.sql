SET search_path TO fastmarket;
/* Users */
/* ADMIN - Password: Jihxouigp34 */
INSERT INTO users(name,email,password,registration_date,privilege_id) 
VALUES('David Smith','david@gmail.com','d35aa290d06ae9cb981c71250356ce6d415a4e9299500dd2742cdbac5ef78b12',
'2013-02-01',1);
/* MERCHANT - Password: Kl6jfuig */
INSERT INTO users(name,email,password,registration_date,privilege_id) 
VALUES('Peter Griffin','peter@gmail.com','7fe0eb49c3719f1b97142c1e7bb9f91706d3e2a9167e271fda8b3d7545389cfe',
'2013-02-01',2);
/* COSTUMER - Password: k8h3ugfs */
INSERT INTO users(name,email,password,registration_date,privilege_id) 
VALUES('Sophie Adams','sophie@yahoo.com','a8c3210a0bb31d22b8bb0964ce4a9b3a556d98783b21bd2e787c355efbbad05c',
'2013-02-01',3);
/* COSTUMER - Password: sdtg73oig3 */
INSERT INTO users(name,email,password,registration_date,privilege_id) 
VALUES('Tony Perry','tony@yahoo.com','bc9d5178b8686a89052bc0b5f5af6a461ed034140e08bf07c4b8ff43477cfa46',
'2013-02-01',3);

/* Files */
INSERT INTO files(name,path) VALUES('Lux Cars','luxcars_logo.png');
INSERT INTO files(name,path) VALUES('BMW Brand','luxcars_bmwbrand.png');
INSERT INTO files(name,path) VALUES('Ferrari Brand','luxcars_ferrari.png');
INSERT INTO files(name,path) VALUES('BMW Serie 1','luxcars_bmwserie1.png');
INSERT INTO files(name,path) VALUES('BMW Serie 3','luxcars_bmwserie3.png');
INSERT INTO files(name,path) VALUES('458 Italia','luxcars_ferrari458.png');
INSERT INTO files(name,path) VALUES('458 Italia','luxcars_ferrari458_back.png');
INSERT INTO files(name,path) VALUES('Contacts','luxcars_contacts.html');
INSERT INTO files(name,path) VALUES('About','luxcars_about.html');

/* Stores */
INSERT INTO stores(name,slogan,domain,vat,creation_date,logo_id) 
VALUES('Lux Cars','Cars have value','luxcars.com',0.23,'2013-01-05',1);

/* Associate Stores to Files */
INSERT INTO stores_files(file_id,store_id) VALUES(8,1);
INSERT INTO stores_files(file_id,store_id) VALUES(9,1);

/* Associate users to stores */
INSERT INTO stores_users(user_id,store_id) VALUES(2,1);
INSERT INTO stores_users(user_id,store_id) VALUES(3,1);
INSERT INTO stores_users(user_id,store_id) VALUES(4,1);

/* Categories */
INSERT INTO categories(name,store_id,image_id) VALUES('BMW',1,2);
INSERT INTO categories(name,store_id,image_id) VALUES('Ferrari',1,3);
INSERT INTO categories(name,store_id,image_id) VALUES('no category',1,null);

/* Products */
INSERT INTO products(name,description,base_cost,stock,insertion_date,category_id,image_id) 
VALUES('BMW Serie 1','Low budget, a big car.',24000,2,'2012-02-05',1,4);
INSERT INTO products(name,description,base_cost,stock,insertion_date,category_id,image_id) 
VALUES('BMW Serie 3','Your rocket to travel the world',54000,1,'2012-03-05',1,5);
INSERT INTO products(name,description,base_cost,stock,insertion_date,category_id,image_id) 
VALUES('458 Italia','400 horse power in a red car',120000,10,'2012-04-05',2,6);

/* Associate Products to Images */
INSERT INTO products_images(product_id,file_id) VALUES(1,4);
INSERT INTO products_images(product_id,file_id) VALUES(2,5);
INSERT INTO products_images(product_id,file_id) VALUES(3,6);
INSERT INTO products_images(product_id,file_id) VALUES(3,7);

/* Comments */
INSERT INTO comments(comment_date,body,user_id,product_id)
VALUES ('2013-04-01','Awesome car!!!',3,1);
INSERT INTO comments(comment_date,body,user_id,product_id)
VALUES ('2013-03-11','So powerfull...',4,1);

/* Favorites */
INSERT INTO favorites(user_id,product_id) VALUES (3,1);
INSERT INTO favorites(user_id,product_id) VALUES (4,2);
INSERT INTO favorites(user_id,product_id) VALUES (4,3);

/* Scores */
INSERT INTO products_scores(user_id,product_id,score) VALUES (3,1,1);
INSERT INTO products_scores(user_id,product_id,score) VALUES (4,1,3);

/* Transactions */
INSERT INTO transactions(transaction_date,amount,description,store_id) VALUES ('2013-04-05',95940,'Online payment',1);
INSERT INTO transactions(transaction_date,amount,description,store_id) VALUES ('2013-04-05',59040,'Online payment',1);

/* Orders */
INSERT INTO orders(order_date,paid,costumer_id,transaction_id) VALUES ('2013-04-05','true',3,1);
INSERT INTO orders(order_date,paid,costumer_id,transaction_id) VALUES ('2013-04-05','true',4,2);

/* Orders_products */
INSERT INTO orders_products( order_id,product_id,quantity,base_cost) VALUES (1,1,1,24000);
INSERT INTO orders_products( order_id,product_id,quantity,base_cost) VALUES (1,2,1,54000);
INSERT INTO orders_products( order_id,product_id,quantity,base_cost) VALUES (2,1,2,24000);

/* Invoice */
INSERT INTO invoice(code,total,vat,order_id) VALUES ('dsa898321jads',95940,0.23,1);
INSERT INTO invoice(code,total,vat,order_id) VALUES ('ngjkd492nfjse',59040,0.23,2);

/* Subscriptions */
INSERT INTO products_subscriptions(product_id,user_id,subscription_date) VALUES(1,1,'2013-04-05');
INSERT INTO products_subscriptions(product_id,user_id,subscription_date) VALUES(2,1,'2013-01-05');

