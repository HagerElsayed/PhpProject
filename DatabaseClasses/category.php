<?php


class category {
  private $id;
  private $name;
  function __construct($name) {
    $this->name = isset($this->name) ? $this->name : $name;

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
  $query = "insert into category(name)values(?)";
  $stmt = $con->prepare($query);
  if (!$stmt) {
    echo 'error prpareint statment' . $con->error . "<br>";
    $success = false;
      //exit;
  }
  $result = $stmt->bind_param("s",$this->name);
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
  //global $mysqli;
  $con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
  $query = "select name from category";
            //prepare
  $stmt = $con->prepare($query);
  if (!$stmt) {
    echo "error prepare" . $con->error;
    exit;
  }
          //execute
  if (!$stmt->execute()) {
    echo 'execuation failed' . "<br />" . $stmt->error;
    $success = false;
    exit;
  }
  $result = $stmt->get_result();
  $categories = [];
  //$params = array('id', 'name', 'password', 'email', 'birthday', 'credit_limit', 'job', 'address', 'status', 'registered_at', 'update_at');
  while ($category = $result->fetch_array()) {
      $categories[] = $category['name'];
  }
  $stmt->close();
  $con->close();
  return $categories;
  }//END SELECT FUNCTION
  //============== UPDATE ========================
      static function update($oldName,$newName) {
          $success = true;
          //global $mysqli;
          $con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
          if ($con->connect_errno) {
              echo 'error connection to DB' . $con->connect_error . "<br>";
              $success = false;
              //exit;
          }
          $query = "update category set name=? where name=? ";
          //prepare
          $stmt = $con->prepare($query);
          if (!$stmt) {
              echo "error prepare" . $con->error;
          }

          //bind_param
          $result = $stmt->bind_param('ss', $newName,$oldName);
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
          $con->close();
          return $success;
      }

  //end of update
}//end class product
