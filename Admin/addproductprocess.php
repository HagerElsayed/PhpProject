<?php

require_once "imageUpload.php";
require_once "../DatabaseClasses/config.php";
require_once "../DatabaseClasses/subcategory.php";
require_once "../DatabaseClasses/product.php";
require_once "../DatabaseClasses/path.php";


if($_FILES["profilephoto"]["name"]!=""){
  $profilephoto = imageupload("profilephoto");
  $subcategory_id = subcategory::selectByName($_POST['subcategory']);

  $product = new product(null,$subcategory_id[0],$_POST['name'],$_POST['quantity'],$_POST['description'],$_POST['price'],$profilephoto);
  $product->insert();

  $product_id = product::selectByName($_POST['name']);
}
else {
  exit;
}
if($_FILES["photo1"]["name"]!=""){
  $photo1 = imageupload("photo1");
  $path1 = new path($product_id[0],$photo1);
  $path1->insert();
}
if($_FILES["photo2"]["name"]!=""){
  $photo2 = imageupload("photo2");
  $path2 = new path($product_id[0],$photo2);
  $path2->insert();
}
if($_FILES["photo3"]["name"]!=""){
  $photo3 = imageupload("photo3");
  $path3 = new path($product_id[0],$photo3);
  $path3->insert();
}
header('location:manageproducts.php');
 ?>
