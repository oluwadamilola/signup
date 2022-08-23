<?php

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


$user_url = "https://aohs1.trudoc24x7.info/api/v1/census/addSinglePatient";
$data = array(
  "first_name"=> "Test",
    "last_name"=>"Dami",
    "gender"=> "female",
    "date_of_birth"=>"1992-05-19",
    "country_id"=> "1",
    "city_id"=> "1",
    "national_id"=> "11111111111",
    "nationality_id"=>"1",
    "mobile"=>"07038240033",
    "company_code"=>"EkoTeleMed"

);
$headers = array(
        'http' => array(
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'Authorization' => 'Bearer '.$access_token,
        'content' => json_encode($data)
    )
);

$context  = stream_context_create($options);
$result = file_get_contents( $url, false, $context );
$response = json_decode( $result );





?>



