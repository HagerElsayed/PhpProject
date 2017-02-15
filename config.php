<?php
ob_start();
define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', 'iti');
define('DBNAME', 'phpProject');
$mysqli = new mysqli(DBHOST, DBUSER, DBPASS);
// open connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit;
}
$mysqli->select_db(DBNAME);

define('STATUS_ACTIVE', 1);
define('STATUS_INACTIVE', 2);
define('STATUS_DELETED', 0);

function isLogged() {
    @session_start();

    if (isset($_SESSION['loggeduser'])) {
        $loggeduser = $_SESSION['loggeduser'];

        //echo 'hi ' . $loggeduser->username;
        return $loggeduser;
    } else {
        header("Location:../User/login.php");
    }
}

function isAdmin($user) {
    if ($user->id == 1) {
        return true;
    } else {
        session_start();
        session_destroy();
        header("Location:../User/login.php");
    }
}

?>
