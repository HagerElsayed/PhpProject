<?php

//$user="root";
//$password="iti";
//$host="localhost";
//$database="phpProject";
//
//$mysqli = new mysqli($host, $user,$password);
//$mysqli->select_db($database);
//if($mysqli->connect_errno)
//{
//	echo "Error:Could not connect to DB";
//	exit();
//}
require_once './DatabaseClasses/config.php';

$q = $_GET['name'];
$query = 'select * from product where name like "' . $q . '%"';
// $result=$con->query($sql);
$stmt = $mysqli->prepare($query);
//$stmt->bind_param('s',$q);
//3- execute statemnt
$stmt->execute();
//4- get result
$result = $stmt->get_result();

//=====Using Json=========
//var_dump($result);
for ($i = 0; $i < $result->num_rows; $i++) {

    $row = $result->fetch_assoc();
    //echo $row['name'];
   // var_dump($row);
   echo json_encode($row);
//$names[$i]=$row['name'];
}
// $json['names']=$names;
// echo json_encode($json);	
//mysqli_close($con);
?>