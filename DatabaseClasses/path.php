<?php

class path{
  private $product_id;
  private $path;

function __construct($product_id,$path)
{

    $this->product_id=isset($this->product_id)?$this->product_id:$product_id;
    $this->path=isset($this->path)?$this->path:$path;
}//end constructor

function __get($attr){
    return $this->$attr;
}//end get

function __set($attr,$value){
    $this->$attr = $value;
}//end set


  function insert() {
      $success = true;
      $con = new mysqli(DBHOST, DBUSER, DBPASS,DBNAME);
      $query = "insert into path(product_id,path) VALUES (?,?)";

      //prepare
      $stmt = $con->prepare($query);
      if (!$stmt) {
          echo "error prepare" . $con->error;
          exit;
      }
      $result = $stmt->bind_param('is',$this->product_id, $this->path);
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
      $con->close();
      return $success;
  }

  //end of insertion

}//end class

 ?>
