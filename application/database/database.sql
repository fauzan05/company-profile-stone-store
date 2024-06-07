create database stone_store;
show databases;
use stone_store;

show tables;

create table apps(
	id int not null auto_increment,
    company_name varchar(255) null,
    address text null,
    phone_number varchar(50) null,
    email varchar(255) null,
    logo_filename varchar(255) null,
    is_show_logo bool null,
    google_map_link text null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    primary key (id)
) engine=innoDB;

create table categories(
	id int not null auto_increment,
	name varchar(255) not null,
    description text null,
    image_filename varchar(255) null,
	primary key (id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) engine=innoDB;

create table products(
	id int not null auto_increment,
    name varchar(255) not null,
    category_id int not null,
    description text not null,
    color varchar(255) not null,
    primary key (id),
    foreign key(category_id) references categories(id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) engine=innoDB;

create table product_sizes(
	id int not null auto_increment,
    product_id int not null,
	length float not null,
    width float not null,
    height float not null,
	unit varchar(50) not null,
	primary key (id),
	foreign key(product_id) references products(id),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) engine=innoDB;

create table users(
	id int not null auto_increment,
    first_name varchar(255) not null,
	last_name varchar(255) not null,
    username varchar(255) not null,
    password varchar(255),
    role enum('admin','guest') not null,
    email varchar(255) not null,
    phone_number varchar(50) not null,
    image_filename varchar(255) null,
    primary key(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) engine=innoDB;

create table image_products(
	id int not null auto_increment,
	filename varchar(255) not null,
    product_id int not null,
    foreign key(product_id) references products(id) on delete cascade,
    primary key(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) engine=innoDB;

create table applications(
	id int not null auto_increment,
	title varchar(255) not null,
    description text null,
	primary key(id),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) engine=innoDB;

create table image_applications(
	id int not null auto_increment,
	application_id int not null,
    filename varchar(255) not null,
	primary key(id),
	foreign key(application_id) references applications(id) on delete cascade,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) engine=innoDB;

create table social_media(
	id int not null auto_increment,
	type varchar(50) not null,
    account_name varchar(255) not null,
    link text not null,
    primary key(id)
) engine=innoDB;

select * from users;
select * from products;
select * from apps;
select * from image_applications;
select * from applications;
select * from image_products;
select * from categories;
select * from social_media;

drop table users;
drop table product_sizes;
drop table apps;
drop database stone_store;

alter table apps
add google_map_link text null after is_show_logo;

desc categories;
desc products;
show create table products;
show create table image_products;
show create table apps;

alter table image_products
drop foreign key image_products_ibfk_1;

ALTER TABLE image_products
ADD CONSTRAINT image_products_ibfk_1
FOREIGN KEY (product_id) REFERENCES products(id)
ON DELETE CASCADE;

