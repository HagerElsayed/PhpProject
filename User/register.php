<?php
require_once '../DatabaseClasses/user.php';
require_once '../DatabaseClasses/interests.php';

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

    $interest_name = implode(',', $checkboxes);

    if (isset($_POST["email"])) {
        if ($valid) {
            $interest = new interests($_POST['email'], null, $interest_name);
            //var_dump($_POST['email']);
            if ($interest->insert()) {
                echo ' Interests is inserted';
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
            <div class="checkbox">
                <label for="interest" class="col-sm-4 control-label">Interests</label>
                <div class="col-sm-4">
                    <label>
                        <input type="checkbox" name="interest[]" value="Clothes"> Clothes<br>
                        <input type="checkbox" name="interest[]" value="Technology"> Technology<br>
                        <input type="checkbox" name="interest[]" value="Books"> Books<br>

                    </label>
                </div>
            </div>
            <br>
            <br>
            <br><br><br>

            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-5">
                    <input type="submit" name ="register" class="btn btn-primary" value="Sign Up">
                    <button type="reset" class="btn btn-warning">Reset</button>
                </div>
            </div>




        </form>

    </body>
</html>