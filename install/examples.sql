/* Users */
/* ADMIN - Password: Jihxouigp34 */
INSERT INTO users(name,email,password,registration_date,privilege_id) 
VALUES('David Smith','david@gmail.com','d35aa290d06ae9cb981c71250356ce6d415a4e9299500dd2742cdbac5ef78b12','2013-02-01',1);
/* MERCHANT - Password: Kl6jfuig */
INSERT INTO users(name,email,password,registration_date,privilege_id) 
VALUES('Peter Griffin','peter@gmail.com','7fe0eb49c3719f1b97142c1e7bb9f91706d3e2a9167e271fda8b3d7545389cfe','2013-02-01',2);
/* COSTUMER - Password: k8h3ugfs */
INSERT INTO users(name,email,password,registration_date,privilege_id) 
VALUES('Sophie Adams','sophie@yahoo.com','a8c3210a0bb31d22b8bb0964ce4a9b3a556d98783b21bd2e787c355efbbad05c','2013-02-01',3);
/* COSTUMER - Password: sdtg73oig3 */
INSERT INTO users(name,email,password,registration_date,privilege_id) 
VALUES('Tony Perry','tony@yahoo.com','bc9d5178b8686a89052bc0b5f5af6a461ed034140e08bf07c4b8ff43477cfa46','2013-02-01',3);

/* Files */
INSERT INTO files(name,path) VALUES('Lux Cars','luxcars_logotipo.png');
INSERT INTO files(name,path) VALUES('BMW Brand','luxcars_bmwbrand.png');
INSERT INTO files(name,path) VALUES('Ferrari Brand','luxcars_ferrari.png');

/* Stores */
INSERT INTO stores(name,slogan,domain,vat,creation_date,logo_id) VALUES('Lux Cars','Cars have value','luxcars.com',0.23,'2013-01-05',1);

/* Associate users to stores */
INSERT INTO stores_users(user_id,store_id) VALUES(2,1);
INSERT INTO stores_users(user_id,store_id) VALUES(3,1);
INSERT INTO stores_users(user_id,store_id) VALUES(4,1);

/* Categories */
INSERT INTO categories(name,store_id,image_id) VALUES('BMW',1,2);
INSERT INTO categories(name,store_id,image_id) VALUES('Ferrari',1,3);

/* Products */
INSERT INTO products(name,description,base_cost,stock,insertion_date,category_id) 
VALUES('BMW Serie 1','Low budget, a big car.',24000,2,'2012-03-05',1);
INSERT INTO products(name,description,base_cost,stock,insertion_date,category_id) 
VALUES('BMW Serie 3','Your rocket to travel the world',54000,1,'2012-03-05',1);
INSERT INTO products(name,description,base_cost,stock,insertion_date,category_id) 
VALUES('458 Italia','400 horse power in a red car',120000,10,'2012-03-05',2);

/* Comments */
INSERT INTO comments(comment_date,body,user_id,product_id)
VALUES ('2013-04-01','Awesome car!!!',3,1);
INSERT INTO comments(comment_date,body,user_id,product_id)
VALUES ('2013-03-11','So powerfull...',4,1);

/* Favorites */
INSERT INTO favorites(user_id,product_id) VALUES (3,1);
INSERT INTO favorites(user_id,product_id) VALUES (4,2);

/* Scores */
INSERT INTO products_scores(user_id,product_id,score) VALUES (3,1,3);
INSERT INTO products_scores(user_id,product_id,score) VALUES (4,1,4);