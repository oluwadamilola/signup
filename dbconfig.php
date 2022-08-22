<?php
$servername = "localhost";
$username = "dolukoju";
$password = "Hz)*PCU]SuQhnY8]";
$dbname = "signup";

$db_con = new mysqli($servername, $username, $password, $dbname);

if ($db_con->connect_error) {
    printf("connect failed: %s\n, 
    ", $db_con->connect_error);
    exit();
}
?> 