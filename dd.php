<?php

$firstname ="";
$lastname ="";
$gender = "";
$dob = "";
$phonenumber ="";
include 'dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
    $phonenumber =  $_POST['phonenumber'];
    $gender = $_POST['gender'];
    $dateofbirth = $_POST['dateofbirth'];
}
$user_check_query = "SELECT * FROM user WHERE  phonenumber='$phonenumber' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
    
            if ($user['phonenumber'] === $phonenumber) {
                array_push($errors, "phone number already exists");
              }
              
        }
    
if (count($errors)=== 0) {
 
    $sql = $conn->prepare("INSERT INTO user ( firstname, lastname, phonenumber, dateofbirth, gender)VALUES(?,?,?,?,?)");
        $sql->bind_param("sssss", $firstname, $lastname, $phonenumber, $dateofbirth, $gender);
        $sql->execute();
        
    }else
    {
     echo error;   
    }




$sql = "INSERT INTO 'user'('firstname', 'lastname', 'phonenumber', 'gender', 'dateofbirth') VALUES('$firstname', '$lastname', '$phonenumber','$gender', '$dateofbirth')";
$result = $conn->query($sql);
if ($result == TRUE) {
    echo "oshey baddest";
}
else{
    echo "Error:".$sql. "<br>".$conn->error;
}

$conn->close();

?>