<?php
echo "edit profile process page";
echo "<br>";
require_once '../DatabaseClasses/user.php';
include_once '../DatabaseClasses/config.php';
$user = isLogged();
$user->userame = $_POST['name'];
$user->password = sha1($_POST['password']);
$user->job = $_POST['job'];
$user->address = $_POST['address'];
$user->birthday = $_POST['birth'];
$result = $user->editUser();
if(!$result)
  header("location:editprofile.php?error=Error happened when editing details");
header("location:profile.php")
 ?>
