<?php
require '../config.php';
class user
{
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
  function __construct($id,$username,$password,$email,$birthday,$credit_limit,$job,$address,$status=1,$registered_at=null,$update_at=null)
  {
    $this->id=isset($this->id)?$this->id:$id;
    $this->username=isset($this->username)?$this->username:$username;
    $this->password=isset($this->password)?$this->password:$password;
    $this->email=isset($this->email)?$this->email:$email;
    $this->birthday=isset($this->birthday)?$this->birthday:$birthday;
    $this->credit_limit=isset($this->credit_limit)?$this->credit_limit:$credit_limit;
    $this->job=isset($this->job)?$this->job:$job;
    $this->address=isset($this->address)?$this->address:$address;
    $this->status=isset($this->status)?$this->status:$status;
    $this->registered_at=isset($this->registered_at)?$this->registered_at:$registered_at;
    $this->update_at=isset($this->update_at)?$this->update_at:$update_at;
  } //end constructor
  function __get($attr){
      return $this->$attr;
  }

  function __set($attr,$value){
      $this->$attr = $value;
  }

 //start insert method
 function insert(){
   $success = true;

   //connect database
   $con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
   if ($con->connect_errno) {
       echo 'error connection to DB' . $con->connect_error . "<br>";
       $success = false;
       exit;
   }

   $query = "insert into user(username,password,email,birthday,credit_limit,job,address,status) VALUES (?,?,?,?,?,?,?,?)";

  //prepare
   $stmt = $con->prepare($query);
   if(!$stmt){
     echo "error prepare" . $con->error;
     exit;
   }
   else {
     echo "prepare succes";
   }

   $result=$stmt->bind_param('sississi',$this->username,$this->password,$this->email,$this->birthday,$this->credit_limit,$this->job,$this->address,$this->status);
   if (!$result) {
       echo 'binding failed' . $stmt->error;
       $success = false;
       exit;
   }
   else {
     echo 'binding success'."<br />";
   }
   //execute
   if (!$stmt->execute()) {
       echo 'execuation failed' ."<br />". $stmt->error;
       $success = false;
       exit;
   }
   else {
    echo 'execuation success'."<br />";
   }
   $stmt->close();
   $con->close();
   return $success;

}//end insert method


 //start getById Function
  static function getById($id){
   $success = true;

   //connect database
   $con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
   if ($con->connect_errno) {
       echo 'error connection to DB' . $con->connect_error . "<br>";
       $success = false;
      // exit;
   }

  $query = "select * from user where id=?";
  //prepare
   $stmt = $con->prepare($query);
   if(!$stmt){
     echo "error prepare" . $con->error;
     exit;
   }

   //pind_param
   $res=$stmt->bind_param('i',$id);
   if (!$res) {
       echo 'binding failed' . $stmt->error;
       $success = false;
       exit;
   }

   //execute
   if(!$stmt->execute())
   {
     echo 'execuation failed' ."<br />". $stmt->error;
     $success = false;
     exit;
   }
   $result = $stmt->get_result();
   $users=[];
   $params = array('id','username','password','email','birthday','credit_limit','job','address','status','registered_at','update_at');
   while ($user = $result->fetch_object('user',$params))
   {
     $users[] = $user;
   }
   $stmt->close();
   $con->close();
   return $users;

 }//end getById function

 //start getAll Function
  function getAll(){
   $success = true;

   //connect database
   $con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
   if ($con->connect_errno) {
       echo 'error connection to DB' . $con->connect_error . "<br>";
       $success = false;
      // exit;
   }
  $query = "select * from user";
  //prepare
   $stmt = $con->prepare($query);
   if(!$stmt){
     echo "error prepare" . $con->error;
     exit;
   }

   //execute
   if(!$stmt->execute())
   {
     echo 'execuation failed' ."<br />". $stmt->error;
     $success = false;
     exit;
   }
   $result = $stmt->get_result();
   $users=[];
   $params = array('id','username','password','email','birthday','credit_limit','job','address','status','registered_at','update_at');
   while ($user = $result->fetch_object('user',$params))
   {
     $users[] = $user;
   }
   $stmt->close();
   $con->close();
   return $users;

 }//end getAll function

/*
  function delete($id){
    global $mysqli;
    $result=false;
    $this->status=0;
    $query="update user set status=0 where id=?";
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

}//end delete
*/
/*
function update()
{
  $success = true;

  //connect database
  $con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
  if ($con->connect_errno) {
      echo 'error connection to DB' . $con->connect_error . "<br>";
      $success = false;
     // exit;
  }

  $query = "update user set username=? ,password=? ,email=? ,birthday=? ,credit_limit=? ,job=? ,address=? ,status=? where id=? ";

  //prepare
  $stmt = $con->prepare($query);
  if(!$stmt){
    echo "error prepare" . $con->error;
    exit;
  }

  //bind_param
  $result=$stmt->bind_param('sississii',$this->username,$this->password,$this->email,$this->birthday,$this->credit_limit,$this->job,$this->address,$this->status,$this->id);
  if (!$result) {
      echo 'binding failed' . $stmt->error;
      $success = false;
      exit;
  }

  //execute
  if(!$stmt->execute())
  {
    echo 'execuation failed' ."<br />". $stmt->error;
    $success = false;
    exit;
  }
  else {
   echo 'execuation success'."<br />";
  }
  $stmt->close();
  $con->close();
  return $success;

}//end update
*/
}//end class user
/*
$user= user::getById(1);
echo "<pre>";
var_dump($user);
echo  "<pre>";

$user->email='test@yahoo';
if($user->update())
{
  echo $user->username . "update success<br>";
}
else {
  echo "failed";
}

*/
?>
