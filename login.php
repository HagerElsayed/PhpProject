<?php

require_once '../DatabaseClasses/user.php';

$emailErr = $passwordErr = "";
$valid = true;

if (isset($_POST['login']))
{
    if(isset($_POST['remember me']))
    {
        setcookie("user",$user, time()+(60*60*24*7));
    }
global $mysqli;
global $emailErr , $passwordErr;
global $valid;
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
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($password == null) {
    $passwordErr = 'password is required';
    $valid = false;
}
if($valid)
{
  user::login();
}

}//end validation
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
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

                  //=====Validation By JQuary ============================
                  $("#login-form").validate({
                      rules: {
                          email: {
                              required: true,
                              email: true
                          },
                          password: {
                              required: true,
                              password: true

                          }

                      },

                      submitHandler: function (form) {
                          form.submit();
                      }
                  });//end of validation

              });//end of load function



    </script>
  <body>
    <form class="form-horizontal" method="POST" id="login-form">
      <br />
        <div class="form-group">
              <label for="email" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-4">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                  <span class = "error"> <?= $emailErr ?></span>
              </div>
        </div>
        <div class="form-group">
              <label for="password" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-4">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                  <span class = "error"> <?= $passwordErr ?></span>
              </div>
        </div>
        <div class="col-sm-offset-3 col-sm-10">
          <button type="submit" class="btn btn-success" name="login">login</button>
          <button type="reset" class="btn btn-warning">Reset</button>
        </div>
      </form>
  </body>
</html>
