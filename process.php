<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'dbconfig.php';
    $email = $_POST['email'];
	$nationality = $_POST['nationality'];
	$status = $_POST['status'];
	$language = $_POST['language'];
    $errors = "";
    $phonenumber = $_SESSION['phonenumber'];
    var_dump($phonenumber);
    
    $user_check_query = "SELECT * FROM user WHERE  phonenumber='$phonenumber' LIMIT 1";
    $result = mysqli_query($db_con, $user_check_query);
    $row =mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    var_dump($count);
  if ($count == 1) {
	$sql = $db_con->prepare("UPDATE `user` SET email = '$email', nationality='$nationality', status='$status', language='$language' WHERE phonenumber = '$phonenumber'");
	$sql->bind_param('ssss', $email, $nationality, $status, $language);
	if ($sql->execute()) {
        header("Location: pricing.php");
            exit;
    }
    else{
        echo "Error, check values " . $sql->error;

    }
}
}
?>