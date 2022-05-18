<?PHP
$firstname ="";
$lastname ="";
$gender = "";
$dob = "";
$phonenumber ="";
$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require 'dbconfig.php';

    $firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
    $phonenumber =  $_POST['phonenumber'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
	$database = "signup";

    
    $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);

    $sql = "SELECT id FROM user WHERE  phonenumber = '$phonenumber'";
    $result = mysqli_query($db_con, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if ($row->num_rows > 0) {
			$errorMessage = "Username already taken";
		}
		else {
			$SQL = $conn->prepare("INSERT INTO user (firstname,lastname, phonenumber, gender,dob) VALUES (?, ?,?,?,?)");
			$SQL->bind_param('sssss', $firstname,$lastname, $phonenumber, $gender, $dob);
			$SQL->execute();

			header ("Location: form.html");
		}
       
	}

?>

	<html>
	<head>
	<title>Basic Signup Script</title>


	</head>
	<body>


<FORM NAME ="form1" METHOD ="POST" ACTION ="signup.php">

Username: <INPUT TYPE = 'TEXT' Name ='username'  value="<?PHP print $uname;?>" >
Password: <INPUT TYPE = 'TEXT' Name ='password'  value="<?PHP print $pword;?>" >

<P>
<INPUT TYPE = "Submit" Name = "Submit1"  VALUE = "Register">


</FORM>
<P>

<?PHP print $errorMessage;?>

	</body>
	</html>
