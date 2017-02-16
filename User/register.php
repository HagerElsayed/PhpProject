<?php
require_once '../DatabaseClasses/user.php';
require_once '../DatabaseClasses/interests.php';
//require_once '../DatabaseClasses/subcategory.php';
//require_once '../function.php';
//========global Variables =================
$usernameErr = $emailErr = $passErr = $credit_limitErr = "";
$valid = true;
if (isset($_POST['register'])) {
//============ Vslidation With PHP =======================
    global $usernameErr, $emailErr, $passErr, $credit_limitErr;
    global $valid;
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if ($username == null) {
        $usernameErr = 'Userame is required';
        $valid = false;
    }

    $credit_limit = filter_input(INPUT_POST, 'credit_limit', FILTER_SANITIZE_NUMBER_INT);
    if ($credit_limit == null) {
        $credit_limitErr = 'Credit limit is required';

        $valid = false;
    }

    $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if ($pass == null) {
        $passErr = 'password is required';
        $valid = false;
    } else {
        if ($pass < '3') {
            $passErr = 'password should be more than 3 character';
            $valid = false;
        } else {
            $pass = sha1($pass);
        }
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    if ($email == null) {
        $emailErr = 'email is required';
        $valid = false;
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $valid = false;
        }
    }
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $job = filter_input(INPUT_POST, 'job', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $birthday = $_POST['birthday'];

//========== Interests Trial ==========

    $checkboxes = $_POST['interest'];

//$interest_name = implode(',', $checkboxes);
    foreach ($checkboxes as $interest_name) {
        if (isset($_POST["email"])) {
            if ($valid) {
                $interest = new interests($_POST['email'], null, $interest_name);
                //var_dump($_POST['email']);
                if ($interest->insert()) {
                    echo ' Interests is inserted';
                }
            }
        }
    }
//========= Insertion ===================
    if ($valid) {
        $user = new user(null, $username, $pass, $email, $birthday, $credit_limit, $job, $address);
        if ($user->insert()) {
            header("Location:profile.php");
//echo 'User is Inserted';
        }
    }
//var_dump($_POST);
}
?>



<!DOCTYPE html>
<html lang="en">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Home | E-Shopper</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/font-awesome.min.css" rel="stylesheet">
        <link href="../css/prettyPhoto.css" rel="stylesheet">
        <link href="../css/price-range.css" rel="stylesheet">
        <link href="../css/animate.css" rel="stylesheet">
        <link href="../css/main.css" rel="stylesheet">
        <link href="../css/responsive.css" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="../images/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="../images/ico/apple-touch-icon-57-precomposed.png">
        <meta charset="UTF-8">
        <title>Document</title>
        <link href="../bootstrap/Content/bootstrap.css" rel="stylesheet" type="text/css"/>
        <style>

            .error{
                color: red;
            }
        </style>
    </head>

    <script src="../bootstrap/jquery-3.1.1.min.js"></script>
    <script src="../bootstrap/jquery.validate.min.js"></script>
    <script type="text/javascript">

        $(function () {

            //============= Check if Email Exists or Not using Ajax ====================
            $("#email").on('blur', function (event) {
                console.log("blur");
                $.ajax({
                    url: "emailChecker.php",
                    method: "post",
                    data: "email=" + $(this).val(),
                    async: true,
                    success: function (data) {

                        if (data == 1)
                        {
                            $("#emailInfo").html("Sorry,This is email Already Exist");
                            $("#register").prop("disabled", true);

                        } else {
                            $("#emailInfo").html("");
                            $("#register").prop("disabled", false);
                        }
                        console.log(data);


                    }
//                    ,
//                    error: function (error) {
//                        console.log(error);
//                    }
                });//end of ajax

            }); //end of blur function


            //=====Validation By JQuary ============================
            $("#register-form").validate({
                rules: {
                    username: "required",

                    email: {
                        required: true,
                        email: true
                    },
                    pass: {
                        required: true,
                        minlength: 3
                    },
                    credit_limit: "required"

                },

                //========== validation error messages=================
                messages: {
                    username: "Please enter your Name",

                    pass: {
                        required: "Please Enter your Password",
                        minlength: "Your password must be at least 3 characters long"
                    },
                    email: "Please Enter a valid Email Address",
                    credit_limit: "Please Enter your Creadit Limit"

                },

                submitHandler: function (form) {
                    form.submit();
                }
            });//end of validation




        });//end of load function


    </script>

    <body>
        <header id="header"><!--header-->


            <div class="header-middle"><!--header-middle-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="logo pull-left">
                                <a href="index.html"><img src="../images/home/logo.png" alt="" /></a>
                            </div>

                        </div>
                        <div class="col-sm-8">
                            <div class="shop-menu pull-right">
                                <ul class="nav navbar-nav">
                                    <li><a href=""><i class="fa fa-user"></i> Account</a></li>
                                    <li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                                    <li><a href="login.html" ><i class="fa fa-lock"></i> Login</a></li>
                                    <li><a href="register.php"  class="active"><i class="fa fa-lock"></i> Sign Up</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-middle-->

            <div class="header-bottom"><!--header-bottom-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="mainmenu pull-left">
                                <ul class="nav navbar-nav navbar-collapse collapse" style="height: 0.909091px;">
                                    <li><a href="index.html">Home</a></li>
                                    <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                        <ul role="menu" class="sub-menu">
                                            <li><a href="shop.html">Products</a></li>
                                            <li><a href="product-details.html">Product Details</a></li>
                                            <li><a href="cart.html">Cart</a></li>
                                            <li><a href="login.html" >Login</a></li>
                                            <li><a href="register.php" class="active" >Sign Up</a></li>
                                        </ul>
                                    </li>


                                    <li><a href="../contact-us.html">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="search_box pull-right">
                                <input type="text" placeholder="Search">
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-bottom-->
        </header><!--/header-->



        <form class="form-horizontal" method="post" id="register-form">
            <br>
            <br>
            <div class="form-group">
                <label for="name" class="col-sm-4 control-label">Name*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="name"  name="username" placeholder="Name" value="<?= isset($username) ? $username : '' ?>">
                    <span class = "error"> <?= $usernameErr ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-4 control-label">Email*</label>
                <div class="col-sm-4">
                    <input type="email" class="form-control" id="email" name="email" value="<?= isset($email) ? $email : '' ?>" placeholder="Email" >
                    <span class = "error" id="emailInfo"> <?= $emailErr ?></span>

                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-4 control-label">Password*</label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" id="password" name="pass" value="<?= isset($pass) ? $pass : '' ?>" placeholder="Password">
                    <span class = "error"> <?= $passErr ?></span>

                </div>
            </div>

            <div class="form-group">
                <label for="birthday" class="col-sm-4 control-label">Birthday</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" name="birthday" id="birthday" value="<?= isset($birthday) ? $birthday : '' ?>" placeholder="yyyy-mm-dd">

                </div>
            </div>
            <div class="form-group">
                <label for="job" class="col-sm-4 control-label">Job</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="job" name="job" value="<?= isset($job) ? $job : '' ?>" placeholder="Job">

                </div>
            </div>

            <div class="form-group">
                <label for="address" class="col-sm-4 control-label">Address</label>
                <div class="col-sm-4">
                    <input type="address" class="form-control" name="address" id="address" value="<?= isset($address) ? $address : '' ?>" placeholder="Address">

                </div>
            </div>

            <div class="form-group">
                <label for="credit_limit" class="col-sm-4 control-label">Credit Limit*</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" name="credit_limit" id="credit_limit" value="<?= isset($credit_limit) ? $credit_limit : '' ?>" placeholder="Credit Limit">
                    <span class = "error"> <?= $credit_limitErr ?></span>

                </div>
            </div>

            <label for="interest" class="col-sm-4 control-label">Interests</label>

            <div class="checkbox">
                <div class="col-sm-4">

                    <label>
                        <?php

                        function selectAllSubCategories() {
                            global $mysqli;
                            $subcategoryList = array();
                            $query = "select name from subcategory";
                            $stmt = $mysqli->prepare($query);
                            if (!$stmt)
                                return false;
                            if (!$stmt->execute())
                                return false;
                            $result = $stmt->get_result();
                            while ($row = $result->fetch_array()) {
                                if (!in_array($row[0], $subcategoryList))
                                    $subcategoryList[] = $row[0];
                            }
                            $stmt->close();
                            $mysqli->close();
                            return $subcategoryList;
                        }

                        $subcategory = selectAllSubCategories();

                        echo "<br>";
                        foreach ($subcategory as $sub_category) {
                            ?>
                            <input type = "checkbox" name = "interest[]" value = "<?= $sub_category ?>"> <?= $sub_category ?><br>
                            <?php
                        }
                        ?>


                    </label>
                </div>
            </div>
            <br>
            <br>
            <br><br><br>

            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-5">
                    <input type="submit" name ="register" class="btn btn-primary" value="Sign Up">

                </div>
            </div>  
        </form>

        <footer id="footer"><!--Footer-->
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="companyinfo">
                                <h2><span>e</span>-shopper</h2>
                                <p></p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>



            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <p class="pull-left">Copyright © 2016 E-SHOPPER Inc. All rights reserved.</p>
                    </div>
                </div>
            </div>

        </footer><!--/Footer-->



    </body>
</html>