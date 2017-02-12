<?php

require 'config.php';
$mysqli = new mysqli(DBHOST, DBUSER, DBPASS);
// open connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
//create database
$res = $mysqli->query('create database if not exists ' . DBNAME);
if (!$res) {
    echo "database creation failed (" . $mysqli->errno . ") " . $mysqli->error;
    exit;
}
//select database
$mysqli->select_db(DBNAME);
if ($mysqli->errno) {
    echo "database selection failed (" . $mysqli->errno . ") " . $mysqli->error;
    exit;
}
//Create User table
$query = "create table if not exists user(
  id int unsigned auto_increment primary key,
  username varchar(100) not null,
  password char(40) not null,
  email varchar(100) unique,
  birthday date not null,
  credit_limit float not null,
  job varchar(100) ,
  address text not null,
  status tinyint unsigned,
  registered_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  update_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  )";
$res = $mysqli->query($query);
if (!$res) {
    echo "user table creation failed (" . $mysqli->errno . ") " . $mysqli->error;
    exit;
}
//Create Interests Table
$query = "create table if not exists interests(
   user_id int unsigned,
   id int unsigned auto_increment primary key,
   interest_name varchar(100) not null,
   foreign key (user_id) references user(id)
   ON UPDATE CASCADE ON DELETE CASCADE
   )";
$res = $mysqli->query($query);
if (!$res) {
    echo "Interests table creation failed (" . $mysqli->errno . ") " . $mysqli->error;
    exit;
}//end interestes
//create subcategory table
$query = "create table if not exists subcategory(
         id int unsigned auto_increment primary key,
         name varchar(100) not null,
         category_name varchar(100) not null
         )";
$res = $mysqli->query($query);
if (!$res) {
    echo "subcategory table creation failed (" . $mysqli->errno . ") " . $mysqli->error;
    exit;
}//End of error check for subcategory table creation
//create product table
$query = "create table if not exists product(
         id int unsigned auto_increment primary key,
         subcategory_id int unsigned,
         name varchar(100) not null,
         quantity int,
         description text,
         photo text,
         price float not null,
         foreign key (subcategory_id) references subcategory(id)
         ON UPDATE CASCADE ON DELETE CASCADE
         )";
$res = $mysqli->query($query);
if (!$res) {
    echo "product table creation failed (" . $mysqli->errno . ") " . $mysqli->error;
    exit;
}//End of error check for product table creation
//create path table
$query = "create table if not exists path(
         id int unsigned auto_increment primary key,
         product_id int unsigned ,
         path text not null,
         foreign key (product_id) references product(id)
         ON UPDATE CASCADE ON DELETE CASCADE
         )";
$res = $mysqli->query($query);
if (!$res) {
    echo "path table creation failed (" . $mysqli->errno . ") " . $mysqli->error;
    exit;
}//End of error check for path table creation
// create cart table
$query = "create table if not exists cart(
    quantity int unsigned,
    user_id int unsigned,
    product_id int unsigned,
    foreign key (product_id) references product(id),
    foreign key (user_id) references user(id),
    PRIMARY KEY (user_id,product_id)
    
    )";
$res = $mysqli->query($query);
if (!$res) {
    echo "cart table creation failed (" . $mysqli->errno . ") " . $mysqli->error;
    exit;
}
// create order table
$query = "CREATE TABLE IF NOT EXISTS order_table(
    ORDER_id INT  UNSIGNED  AUTO_INCREMENT PRIMARY KEY,
    user_id int unsigned,
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    foreign key (user_id) references user(id)
    ON UPDATE CASCADE ON DELETE CASCADE
    
    );";
$res = $mysqli->query($query);
if (!$res) {
    echo "order table creation failed (" . $mysqli->errno . ") " . $mysqli->error;
    exit;
}
//create ordered_product table
$query = "create table if not exists ordered_product(
    id int unsigned auto_increment primary key,
    order_id int unsigned,
    product_id int unsigned,
    quantity int unsigned,
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    foreign key (order_id) references order_table(ORDER_id),
    foreign key (product_id) references product(id)
    ON UPDATE CASCADE ON DELETE CASCADE
    )";
$res = $mysqli->query($query);
if (!$res) {
    echo "order _product table creation failed (" . $mysqli->errno . ") " . $mysqli->error;
    exit;
}
$mysqli->close();
?>

