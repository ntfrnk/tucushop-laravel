CREATE DATABASE IF NOT EXISTS tucushop_laravel;

USE tucushop_laravel;

/* Tabla USERS */

CREATE TABLE IF NOT EXISTS users (
id int(255) auto_increment NOT NULL,
email varchar(255),
email_verified_at timestamp NULL,
password varchar(255),
nickname varchar(50) NULL,
remember_token varchar(100) NULL,
created_at datetime NULL,
updated_at timestamp NULL,
CONSTRAINT pk_users PRIMARY KEY(id)
) ENGINE=InnoDb;

/* Tabla USERS_PROFILE */

CREATE TABLE IF NOT EXISTS users_profile (
id int(255) auto_increment NOT NULL,
user_id int(255) NOT NULL,
name varchar(255),
lastname varchar(255),
birthday date,
gender varchar(10),
dni int(8),
photo varchar(255),
version_photo int(3),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_users_profiles PRIMARY KEY (id),
CONSTRAINT fk_users_profiles_users FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDb;

/* Tabla USERS_ADDRESSES */

CREATE TABLE IF NOT EXISTS users_addresses (
id int(255) auto_increment NOT NULL,
user_id int(255) NOT NULL,
phone varchar(20),
address varchar(100),
country varchar(50),
state varchar(50),
city varchar(50),
postalcode varchar(15),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_users_addresses PRIMARY KEY(id),
CONSTRAINT fk_users_addresses_users FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDb;

/* Tabla KEYWORDS */

CREATE TABLE IF NOT EXISTS keywords (
id int(255) auto_increment NOT NULL,
keyword varchar(255) NOT NULL,
created_at datetime,
updated_at datetime,
CONSTRAINT pk_keywords PRIMARY KEY(id)
) ENGINE=InnoDb;

/* Tabla USERS_PREFERENCES */

CREATE TABLE IF NOT EXISTS users_preferences (
keyword_id int(255) NOT NULL,
user_id int(255) NOT NULL,
source varchar(50),
created_at datetime,
updated_at datetime,
CONSTRAINT fk_users_preferences_keywords FOREIGN KEY (keyword_id) REFERENCES keywords(id),
CONSTRAINT fk_users_preferences_users FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDb;

/* Tabla USERS_LIKES */

CREATE TABLE IF NOT EXISTS users_likes (
item_id int(255) NOT NULL,
user_id int(255) NOT NULL,
created_at datetime,
updated_at datetime,
CONSTRAINT fk_users_likes_items FOREIGN KEY (item_id) REFERENCES items(id),
CONSTRAINT fk_users_likes_users FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDb;

/* Tabla PLANS */

CREATE TABLE IF NOT EXISTS plans (
id int(255) auto_increment NOT NULL,
name varchar(255),
description text(255),
price int(10),
eshop int(1),
info int(1),
max_items int(3),
max_offers int(3),
max_photos int(3),
max_admins int(3),
max_emails int(3),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_plans PRIMARY KEY(id)
) ENGINE=InnoDb;

/* Tabla TYPES */

CREATE TABLE IF NOT EXISTS types (
id int(255) auto_increment NOT NULL,
type varchar(255) NOT NULL,
created_at datetime,
updated_at datetime,
CONSTRAINT pk_types PRIMARY KEY(id)
) ENGINE=InnoDb;

/* Tabla STORES */

CREATE TABLE IF NOT EXISTS stores (
id int(255) auto_increment NOT NULL,
type_id int(255) NOT NULL,
plan_id int(255) NOT NULL,
name varchar(255) NOT NULL,
description text,
alias varchar(255),
status int(2),
status_plan int(2),
created_at datetime,
updated_at datetime,
deleted int(1),
CONSTRAINT pk_stores PRIMARY KEY(id),
CONSTRAINT fk_stores_types FOREIGN KEY (type_id) REFERENCES types(id),
CONSTRAINT fk_stores_plans FOREIGN KEY (plan_id) REFERENCES plans(id)
) ENGINE=InnoDb;

/* Tabla ITEMS */

CREATE TABLE IF NOT EXISTS items (
id int(255) auto_increment NOT NULL,
store_id int(255) NOT NULL,
name varchar(255) NOT NULL,
detail text,
price int(10),
tags varchar(255),
created_at datetime,
updated_at datetime,
status int(2),
CONSTRAINT pk_items PRIMARY KEY(id),
CONSTRAINT fk_items_stores FOREIGN KEY (store_id) REFERENCES stores(id)
) ENGINE=InnoDb;


/* Tabla MESSAGES */

CREATE TABLE IF NOT EXISTS messages (
id int(255) auto_increment NOT NULL,
user_id int(255) NOT NULL,
store_id int(255) NOT NULL,
item_id int(255) NOT NULL,
content text,
created_at datetime,
updated_at datetime,
readed_at datetime,
closed int(1),
CONSTRAINT pk_messages PRIMARY KEY(id),
CONSTRAINT fk_messages_users FOREIGN KEY (user_id) REFERENCES users(id),
CONSTRAINT fk_messages_stores FOREIGN KEY (store_id) REFERENCES stores(id),
CONSTRAINT fk_messages_items FOREIGN KEY (item_id) REFERENCES items(id)
) ENGINE=InnoDb;

/* Tabla ITEMS_OFFERS */

CREATE TABLE IF NOT EXISTS items_offers (
id int(255) auto_increment NOT NULL,
item_id int(255) NOT NULL,
price int(10),
percent int(2),
expiration date,
created_at datetime,
updated_at datetime,
CONSTRAINT pk_items_offers PRIMARY KEY(id),
CONSTRAINT fk_items_offers_items FOREIGN KEY (item_id) REFERENCES items(id)
) ENGINE=InnoDb;

/* Tabla ITEMS_FOTOS */

CREATE TABLE IF NOT EXISTS items_photos (
id int(255) auto_increment NOT NULL,
item_id int(255) NOT NULL,
file_path varchar(255),
version varchar(3),
created_at datetime,
updated_at datetime,
ordering int(2),
CONSTRAINT pk_items_photos PRIMARY KEY(id),
CONSTRAINT fk_items_photos_items FOREIGN KEY (item_id) REFERENCES items(id)
) ENGINE=InnoDb;

/* Tabla FEATURES */

CREATE TABLE IF NOT EXISTS features (
id int(255) auto_increment NOT NULL,
feature varchar(255) NOT NULL,
created_at datetime,
updated_at datetime,
CONSTRAINT pk_features PRIMARY KEY(id)
) ENGINE=InnoDb;

/* Tabla ITEMS_FEATURES */

CREATE TABLE IF NOT EXISTS items_features (
item_id int(255) NOT NULL,
feature_id int(255),
created_at datetime,
updated_at datetime,
ordering int(2),
CONSTRAINT fk_items_features_items FOREIGN KEY (item_id) REFERENCES items(id),
CONSTRAINT fk_items_features_features FOREIGN KEY (feature_id) REFERENCES features(id)
) ENGINE=InnoDb;

/* Tabla ITEMS_TAGS */

CREATE TABLE IF NOT EXISTS items_tags (
item_id int(255) NOT NULL,
keyword_id int(255) NOT NULL,
created_at datetime,
updated_at datetime,
CONSTRAINT fk_items_tags_items FOREIGN KEY (item_id) REFERENCES items(id),
CONSTRAINT fk_items_tags_keywords FOREIGN KEY (keyword_id) REFERENCES keywords(id)
) ENGINE=InnoDb;

/* Tabla ROLES */

CREATE TABLE IF NOT EXISTS roles (
id int(255) auto_increment NOT NULL,
role varchar(255) NOT NULL,
created_at datetime,
updated_at datetime,
CONSTRAINT pk_roles PRIMARY KEY(id)
) ENGINE=InnoDb;

/* Tabla STORES_ADMINS */

CREATE TABLE IF NOT EXISTS stores_admins (
store_id int(255) NOT NULL,
user_id int(255) NOT NULL,
role_id int(255) NOT NULL,
status int(2),
created_at datetime,
updated_at datetime,
CONSTRAINT fk_stores_admins_stores FOREIGN KEY (store_id) REFERENCES stores(id),
CONSTRAINT fk_stores_admins_users FOREIGN KEY (user_id) REFERENCES users(id),
CONSTRAINT fk_stores_admins_roles FOREIGN KEY (role_id) REFERENCES roles(id)
) ENGINE=InnoDb;

/* Tabla STORES_PROFILE */

CREATE TABLE IF NOT EXISTS stores_profile (
id int(255) auto_increment NOT NULL,
store_id int(255) NOT NULL,
email varchar(255),
website varchar(255),
phone varchar(100),
cellphone varchar(100),
facebook varchar(255),
twitter varchar(255),
instagram varchar(255),
pinterest varchar(255),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_stores_profile PRIMARY KEY (id),
CONSTRAINT fk_stores_profile_stores FOREIGN KEY (store_id) REFERENCES stores(id)
) ENGINE=InnoDb;

/* Tabla STORES_SHOP */

CREATE TABLE IF NOT EXISTS stores_shop (
id int(255) auto_increment NOT NULL,
store_id int(255) NOT NULL,
image_header varchar(255),
image_profile varchar(255),
opacity_header int(3),
ordering varchar(2),
primary_tab varchar(20),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_stores_shop PRIMARY KEY (id),
CONSTRAINT fk_stores_shop_stores FOREIGN KEY (store_id) REFERENCES stores(id)
) ENGINE=InnoDb;

/* Tabla STORES_LOCATIONS */

CREATE TABLE IF NOT EXISTS stores_locations (
id int(255) auto_increment NOT NULL,
store_id int(255) NOT NULL,
name varchar(255),
address varchar(255),
country varchar(255),
state varchar(255),
city varchar(255),
phone varchar(255),
cellphone varchar(255),
email varchar(255),
schedules varchar(255),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_stores_locations PRIMARY KEY(id),
CONSTRAINT fk_stores_locations_stores FOREIGN KEY (store_id) REFERENCES stores(id)
) ENGINE=InnoDb;


/* Tabla SALES */

CREATE TABLE IF NOT EXISTS sales (
id int(255) auto_increment NOT NULL,
user_id int(255) NOT NULL,
delivery_type varchar(20),
payment_method varchar(20),
amount int(10),
installments int(2),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_sales PRIMARY KEY(id),
CONSTRAINT fk_sales_users FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDb;


/* Tabla SALES_ITEMS */

CREATE TABLE IF NOT EXISTS sales_items (
id int(255) auto_increment NOT NULL,
item_id int(255) NOT NULL,
sale_id int(255) NOT NULL,
quantity int(20),
price int(20),
offer int(1),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_sales PRIMARY KEY(id),
CONSTRAINT fk_sales_items_items FOREIGN KEY (item_id) REFERENCES items(id),
CONSTRAINT fk_sales_items_sales FOREIGN KEY (sale_id) REFERENCES sales(id)
) ENGINE=InnoDb;