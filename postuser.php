<?php
include 'dbconfig.php';
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
  "first_name": "sundayTest",
  "last_name": "health connect",
  "gender": "female",
  "date_of_birth": "1992-05-19",
  "country_id": "1",
  "city_id": "1",
  "national_id": "11111111111",
  "nationality_id": "1",
  "mobile": "07038240093",
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

?>