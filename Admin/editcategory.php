<?php


//check for the user to be the admin only

require_once '../DatabaseClasses/user.php';
require_once '../DatabaseClasses/category.php';
$user = isLogged();
if (isAdmin($user)){
  $users = user::getAll();
}
else {
  header("location:./login.php");
}
if(isset($_POST['name'])){
  category::update($_POST['oldname'],$_POST['name']);
  header('location:addcategory.php');
}

 ?>

 <!doctype html>
 <html>
 <head>
   <meta charset=utf-8>
   <title>Add Product Page</title>
   <link href="../bootstrap/Content/bootstrap.css" rel="stylesheet" />
   <script src="../bootstrap/Scripts/jquery-1.9.1.js"></script>
   <script src="../bootstrap/Scripts/bootstrap.js"></script>

 </head>
 <body>
   <div class="container">
     <nav class="navbar navbar-inverse">
         <div class="container-fluid">
             <div class="navbar-header">
                 <a class="navbar-brand" href="#">Admin Panal</a>

             </div>
             <ul class="nav navbar-nav">
                 <li><a href="mangeUsers.php">Manage Users</a></li>

                 <li class="dropdown">
                     <a class="dropdown-toggle" data-toggle="dropdown" href="manageproducts.php">Manage Products
                         <span class="caret"></span></a>
                     <ul class="dropdown-menu">
                       <li><a href="manageproducts.php">Manage All Products</a></li>
                       <li><a href="addproduct.php">Add product</a></li>
                       <li><a href="addcategory.php">Add Category </a></li>
                       <li><a href="addsubcategory.php">Add subcategory</a></li>
                     </ul>
                 </li>

             </ul>
             <ul class="nav navbar-nav navbar-right">
                 <li><a href="../User/logout.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
             </ul>
         </div>
     </nav>
     <form action="#" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">Category Name : </label>
        <input type="hidden" class="form-control" name="oldname" value="<?= $_GET['name']?>" >
        <input type="text" class="form-control" name="name" value="<?= $_GET['name']?>">
      </div>

      <button type="submit" class="btn btn-default">Edit</button>
     </form>
</div>

 </body>
 </html>
