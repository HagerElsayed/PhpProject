<html>
    <head>
        <link href="../bootstrap/Content/bootstrap.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>
        <div class="container">
            <!--        navigation Bar-->

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
                require_once '../DatabaseClasses/user.php';
                require_once '../DatabaseClasses/product.php';
                require_once '../DatabaseClasses/subcategory.php';
                $user = isLogged();
                if (!isAdmin($user))
                  header("location:./login.php");
                $products = product::select();
                ?>
                <table class = "table table-striped">
                    <tr>
                        <td>id</td>
                        <td>Name</td>
                        <td>Quantity</td>
                        <td>description</td>
                        <td>price</td>
                        <td>subcategory</td>
                        <td>photo</td>
                        <td>Action</td>
                    </tr>

                    <?php
                    if (count($products) > 0) {
                        foreach ($products as $product) {

                                    ?>
                                    <tr>
                                        <td><?= $product->id ?></td>
                                        <td><?= $product->name ?></td>
                                        <td><?= $product->quantity ?></td>
                                        <td><?= $product->description ?></td>
                                        <td><?= $product->price ?></td>
                                        <td><?php $result = subcategory::selectById($product->subcategory_id);echo $result[0];   ?></td>
                                        <td><?= $product->photo ?></td>
                                        <td><a class="btn-danger" href="editproduct.php?id=<?= $product->id ?>">Edit product</a></td>
                                    </tr>
                                    <?php
                                }
                            }
                     else {
                        echo '<tr><td clospan="5">No Products</td></tr>';
                    }
                    ?>


                </table>





        </div><!--End of control-->

        <script src="../bootstrap/Scripts/jquery-1.9.1.js" type="text/javascript"></script>
        <script src="../bootstrap/Scripts/bootstrap.js" type="text/javascript"></script>


    </body>


</html>
