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
  static function selectAllCategories(){
    global $mysqli;
    $categoryList =  array();
    $query = "select category_name from subcategory";
    $stmt = $mysqli->prepare($query);
    if(!$stmt)
      return false;
    if(!$stmt->execute())
      return false;
    $result = $stmt->get_result();
    while($row=$result->fetch_array()){
      if(!in_array($row[0],$categoryList))
        $categoryList[] = $row[0];
    }
    $stmt->close();
    $mysqli->close();
    return $categoryList;
  }//End of selectAllCategories
  static function selectAllSubCategories(){
    global $mysqli;
    $query = "select name from subcategory";
    $stmt = $mysqli->prepare($query);
    if(!$stmt)
      return false;
    if(!$stmt->execute())
      return false;
    $result = $stmt->get_result();
    while($row=$result->fetch_array()){
        if(!in_array($row[0],$subcategoryList))
          $subcategoryList[] = $row[0];
    }
    $stmt->close();
    $mysqli->close();
    return $subcategoryList;
  }//End of selectAllSubCategories
  static function selectsubCategories($chosenCategory){
    global $mysqli;
    $subcategoryList = array();
    $query = "select name from subcategory where category_name = ?";
    $stmt = $mysqli->prepare($query);
    if(!$stmt)
      return false;
    $stmt->bind_param('s',$chosenCategory);
    if(!$stmt->execute())
      return false;
    $result = $stmt->get_result();
    while($row=$result->fetch_array()){
        if(!in_array($row[0],$subcategoryList))
          $subcategoryList[] = $row[0];
    }
    $stmt->close();
    $mysqli->close();
    return $subcategoryList;
  }//End of selectAllCategories
}//End of subcategory class
 ?>
