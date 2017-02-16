<?php

require_once './DatabaseClasses/config.php';

$q = $_GET['name'];
$query = 'select * from product where  name like "' . $q . '%"';
//$query = 'select * from product where (price=' . $q . ' OR name like "' . $q . '%")';
//echo $query;

$stmt = $mysqli->prepare($query);

$stmt->execute();

$result = $stmt->get_result();

//=====Using Json=========

for ($i = 0; $i < $result->num_rows; $i++) {

    $row = $result->fetch_assoc();

    echo json_encode($row);
}
?>