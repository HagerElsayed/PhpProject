<?php
require_once '../DatabaseClasses/user.php';
require_once '../DatabaseClasses/category.php';
$user = isLogged();
if (isAdmin($user)){
  $users = user::getAll();
}
else {
  header("location:login.php");
}

if(isset($_POST['name'])){
  $category = new category($_POST['name']);
  $category->insert();
}
header('location:addcategory.php');


 ?>
