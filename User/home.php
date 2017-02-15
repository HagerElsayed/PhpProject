<?php

require_once '../DatabaseClasses/product.php';

?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="UTF-8">
     <title>Home Page</title>
     <link href="../bootstrap/Content/bootstrap.css" rel="stylesheet" type="text/css"/>
   </head>
   <body>
     <form class="form-group" style="margin:50px">
       <h2 > welcome</h2>
      <div >
       <a href="login.php"  class="btn btn-default btn-lg active" role="button">Login</a>
       <a href="register.php" class="btn btn-default btn-lg active" role="button">Register</a>
      </div>

  </form>
   </body>
 </html>

<?php
$product=product::select();
var_dump($product);

 ?>
