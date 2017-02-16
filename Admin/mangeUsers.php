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
                        <li><a href="../Admin/mangeUsers.php">Manage Users</a></li>

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Manage Product
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
//require_once '../config.php';
            require_once '../DatabaseClasses/user.php';


            $user = isLogged();
            if (isAdmin($user)) {
                //List All users
                $users = user::getAll();
                if (isset($_GET['message'])) {
                   // echo $_GET['message'] . "<br/>";
                }
                ?>
                <table class = "table table-striped">
                    <tr>
                        <td>Username</td>
                        <td>Email</td>
                        <td>Status</td>
                        <td>Regiester At</td>
                        <td>Updated At</td>
                        <td colspan="2" >Action</td>
                    </tr>

                    <?php
                    if (count($user) > 0) {


                        foreach ($users as $user) {
                            if ($user->id != 1) {
                                $new_staus = ($user->status == STATUS_ACTIVE) ? STATUS_INACTIVE : STATUS_ACTIVE;
                                if ($user->status != STATUS_DELETED) {
                                    ?>
                                    <tr>
                                        <td><?= $user->username ?></td>
                                        <td><?= $user->email ?></td>
                                        <td><?= user::$user_status[$user->status]; ?></td>
                                        <td><?= $user->registered_at ?></td>
                                        <td><?= $user->update_at ?></td>
                                        <td><a class="btn-danger" href="userDelete.php?id=<?= $user->id ?>">Delete</a></td>
                                        <td><a  class="btn-primary"href="userChangeStatus.php?id=<?= $user->id ?>&status=<?= $new_staus ?>">

                                                <?= ($user->status == STATUS_ACTIVE) ? 'Deactivate' : 'Activate' ?>

                                            </a></td>

                                    </tr>

                                    <?php
                                }
                            }
                        }
                    } else {
                        echo '<tr><td clospan="5">No Users</td></tr>';
                    }
                    ?>


                </table>

                <?php
            }
            ?>




        </div><!--End of control-->

        <script src="../bootstrap/Scripts/jquery-1.9.1.js" type="text/javascript"></script>
        <script src="../bootstrap/Scripts/bootstrap.js" type="text/javascript"></script>


    </body>


</html>
