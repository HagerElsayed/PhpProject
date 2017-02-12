<?php

require_once '../DatabaseClasses/user.php';

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    //global $mysqli;

    $user = user::getByEmail($email);
    if ($user != null) {
        echo '1'; //<<<<==this mean this email already exist;
    }
}
?>

