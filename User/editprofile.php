<?php
//session_start();
//echo "profile Page";
require_once 'user.php';
include_once 'config.php';

$user = isLogged();
 ?>
<!doctype html>
<html>
<head>
  <meta charset=utf-8>
  <title>Edit My profile</title>
  <link href="../bootstrap/Content/bootstrap.css" rel="stylesheet" />
  <script src="../bootstrap/Scripts/jquery-1.9.1.js"></script>
  <script src="../bootstrap/Scripts/bootstrap.js"></script>
  <style>
    .error{
      color: red;
      font-size: 10px;
    }
  </style>

</head>
<body>
<?php
  if(isset($_GET['error']))
    echo "<span class='error'>".$_GET['error']."</span>";
 ?>
<div class="container-fluid">


 <form action="editprofileprocess.php" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" value="<?=$user->email?>" disabled>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name ="password" required>
  </div>
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" value="<?=$user->username?>">
  </div>
  <div class="form-group">
    <label for="job">Job</label>
    <input type="text" class="form-control" name="job" value="<?=$user->job?>">
  </div>
  <div class="form-group">
    <label for="address">Address</label>
    <input type="text" class="form-control" name="address" value="<?=$user->address?>">
  </div>
  <div class="form-group">
    <label for="birth">BirthDate</label>
    <input type="date" class="form-control" name="birth" value="<?=$user->birthday?>">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
 </form>


</div>
</body>
</html>
