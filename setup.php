<?php
require 'config.php';
$mysqli = new mysqli(DBHOST, DBUSER,DBPASS);
// open connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

//create database
$res = $mysqli->query('create database if not exists '.DBNAME);
if(!$res){
    echo "database creation failed (".$mysqli->errno.") ".$mysqli->error;
    exit;
}

//select database
$mysqli->select_db(DBNAME);
if($mysqli->errno){
    echo "database selection failed (".$mysqli->errno.") ".$mysqli->error;
    exit;
}
//Create User table
$query = "create table if not exists user(
  id smallint unsigned auto_increment primary key,
  name varchar(100) not null,
  password int not null,
  email varchar(100) unique,
  birthday date not null,
  credit_limit float not null,
  job varchar(100) ,
  address text not null
  )";


 //Create Table Interests
 $query = "create table if not exists interests(
   user_id smallint unsigned,
   id smallint unsigned auto_increment primary key,
   interest_name varchar(100) not null
   foreign key (user_id) references user(id)
   )";

// create cart table
$query = "create table if not exists cart(
    quantity smallint unsigned,
    user_id smallint unsigned,
    product_id smallint unsigned,
    foreign key (product_id) references product(id)
    foreign key (user_id) references user(id)
    PRIMARY KEY (user_id,product_id)
    )";
$res = $mysqli->query($query);
if(!$res){
    echo "cart table creation failed (".$mysqli->errno.") ".$mysqli->error;
    exit;
}

// create order table
$query = "create table if not exists order(
    id int unsigned auto_increment primary key,
    user_id smallint unsigned,
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    foreign key (user_id) references user(id)
    )";
$res = $mysqli->query($query);
if(!$res){
    echo "order table creation failed (".$mysqli->errno.") ".$mysqli->error;
    exit;
}
$query = "create table if not exists ordered_product‎(
    id int unsigned auto_increment primary key,
    order_id smallint unsigned,
    product_id smallint unsigned,
    quantity smallint unsigned,
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    foreign key (order_id) references order(id)
    foreign key (product_id) references product(id)
    )";
$res = $mysqli->query($query);
if(!$res){
    echo "order _product table creation failed (".$mysqli->errno.") ".$mysqli->error;
    exit;
}
//create product table
$query = "create table if not exists product(
    id int unsigned not null auto_increment primary key,
    subcategory_id int unsigned,
    name varchar(100) not null,
    description text,
    price float not null,
    path_id int unsigned not null,
    foreign key (path_id) references path(id),
    foreign key (subcategory_id) references subcategory(id)
    )";
$res = $mysqli->query($query);
if(!$res){
    echo "product table creation failed (".$mysqli->errno.") ".$mysqli->error;
    exit;
}//End of error check for product table creation

//create subcategory table
$query = "create table if not exists subcategory(
    id int unsigned not null auto_increment primary key,
    name varchar(100) not null,
    category_name varchar(100) not null
    )";
$res = $mysqli->query($query);
if(!$res){
    echo "subcategory table creation failed (".$mysqli->errno.") ".$mysqli->error;
    exit;
}//End of error check for subcategory table creation

//create path table
$query = "create table if not exists path(
    id int unsigned not null auto_increment primary key,
    product_id unsigned not null,
    path text not null,
    foreign key (product_id) references product(id)
    )";
$res = $mysqli->query($query);
if(!$res){
    echo "path table creation failed (".$mysqli->errno.") ".$mysqli->error;
    exit;
}//End of error check for path table creation


$mysqli->close();
?>
