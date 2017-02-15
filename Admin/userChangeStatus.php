<?php

require_once '../DatabaseClasses/user.php';

$user = isLogged();
if (isAdmin($user)) {
    $id = $_GET['id'];
    $stauts = $_GET['status'];

    $user = user::getById($id);
    $user->status = $stauts;

    if ($user->update()) {
        $message = 'user status is changed';
    } else {
        $message = 'user statuse not changed';
    }
    header("Location:mangeUsers.php?message=$message");
}
?>

