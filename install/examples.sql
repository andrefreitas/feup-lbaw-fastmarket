/* Users */
/* ADMIN - Password: Jihxouigp34 */
INSERT INTO users(name,email,password,privilege_id) 
VALUES('Carlos Andrade','carlos@gmail.com','d35aa290d06ae9cb981c71250356ce6d415a4e9299500dd2742cdbac5ef78b12',1);
/* MERCHANT - Password: Kl6jfuig */
INSERT INTO users(name,email,password,privilege_id) 
VALUES('José Maria','jose@gmail.com','7fe0eb49c3719f1b97142c1e7bb9f91706d3e2a9167e271fda8b3d7545389cfe',2);
/* COSTUMER - Password: k8h3ugfs */
INSERT INTO users(name,email,password,privilege_id) 
VALUES('Sofia Laura','laura@sapo.pt','a8c3210a0bb31d22b8bb0964ce4a9b3a556d98783b21bd2e787c355efbbad05c',3);
/* COSTUMER - Password: sdtg73oig3 */
INSERT INTO users(name,email,password,privilege_id) 
VALUES('António Sousa','asousa@sapo.pt','bc9d5178b8686a89052bc0b5f5af6a461ed034140e08bf07c4b8ff43477cfa46',3);

/* Files */
INSERT INTO files(name,path) VALUES('Logotipo Carros','carrosluxo_logotipo.png');
INSERT INTO files(name,path) VALUES('BMW Brand','carrosluxo_bmwbrand.png');
INSERT INTO files(name,path) VALUES('Ferrari Brand','carrosluxo_ferrari.png');

/* Stores */
INSERT INTO stores(name,slogan,vat,logo_id) VALUES('CarrosLuxo','Os melhores carros',0.23,1);

/* Associate users to stores */
INSERT INTO stores_users(user_id,store_id) VALUES(2,1);
INSERT INTO stores_users(user_id,store_id) VALUES(3,1);
INSERT INTO stores_users(user_id,store_id) VALUES(4,1);

/* Categories */
INSERT INTO categories(name,store_id,image_id) VALUES('BMW',1,2);
INSERT INTO categories(name,store_id,image_id) VALUES('Ferrari',1,3);

/* Products */
INSERT INTO products(name,description,base_cost,stock,category_id) 
VALUES('BMW Série 1','O entrada de gama de qualidade da BMW.',24000,2,1);
INSERT INTO products(name,description,base_cost,stock,category_id) 
VALUES('BMW Série 3','Um homem de família tem que ter um série 3.',54000,1,1);
INSERT INTO products(name,description,base_cost,stock,category_id) 
VALUES('458 Italia','Poder é a palavra que descreve este carro',120000,10,2);

/* Comments */
INSERT INTO comments(comment_date,body,user_id,product_id)
VALUES ('2013-04-01','Awesome car!!!',3,1);
INSERT INTO comments(comment_date,body,user_id,product_id)
VALUES ('2013-03-11','So powerfull...',4,1);

/* Favorites */
INSERT INTO favorites(user_id,product_id) VALUES (3,1);
INSERT INTO favorites(user_id,product_id) VALUES (4,2);