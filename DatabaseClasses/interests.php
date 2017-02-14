<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of interests
 *
 * @author hagerelsayed
 */
class interests {

    private $user_email;
    private $id;
    private $interest_name;

    function __construct($user_email, $id, $interest_name) {
        $this->id = isset($this->id) ? $this->id : $id;
        $this->user_email = isset($this->user_email) ? $this->user_email : $user_email;
        $this->interest_name = isset($this->interest_name) ? $this->interest_name : $interest_name;
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
        $query = "insert into interests(user_email,interest_name)values(?,?)";
        $stmt = $con->prepare($query);
        if (!$stmt) {
            echo 'error prpareint statment' . $con->error . "<br>";
            $success = false;
            //exit;
        }
        $result = $stmt->bind_param("ss", $this->user_email, $this->interest_name);
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
    }
    

}
