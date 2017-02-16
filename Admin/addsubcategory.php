<?php


//check for the user to be the admin only



 ?>
 <!doctype html>
 <html>
 <head>
   <meta charset=utf-8>
   <title>Add SubCategory Page</title>
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
     <?php
     require '../DatabaseClasses/config.php';
     require_once '../DatabaseClasses/category.php';
     require_once '../DatabaseClasses/user.php';
     require_once '../DatabaseClasses/subcategory.php';
     $user = isLogged();
     if (!isAdmin($user))
       header("location:./login.php");
     $subcategories = subcategory::select();
     $categoryList = category::Select();

     ?>
     <table class = "table table-striped">
         <tr>
             <td>Number</td>
             <td>Name</td>
             <td>Category Name</td>
             <td>Action</td>
         </tr>

         <?php
         if (count($subcategories) > 0) {
             $number = 1;
             foreach ($subcategories as $subcategory){

                         ?>
                         <tr>
                             <td><?= $subcategory->id ?></td>
                             <td><?= $subcategory->name ?></td>
                             <td><?= $subcategory->category_name ?></td>
                             <td><a class="btn-danger" href="editsubcategory.php?name=<?= $subcategory->name ?>">Edit subcategory</a></td>
                         </tr>
                         <?php
                         $number++;
                     }
                 }
          else {
             echo '<tr><td clospan="4">No Products</td></tr>';
         }
         ?>


     </table>





     <form action="addsubcategoryprocess.php" method="post">
      <div class="form-group">
        <label for="name">Name : </label>
        <input type="text" class="form-control" name="name">
      </div>

      <div class="form-group">
        <label>Category :</label>
        <select id="categoryList" name="category">
          <option>choose category ...</option>
          <?php
            foreach ($categoryList as $value) {
              echo "<option>".$value."</option>";
            }
           ?>
        </select>
      </div>

      <button type="submit" class="btn btn-default">Add</button>
     </form>
</div>


 </body>
 </html>
