<?php

require_once '../DatabaseClasses/config.php';
require_once '../DatabaseClasses/product.php';
$product = new product($_POST['id'],null,$_POST['name'],$_POST['quantity'],$_POST['description'],$_POST['price'],null);
$product->update();
header('location:manageproducts.php');
 ?>
