<?php
function  addSingleUser() {
 // generating token from the token endpoint
$base_url = "https://aohs1.trudoc24x7.info";

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

$json_resp = json_decode($resp);
$access_token = $json_resp->access_token;

// adding new user to the emr
$service_url = "https://aohs1.trudoc24x7.info/api/v1/census/addSinglePatient";

$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_URL, $service_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$auth_headers = array(
   "Accept: application/json",
   "Content-Type: application/json",
   'access-token: Bearer ' . $json_resp->access_token,
   'Authorization: Bearer ' . $json_resp->access_token,
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $auth_headers );

$user_data = <<<DATA
{
  "first_name": "Test",
  "last_name": "health connect",
  "gender": "female",
  "date_of_birth": "1992-05-19",
  "country_id": "1",
  "city_id": "1",
  "national_id": "11111111111",
  "nationality_id": "1",
  "mobile": "07038240083",
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
}

addSingleUser(); // call the function
?>