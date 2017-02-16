<?php
/*
 class subcategory will only be used to insert categories and sub categories

 */
class subcategory
{
  private $id;
  private $name;//name of subcategory
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
    $con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $query = "select * from subcategory";
    $stmt = $con->prepare($query);
    if(!$stmt)
      return false;
    if(!$stmt->execute())
      return false;

    $subcategoryList=[];
    $result = $stmt->get_result();
    while($row=$result->fetch_array()){
          array_push($subcategoryList,$row);
    }
    return $subcategoryList;
    $stmt->close();
    $con->close();
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

  static function selectsubCategorieName($name){
    $con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $query = "select id from subcategory where name = ?";
    $stmt = $con->prepare($query);
    if(!$stmt)
      return false;
    $stmt->bind_param('s',$name);
    if(!$stmt->execute())
      return false;
    $result = $stmt->get_result();
    $row=$result->fetch_array();
    $stmt->close();
    $con->close();
    return $row[0];
    var_dump($row);
  }//END SELECTION
  //============== Get by id========================
    static function selectById($id) {
      //global $mysqli;
      $con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

      $query = "select name from subcategory where id = ?";

      $stmt = $con->prepare($query);

      if (!$stmt) {
        return false;
        }
      //pind_param
      $res = $stmt->bind_param('i', $id);
      if (!$res) {
        echo 'binding failed' . $stmt->error;
        return false;
      }
      //execute
      if (!$stmt->execute()) {
        return false;
      }
      $result = $stmt->get_result();
      $result = $result->fetch_array();
      $stmt->close();
      $con->close();
      return $result;
      }//end getById
      //============== Get by name========================
        static function selectByName($name) {
          //global $mysqli;
          $con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

          $query = "select id from subcategory where name = ?";

          $stmt = $con->prepare($query);

          if (!$stmt) {
            return false;
            }
          //pind_param
          $res = $stmt->bind_param('s', $name);
          if (!$res) {
            echo 'binding failed' . $stmt->error;
            return false;
          }
          //execute
          if (!$stmt->execute()) {
            return false;
          }
          $result = $stmt->get_result();
          $result = $result->fetch_array();
          $stmt->close();
          $con->close();
          return $result;
        }//end selectByName
        static function select() {
              $success = true;
              //global $mysqli;
              $con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
              $query = "select * from subcategory";
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
              $products = [];
              $params = array( 'name', 'category_name');
              while ($product = mysqli_fetch_object($result)) {
                  $products[] = $product;
              }
              $stmt->close();
              $con->close();
              return $products;

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
                  $query = "update subcategory set name=? where name=? ";
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

}//End of subcategory class
 ?>
