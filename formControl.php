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

//validate token expiry date
        $token_check_query = "SELECT token
        FROM token
        WHERE date between DATE_SUB( CURDATE() , INTERVAL 15 DAY )
        AND CURDATE()";
        $result = mysqli_query($db_con, $token_check_query);
        $token = mysqli_fetch_assoc($result);
        $new_token = mysqli_fetch_object($result);
        
        var_dump($token['token']);
       // function generate new token
        function generateToken()  {
            $url = "https://aohs1.trudoc24x7.info/api/oauth/token";
            $curl = curl_init($url);
          curl_setopt($curl, CURLOPT_URL, $url);
          curl_setopt($curl, CURLOPT_POST, true);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          
          $headers = array(
             "Accept: application/json",
             "Content-Type: application/json",
          );
          curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
          
          $data = <<<DATA
          {
            "grant_type": "client_credentials",
            "client_id": 65,
            "client_secret": "UKEreLUsq98QaKc8nDHPsiR8nzLzIS32st5l0qTs"
            
          }
          DATA;
          
          curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
          
          //for debug only!
          curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
          curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
          
          $resp = curl_exec($curl);
          curl_close($curl);
          var_dump($resp);
          $date = date("Y-m-d"); 
          var_dump($date);
        
          $json_resp = json_decode($resp);
          $access_token = $json_resp->access_token;
          var_dump($access_token);
        
          $update_token_query  = $db_con->prepare("UPDATE token SET token=?, date=? WHERE id=1");
          $update_token_query->bind_param('ss', $access_token, $date);
          $update_token_query->execute(); 
          }
           
        if (($token['token']) === null){
          generateToken();
        }
        
        $token_check_query = "SELECT token FROM token WHERE id = 1";
        $result = mysqli_query($db_con, $token_check_query);
        $token = mysqli_fetch_assoc($result);
        var_dump($token['token']);
        
        
        // adding new user to the emr
        $service_url = "https://aohs1.trudoc24x7.info/api/v1/census/addSinglePatient";
        
        $curl = curl_init($service_url);
        curl_setopt($curl, CURLOPT_URL, $service_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $auth_headers = array(
           "Accept: application/json",
           "Content-Type: application/json",
           'access-token: Bearer ' . $token['token'],
           'Authorization: Bearer ' . $token['token'],
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $auth_headers );
        
        $user_data = <<<DATA
        {
          "first_name": $firstname,
          "last_name": $lastname ,
          "gender": $gender,
          "date_of_birth":  $dateofbirth,
          "country_id": "1",
          "city_id": "1",
          "national_id": "11111111111",
          "nationality_id": "1",
          "mobile":  $phonenumber,
          "company_code": "EkoTeleMed"
          }
        DATA;
        
        curl_setopt($curl, CURLOPT_POSTFIELDS, $user_data);
        
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        
        $resp = curl_exec($curl);
        curl_close($curl);
        var_dump($resp);
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