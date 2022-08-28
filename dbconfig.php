<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "signup";

$db_con = new mysqli($servername, $username, $password, $dbname);

if ($db_con->connect_error) {
    printf("connect failed: %s\n, 
    ", $db_con->connect_error);
    exit();
}
?> 