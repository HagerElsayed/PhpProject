<?php
/*
  this class is used to insert products in database temporary in case of user logging out before
  finishing the buying process


*/
class cart{
  private $user_id;
  private $quantity;
  private $product_id;
  function __construct($user_id,$quantity,$product_id){
    $this->user_id=$user_id;
    $this->quantity=$quantity;
    $this->product_id=$product_id;
  }
  function __get($name){
      return $this->$name;
  }

  function __set($name,$value){
      $this->$name = $value;
  }
  function insert(){
    global $mysqli;
    $result=false;
    $query = "insert into cart (product_id, user_id, quantity) VALUES (?,?,?)";
    $stmt = $mysqli->prepare($query);
    if(!$stmt){
      return false;
    }
    $stmt->bind_param('iii',$this->product_id,$this->user_id,$this->quantity);
    if(!stmt){
      return false;
    }
    $stmt->execute();
    if($stmt->affected_rows>0){
      $result=true;
    }
    $stmt->close();
    return $result;
  }//End of insert Function
  /*
    the delete function will be used at the time of buying  or cancelling the cart
  */
  function delete($id){
    global $mysqli;
    $result=false;
    $query="delete from cart where user_id= ?";
    $stmt = $mysqli->prepare($query);
    if(!$stmt){
      return false;
    }
    $stmt->bind_param('i',$id);
    if(!stmt){
      return false;
    }
    $stmt->execute();
    if($stmt->affected_rows>0){
      $result=true;
    }
    $stmt->close();
    return $result;
  }//End of deleteCart function
  /*
    the getCartContent function will be used when the user logs in and there is previous products
    in the cart
  */
  function getCartContent($id){
    global $mysqli;
    $query = "select * from cart where user_id=?";
    $stmt = $mysqli->prepare($query);
    if(!$stmt){
      return false;
    }
    $stmt->bind_param('i',$id);
    if(!$stmt->execute());
      return false;
    $result = $stmt->get_result();
    $contents=[];
    $params = array('user_id','quantity','product_id');
    while ($content = $result->fetch_object('cart',$params)) {
      $contents[] = $content;
    }
    $stmt->close();
    return $contents;
  }//End of getCartContent function
}//End of class cart
 ?>
