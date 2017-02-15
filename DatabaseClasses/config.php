  <?php

define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', 'iti');
define('DBNAME', 'phpProject');
$mysqli = new mysqli(DBHOST, DBUSER,DBPASS);
// open connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit;
}
$mysqli->select_db(DBNAME);



?>
