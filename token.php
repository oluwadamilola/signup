<?php
include 'dbconfig.php';

$token_check_query = "SELECT token
FROM token
WHERE date between DATE_SUB( CURDATE() , INTERVAL 15 DAY )
AND CURDATE()";
$result = mysqli_query($db_con, $token_check_query);
$token = mysqli_fetch_assoc($result);
$new_token = mysqli_fetch_object($result);

var_dump($token['token']);

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
//   $json_resp = json_decode($resp);
//   $access_token = $json_resp->access_token;
  $date = CURDATE();
  var_dump(date);
  }
  
  generateToken();
 
if (($token['token']) === null){

    echo "oops";
}
else{
    echo "helllooooo";
}


// var_dump($token);
// var_dump($new_token);
// $token = array();

// if ($token) {
    
//     if ($token['token'] === null) {
//         array_push($errors, "email already exists");
//       }
      
// }        
    

// if (count($errors)=== 0) {

// $sql = $db_con->prepare("INSERT INTO token (surname, firstname, email, roles, branch)VALUES(?,?,?,?,?)");
//     $sql->bind_param("sssss", $surname,$firstname,$email,$roles,$branch);
//     $sql->execute();





































// $token_query = "SELECT * 
// FROM token 
// WHERE date >= getdate() 
// AND date <= dateadd(day, 0, getdate())";
// $result = mysqli_query($db_con, $token_query);
// $row =mysqli_fetch_array($result, MYSQLI_ASSOC);
// var_dump($row);

?>