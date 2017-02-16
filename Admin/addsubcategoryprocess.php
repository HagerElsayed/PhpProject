<?php
require_once "../DatabaseClasses/config.php";
require_once "../DatabaseClasses/subcategory.php";


$subcategory = new subcategory(null,$_POST['name'],$_POST['category']);
$subcategory->insert();
header('location:addsubcategory.php');

 ?>
