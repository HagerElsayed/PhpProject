<?php

require_once '../DatabaseClasses/user.php';

$user = isLogged();
if (isAdmin($user)) {
    $id = $_GET['id'];
   

    $user = user::getById($id);
    $user->status=STATUS_DELETED;

    if ($user->update()) {
        $message = 'user is deleted';
    } else {
        $message = 'user not deleted';
    }
    header("Location:mangeUsers.php?message=$message");
}
?>

