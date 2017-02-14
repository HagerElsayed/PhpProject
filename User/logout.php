<?php
session_start();
unset($_SESSION['loggeduser']);
header("Location:login.php");



 ?>
