CREATE DATABASE IF NOT EXISTS tucushop_laravel;

USE tucushop_laravel;

/* Tabla USERS */

CREATE TABLE IF NOT EXISTS users (
id int(255) auto_increment NOT NULL,
email varchar(255),
password varchar(255),
nickname varchar(50),
role varchar(20),
created_at datetime,
updated_at datetime,
remember_token varchar(255),
CONSTRAINT pk_users PRIMARY KEY(id)
) ENGINE=InnoDb;

/* Tabla USERS_PROFILE */

CREATE TABLE IF NOT EXISTS users_profile (
user_id int(255) NOT NULL,
name varchar(255),
birthday date,
gender varchar(10),
dni int(8),
phone varchar(20),
address varchar(100),
country varchar(50),
state varchar(50),
city varchar(50),
postalcode varchar(15),
photo varchar(255),
CONSTRAINT fk_profiles_users FOREIGN KEY (user_id) REFERENCES users(id)
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
CONSTRAINT pk_users_addresses PRIMARY KEY(id),
CONSTRAINT fk_users_addresses_users FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDb;

/* Tabla KEYWORDS */

CREATE TABLE IF NOT EXISTS keywords (
id int(255) NOT NULL,
keyword int(255) NOT NULL,
CONSTRAINT pk_keywords PRIMARY KEY(id)
) ENGINE=InnoDb;

/* Tabla USERS_PREFERENCES */

CREATE TABLE IF NOT EXISTS users_preferences (
keyword_id int(255) NOT NULL,
user_id int(255) NOT NULL,
source varchar(50),
created_at datetime,
CONSTRAINT fk_users_preferences_keywords FOREIGN KEY (keyword_id) REFERENCES keywords(id),
CONSTRAINT fk_users_preferences_users FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDb;

/* Tabla USERS_WISHLIST */

CREATE TABLE IF NOT EXISTS users_wishlist (
keyword_id int(255) NOT NULL,
user_id int(255) NOT NULL,
created_at datetime,
CONSTRAINT fk_users_wishlist_keywords FOREIGN KEY (keyword_id) REFERENCES keywords(id),
CONSTRAINT fk_users_wishlist_users FOREIGN KEY (user_id) REFERENCES users(id)
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
CONSTRAINT pk_plans PRIMARY KEY(id)
) ENGINE=InnoDb;

/* Tabla TYPES */

CREATE TABLE IF NOT EXISTS types (
id int(255) NOT NULL,
type int(255) NOT NULL,
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
CONSTRAINT pk_items_offers PRIMARY KEY(id),
CONSTRAINT fk_items_offers_items FOREIGN KEY (item_id) REFERENCES items(id)
) ENGINE=InnoDb;

/* Tabla ITEMS_FOTOS */

CREATE TABLE IF NOT EXISTS items_fotos (
id int(255) auto_increment NOT NULL,
item_id int(255) NOT NULL,
file_path varchar(255),
ordering int(2),
CONSTRAINT pk_items_fotos PRIMARY KEY(id),
CONSTRAINT fk_items_fotos_items FOREIGN KEY (item_id) REFERENCES items(id)
) ENGINE=InnoDb;

/* Tabla FEATURES */

CREATE TABLE IF NOT EXISTS features (
id int(255) NOT NULL,
feature int(255) NOT NULL,
CONSTRAINT pk_features PRIMARY KEY(id)
) ENGINE=InnoDb;

/* Tabla ITEMS_FEATURES */

CREATE TABLE IF NOT EXISTS items_features (
item_id int(255) NOT NULL,
feature_id int(255),
ordering int(2),
CONSTRAINT fk_items_features_items FOREIGN KEY (item_id) REFERENCES items(id),
CONSTRAINT fk_items_features_features FOREIGN KEY (feature_id) REFERENCES features(id)
) ENGINE=InnoDb;

/* Tabla ROLES */

CREATE TABLE IF NOT EXISTS roles (
id int(255) NOT NULL,
role int(255) NOT NULL,
CONSTRAINT pk_roles PRIMARY KEY(id)
) ENGINE=InnoDb;

/* Tabla STORES_ADMINS */

CREATE TABLE IF NOT EXISTS stores_admins (
store_id int(255) NOT NULL,
user_id int(255) NOT NULL,
role_id int(255) NOT NULL,
status int(2),
CONSTRAINT fk_stores_admins_stores FOREIGN KEY (store_id) REFERENCES stores(id),
CONSTRAINT fk_stores_admins_users FOREIGN KEY (user_id) REFERENCES users(id),
CONSTRAINT fk_stores_admins_roles FOREIGN KEY (role_id) REFERENCES roles(id)
) ENGINE=InnoDb;

/* Tabla STORES_PROFILE */

CREATE TABLE IF NOT EXISTS stores_profile (
store_id int(255) NOT NULL,
email varchar(255),
website varchar(255),
phone varchar(100),
cellphone varchar(100),
facebook varchar(255),
twitter varchar(255),
instagram varchar(255),
pinterest varchar(255),
CONSTRAINT fk_stores_profile_stores FOREIGN KEY (store_id) REFERENCES stores(id)
) ENGINE=InnoDb;

/* Tabla STORES_SHOP */

CREATE TABLE IF NOT EXISTS stores_shop (
store_id int(255) NOT NULL,
image_header varchar(255),
image_profile varchar(255),
opacity_header int(3),
ordering varchar(2),
primary_tab varchar(20),
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
CONSTRAINT pk_stores_locations PRIMARY KEY(id),
CONSTRAINT fk_stores_locations_stores FOREIGN KEY (store_id) REFERENCES stores(id)
) ENGINE=InnoDb;
