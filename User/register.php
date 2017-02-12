<?php
require_once '../DatabaseClasses/user.php';

$usernameErr = $emailErr = $passErr = $credit_limitErr = "";

$valid = true;

if (isset($_POST['register'])) {

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
        //require_once '../DataBase/user.php';
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
    //$birthday = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $birthday = $_POST['birthday'];





    if ($valid) {
        //$user = new user(1, 'admin', 'admin', 'admin@admin.com', '2017-02-12', 2000, 'Developer', 'Mansoura');
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

    <body>
        <form class="form-horizontal" method="post">
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
                    <span class = "error"> <?= $emailErr ?></span>

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

            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-5">
                    <input type="submit" name ="register" class="btn btn-primary" value="Sign Up">
                    <button type="reset" class="btn btn-warning">Reset</button>
                </div>
            </div>



        </form>

    </body>
</html>