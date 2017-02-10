<?php
/*
 class subcategory will only be used to insert categories and sub categories

 */
class subcategory
{
  private $id;
  private $name;
  private $category_name;
  function __construct($id,$name,$category_name)
  {
    $this->id = $id;
    $this->name = $name;
    $this->category_name = $category_name;
  }
  function __get($name){
      return $this->$name;
  }

  function __set($name,$value){
      $this->$name = $value;
  }
  function insert(){
    global $mysqli;
    $query = "insert into subcategory(id,name,category_name) VALUES(?,?,?)";
    $stmt = $mysqli->prepare($query);
    if(!$stmt)
      return false;
    $stmt->bind_param('iss',$this->id,$this->name,$this->category_name);
    if(!$stmt->execute())
      return false;
    if($stmt->affected_rows>0){
      $stmt->close();
      return true;
    }
    return false;
  }//End ot insert function
}//End of subcategory class
 ?>
