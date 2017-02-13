<?php
require_once '../DatabaseClasses/user.php';

  session_start();

  if(isset($_SESSION['loggeduser']))
  {
     $loggeduser=$_SESSION['loggeduser'];
     echo "user" ;

  }
  else {
    echo "not logged";
    // header('Location:login.php');
      }

 ?>

<a href="logout.php"> logout</a>
