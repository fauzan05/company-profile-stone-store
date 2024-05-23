show databases;
use stone_store;

create table apps(
	id int not null auto_increment,
    company_name varchar(255) not null,
    address text not null,
    phone_number varchar(50) not null,
    email varchar(255) not null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    primary key (id)
) engine=innoDB;

create table products(
	id int not null auto_increment,
    product_name varchar(255) not null,
    type varchar(255) not null,
    description text not null,
    color varchar(255) not null,
    price float not null,
    shape varchar(255) not null,
    height float not null,
    width float not null,
    stock int not null,
    is_available bool,
    primary key (id),
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
    primary key(id)
) engine=innoDB;

select * from users;
select * from products;
select * from apps;

drop table users;