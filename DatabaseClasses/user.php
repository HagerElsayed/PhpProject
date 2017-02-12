<?php

require '../config.php';

class user {

    private $id;
    private $username;
    private $password;
    private $email;
    private $birthday;
    private $credit_limit;
    private $job;
    private $address;
    private $status;
    private $registered_at;
    private $update_at;

    //start constructor
    function __construct($id, $username, $password, $email, $birthday, $credit_limit, $job, $address, $status = 1, $registered_at = null, $update_at = null) {
        $this->id = isset($this->id) ? $this->id : $id;
        $this->username = isset($this->username) ? $this->username : $username;
        $this->password = isset($this->password) ? $this->password : $password;
        $this->email = isset($this->email) ? $this->email : $email;
        $this->birthday = isset($this->birthday) ? $this->birthday : $birthday;
        $this->credit_limit = isset($this->credit_limit) ? $this->credit_limit : $credit_limit;
        $this->job = isset($this->job) ? $this->job : $job;
        $this->address = isset($this->address) ? $this->address : $address;
        $this->status = isset($this->status) ? $this->status : $status;
        $this->registered_at = isset($this->registered_at) ? $this->registered_at : $registered_at;
        $this->update_at = isset($this->update_at) ? $this->update_at : $update_at;
    }

//end constructor

    function __get($attr) {
        return $this->$attr;
    }

    function __set($attr, $value) {
        $this->$attr = $value;
    }

    //start insert method
    function insert() {
        $success = true;
        global $mysqli;
        $query = "insert into user(username,password,email,birthday,credit_limit,job,address,status) VALUES (?,?,?,?,?,?,?,?)";

        //prepare
        $stmt = $mysqli->prepare($query);
        if (!$stmt) {
            echo "error prepare" . $mysqli->error;
            exit;
        }
        $result = $stmt->bind_param('ssssissi', $this->username, $this->password, $this->email, $this->birthday, $this->credit_limit, $this->job, $this->address, $this->status);
        if (!$result) {
            echo 'binding failed' . $stmt->error;
            $success = false;
            exit;
        }
        //execute
        if (!$stmt->execute()) {
            echo 'execuation failed' . "<br />" . $stmt->error;
            $success = false;
            exit;
        }
        $stmt->close();
        $mysqli->close();
        return $success;
    }

//end insert method
//start getById method
    static function getById($id) {
        $success = true;
        global $mysqli;

        $query = "select * from user where id=?";
        //prepare
        $stmt = $mysqli->prepare($query);
        if (!$stmt) {
            echo "error prepare" . $mysqli->error;
            return false;
            exit;
        }
        //pind_param
        $res = $stmt->bind_param('i', $id);
        if (!$res) {
            echo 'binding failed' . $stmt->error;
            $success = false;
            exit;
        }
        //execute
        if (!$stmt->execute()) {
            echo 'execuation failed' . "<br />" . $stmt->error;
            $success = false;
            exit;
        }
        $result = $stmt->get_result();
        $params = array('id', 'username', 'password', 'email', 'birthday', 'credit_limit', 'job', 'address', 'status', 'registered_at', 'update_at');
        $user = $result->fetch_object('user', $params);
        $stmt->close();
        $mysqli->close();
        return $user;
    }
    
    
    //============== Get by Email========================
       static function getByEmail($email) {
        $success = true;
        global $mysqli;

        $query = "select * from user where email=?";
        //prepare
        $stmt = $mysqli->prepare($query);
        if (!$stmt) {
            echo "error prepare" . $mysqli->error;
            return false;
            exit;
        }
        //pind_param
        $res = $stmt->bind_param('s', $email);
        if (!$res) {
            echo 'binding failed' . $stmt->error;
            $success = false;
            exit;
        }
        //execute
        if (!$stmt->execute()) {
            echo 'execuation failed' . "<br />" . $stmt->error;
            $success = false;
            exit;
        }
        $result = $stmt->get_result();
        $params = array('id', 'username', 'password', 'email', 'birthday', 'credit_limit', 'job', 'address', 'status', 'registered_at', 'update_at');
        $user = $result->fetch_object('user', $params);
        $stmt->close();
        $mysqli->close();
        return $user;
    }//end of get by email

//end getById method
    //start getAll method
    function getAll() {
        $success = true;
        global $mysqli;
        $query = "select * from user";
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
        $users = [];
        $params = array('id', 'username', 'password', 'email', 'birthday', 'credit_limit', 'job', 'address', 'status', 'registered_at', 'update_at');
        while ($user = $result->fetch_object('user', $params)) {
            $users[] = $user;
        }
        $stmt->close();
        $mysqli->close();
        return $users;
    }

//end getAll method
//start delete method
    function delete($id) {
        $success = true;
        global $mysqli;
        $result = false;
        $this->status = 0;
        $query = "update user set status=0 where id=?";
        $stmt = $mysqli->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('i', $id);
        if (!$stmt) {
            return false;
        }
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $result = true;
        }
        $stmt->close();
        $mysqli->close();
        return $success;
    }

//end delete method
//start update method
    function update() {
        $success = true;
        global $mysqli;

        $query = "update user set username=? ,password=? ,email=? ,birthday=? ,credit_limit=? ,job=? ,address=? ,status=? where id=? ";
        //prepare
        $stmt = $mysqli->prepare($query);
        if (!$stmt) {
            echo "error prepare" . $mysqli->error;
        }

        //bind_param
        $result = $stmt->bind_param('sississii', $this->username, $this->password, $this->email, $this->birthday, $this->credit_limit, $this->job, $this->address, $this->status, $this->id);
        if (!$result) {
            echo 'binding failed' . $stmt->error;
            $success = false;
        }
        //execute
        if (!$stmt->execute()) {
            echo 'execuation failed' . "<br />" . $stmt->error;
            $success = false;
        }
        $stmt->close();
        $mysqli->close();
        return $success;
    }

//end update method
}

//end class user




?>
