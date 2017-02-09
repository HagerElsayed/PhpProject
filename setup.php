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
// create cart table
$query = "create table if not exists cart(
    id smallint unsigned auto_increment primary key, 
    quantity smallint unsigned,
    product_id smallint unsigned,
    foreign key (product_id) references product(id)
    )";
$res = $mysqli->query($query);
if(!$res){
    echo "users table creation failed (".$mysqli->errno.") ".$mysqli->error;
    exit;
}

// create order table
$query = "create table if not exists order(
    id int unsigned auto_increment primary key,
    user_id smallint unsigned,
    product_id smallint unsigned,
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    foreign key (user_id) references cart(id)
    foreign key (product_id) references product(id)
    )";
$res = $mysqli->query($query);
if(!$res){
    echo "posts table creation failed (".$mysqli->errno.") ".$mysqli->error;
    exit;
}


$mysqli->close();
?>
