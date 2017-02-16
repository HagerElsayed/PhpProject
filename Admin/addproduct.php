<?php


//check for the user to be the admin only
//require_once 'functions.php';
require_once '../DatabaseClasses/user.php';
require_once '../DatabaseClasses/category.php';
$categoryList = subcategory::selectAllCategories();
//add product page



$user = isLogged();
if (isAdmin($user)){
  $users = user::getAll();
}
else {
  header("location:./login.php");
}

 ?>

 <!doctype html>
 <html>
 <head>
   <meta charset=utf-8>
   <title>Add Product Page</title>
   <link href="Content/bootstrap.css" rel="stylesheet" />
   <script src="Scripts/jquery-1.9.1.js"></script>
   <script src="Scripts/bootstrap.js"></script>
   <script type="text/javascript">
 		$(function(){
       $("#categoryList").on("change",function(){
          var chosenCategory = $(this).val();
         $.ajax({
           url:"selectcategory.php",
           method:"POST",
           data:"category_name=" +chosenCategory,
           async: true,
           success:function(data){
             var subCategoryArray = JSON.parse(data);//Edit this
            $("#subCategoryList").html("");
             for (i = 0; i <subCategoryArray.length; i++) {
      		   	  var current = $("<option></option>").text(subCategoryArray[i]).attr('value',subCategoryArray[i]);
                $("#subCategoryList").append(current);
           }
         },
         error:function(){
           console.log(error);
         }
       });
     });
   });
 	</script>
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
     <form action="addproductprocess.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">Product Name : </label>
        <input type="text" class="form-control" name="name">
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name ="description" cols="5" rows="10"></textarea>
      </div>
      <div class="form-group">
        <label for="price">price</label>
        <input type="number" class="form-control" name="price">
      </div>
      <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="number" class="form-control" name="quantity">
      </div>
      <div class="form-group">
        <label for="profilePhoto">Profile Photo :</label>
        <input type="file" class="form-control" name="profilephoto">
      </div>
      <div class="form-group">
        <label for="address">More Photos :</label>
        <input type="file" class="form-control" name="photo1">
        <input type="file" class="form-control" name="photo2">
        <input type="file" class="form-control" name="photo3">
      </div>
      <div class="form-group">
        <label>Category :</label>
        <select id="categoryList">
          <option>choose category ...</option>
          <?php
            foreach ($categoryList as $value) {
              echo "<option>".$value."</option>";
            }
           ?>
        </select>
        <select id="subCategoryList" name="subcategory">
          <option>choose subcategory ...</option>
        </select>
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
     </form>
</div>

 </body>
 </html>
