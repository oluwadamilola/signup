<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'dbconfig.php';
    $firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
    $phonenumber =  mysqli_real_escape_string($db_con, $_POST['phonenumber']);
    $gender = $_POST['gender'];
    $dateofbirth = $_POST['dateofbirth'];
    $email = $_POST['email'];
    $errors = "";
    
$mobilenumber =$_POST['phonenumber'];
$_SESSION['phonenumber'] = $mobilenumber;
$_SESSION['email'] = $_POST['email'];
       # code...
    
  

    $user_check_query = "SELECT * FROM user WHERE  phonenumber='$phonenumber' LIMIT 1";
    $result = mysqli_query($db_con, $user_check_query);
 $row =mysqli_fetch_array($result, MYSQLI_ASSOC);

$count = mysqli_num_rows($result);
  if ($count ==1) {
      $errors ="user already exist";
      echo $errors;  
  }
 else {
    $sql = $db_con->prepare("INSERT INTO user ( firstname, lastname, phonenumber, dateofbirth, gender,email)VALUES(?,?,?,?,?,?)");
    $sql->bind_param("ssssss", $firstname, $lastname, $phonenumber, $dateofbirth, $gender,$email);
    
    if ($sql->execute()) {
        header("Location: form.php");
            exit;
    }
    else{
        echo "Error, check values " . $sql->error;

    }
    
    $db_con->close();
 }
    
}

?>