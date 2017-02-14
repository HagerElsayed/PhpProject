<?php
//require_once '../config.php';
require_once '../DatabaseClasses/user.php';

$user = isLogged();
if(isAdmin($user))
{
?>
<a href="../Admin/mangeUsers.php">Manage Users</a>
<a href="">Manage Product</a>


<?php

}
?>


<a href="../User/logout.php">Logout</a>

