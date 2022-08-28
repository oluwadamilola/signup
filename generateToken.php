<?php
include 'dbconfig.php';
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
  


?>