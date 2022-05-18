<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'dbconfig.php';
    $firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
    $phonenumber =  mysqli_real_escape_string($db_con, $_POST['phonenumber']);
    $gender = $_POST['gender'];
    $dateofbirth = $_POST['dateofbirth'];
    $errors = "";
    // $phonenumber = $_POST['phonenumber'];
    // $date = $_POST['date'];

    $user_check_query = "SELECT * FROM user WHERE  phonenumber='$phonenumber' LIMIT 1";
    $result = mysqli_query($db_con, $user_check_query);
 $row =mysqli_fetch_array($result, MYSQLI_ASSOC);

$count = mysqli_num_rows($result);
  if ($count ==1) {
      $errors ="user already exist";
      echo $errors;
  }

?>



<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title> Health Connect 24x7 </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- MATERIAL DESIGN ICONIC FONT -->
	<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
	<!-- STYLE CSS -->
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	
	<div class="wrapper" style="background-image: url('images/5.jpg');">
		<div class="inner">
			<form action="" method="POST">
				<div class="form-wrapper">
					<label for="">Email</label>
					<input type="email" class="form-control" name="email">
				</div>
				<div class="form-wrapper">
					<label for="">Nationality</label>
					<input type="text" class="form-control" name="nationality">
				</div>
				<div class="form-wrapper">
					<label for="">Marital Status</label>
					<select class="form-control" name="status">
						<option value="">select</option>
						<option value="Single">Single</option>
						<option value="Married">Married</option>
                        <option value="Divorced">Divorced</option>
					</select>
				</div>
                <div class="form-wrapper">
					<label for="">Language</label>
					<select class="form-control" name="language">
						<option value="">select</option>
						<option value="English">English</option>
						<option value="Hausa">Hausa</option>
                        <option value="Igbo">Igbo</option>
                        <option value="Yoruba">Yoruba</option>
					</select>
				</div>
				<div class="form-group">
					<button class="button" name="submit">Submit</button> 
					<button class="button"">Skip</button>
				</div>
				
			</form>
		</div>
	</div>

</body>

</html>