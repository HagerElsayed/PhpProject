<?php


//check for the user to be the admin only



 ?>
 <!doctype html>
 <html>
 <head>
   <meta charset=utf-8>
   <title>Add Category Page</title>
   <link href="Content/bootstrap.css" rel="stylesheet" />
   <script src="Scripts/jquery-1.9.1.js"></script>
   <script src="Scripts/bootstrap.js"></script>
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
     <?php
     require '../DatabaseClasses/config.php';
     require_once '../DatabaseClasses/category.php';
     require_once '../DatabaseClasses/user.php';
     $user = isLogged();
     if (!isAdmin($user))
       header("location:login.php");
     $categories = category::select();
     ?>
     <table class = "table table-striped">
         <tr>
             <td>Number</td>
             <td>Name</td>
             <td>Action</td>
         </tr>

         <?php
         if (count($categories) > 0) {
             $number = 1;
             foreach ($categories as $category){

                         ?>
                         <tr>
                             <td><?= $number ?></td>
                             <td><?= $category ?></td>
                             <td><a class="btn-danger" href="editcategory.php?name=<?= $category ?>">Edit category</a></td>
                         </tr>
                         <?php
                         $number++;
                     }
                 }
          else {
             echo '<tr><td clospan="3">No Products</td></tr>';
         }
         ?>


     </table>





     <form action="addcategoryprocess.php" method="post">
      <div class="form-group">
        <label for="name">Category Name : </label>
        <input type="text" class="form-control" name="name">
      </div>

      <button type="submit" class="btn btn-default">Add</button>
     </form>
</div>


 </body>
 </html>
