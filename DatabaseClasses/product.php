<?php
require 'config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of product
 *
 * @author hagerelsayed
 */
class product {

//     id int unsigned not null auto_increment primary key,
//    subcategory_id int unsigned,
//    name varchar(100) not null,
//    quantity int,
//    description text,
//    photo text,
//    price float not null,
//    foreign key (subcategory_id) references subcategory(id)
//


    private $id;
    private $subcategory_id;
    private $name;
    private $quantity;
    private $description;
    private $price;
    private $photo;

    function __construct($id, $subcategory_id, $name, $quantity, $description, $price, $photo) {
        $this->id = isset($this->id) ? $this->id : $id;
        $this->subcategory_id = isset($this->subcategory_id) ? $this->subcategory_id : $subcategory_id;
        $this->name = isset($this->name) ? $this->name : $name;
        $this->quantity = isset($this->quantity) ? $this->quantity : $quantity;
        $this->description = isset($this->price) ? $this->price : $price;
        $this->photo = isset($this->photo) ? $this->photo : $photo;
    }

    function __get($name) {
        return $this->$name;
    }

    function __set($name, $value) {
        $this->$name = $value;
    }

    //====Insert Function=====
     function insert() {
        $success = true;

        //1_connect DB
        $con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        if ($con->connect_errno) {
            echo 'error connection to DB' . $con->connect_error . "<br>";
            $success = false;
            //exit;
        }

        //2-preparetion
        $query = "insert into product(subcategory_id,name,quantity,description,photo)values(?,?,?,?,?)";
        $stmt = $con->prepare($query);
        if (!$stmt) {
            echo 'error prpareint statment' . $con->error . "<br>";
            $success = false;
            //exit;
        }
        $result = $stmt->bind_param("isiss", $this->subcategory_id, $this->name, $this->quantity, $this->description, $this->photo);
        if (!$result) {
            echo 'binding failed' . $stmt->error;
            $success = false;
            //exit;
        }

        if (!$stmt->execute()) {
            echo 'execuation failed' . $stmt->error;
            $success = false;
            //exit;
        }
        $stmt->close();
        $con->close();
        return $success;
    }//END INSERT FUNCTION

//============== SELECT FUNCTION ========================
      static function select() {
            $success = true;
            global $mysqli;
            $query = "select * from product";
            //prepare
            $stmt = $mysqli->prepare($query);
            if (!$stmt) {
                echo "error prepare" . $mysqli->error;
                exit;
            }

            //execute
            if (!$stmt->execute()) {
                echo 'execuation failed' . "<br />" . $stmt->error;
                $success = false;
                exit;
            }
            $result = $stmt->get_result();
            $products = [];
            $params = array('id', 'subcategory_id', 'name', 'quantity', 'description', 'price', 'photo');
            while ($product = $result->fetch_object('product', $params)) {
                $products[] = $product;
            }
            $stmt->close();
            $mysqli->close();
            return $products;
        }//END SELECT FUNCTION



}//end class product
