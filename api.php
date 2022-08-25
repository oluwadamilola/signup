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


$service_url = "https://aohs1.trudoc24x7.info/api/v1/census/addSinglePatient";

$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_URL, $service_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$auth_headers = array(
   "Accept: application/json",
   "Content-Type: application/json",
   'access-token: Bearer ' . $json_resp->access_token,
   'Authorization: Bearer ' . $jsonData->access_token,
  //"access-token: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhlOGU3Y2U3NzBjYzkyYWJiYTc5NmQ0Yzk5ZDg2YjlkZjA2OGI3MWMxMmU1OWIzMWRhMjdkODQ4NWI0M2IwOTAzOTZlMGNiZTE5YTkwNDgwIn0.eyJhdWQiOiI2NSIsImp0aSI6IjhlOGU3Y2U3NzBjYzkyYWJiYTc5NmQ0Yzk5ZDg2YjlkZjA2OGI3MWMxMmU1OWIzMWRhMjdkODQ4NWI0M2IwOTAzOTZlMGNiZTE5YTkwNDgwIiwiaWF0IjoxNjYwNTY5MDk2LCJuYmYiOjE2NjA1NjkwOTYsImV4cCI6MTY2MTg2NTA5Niwic3ViIjoiIiwic2NvcGVzIjpbXX0.o4PMlzQ_oWFUmwSO5SI683jzqAXYLnZQY8oDLt6SD9XSXnL8eR4K2Q51Vsas5kWWo91IsbAhvQU6_vy0FTZrhcHojBrwXI6ib4MftlygJg1ad-gMWzfxn52jB6sQtsGss6efdZLLnFkzEaR3SfGSwx-r-67PTf6M5pdS-IaGG0-cFRnRbZZgpoBlz3W_LJW7sStUbvjed0aUWw-hHePs3GGHHRNdyNpCTfogZMRKJ0x8TbBaCQILL_t580B63-NuDWMAFPDqXPMyT2Q44FvH5PUszvOj8kYjxGgZUjp5PlrC9f6IFfRWyoosuo0PtOzsmbN0MQqw0vrV_XTy9qai3I9WeeyZZu_wLKxs9eQLargIIGnoq0T6LpN7zvh1q8md6PKXYGYmT08ZRrEvqGB-VMZY9SjDpTdF_IbdHrgbxzE2E7mtgTTmatdfGp0iMukr0DLQUqIN3n1zNU3uaP3d4ixQIzrVjusWIcg9rjo8QOKQF2UuvNgfzwDzNLsqWuTOyA4S9JMotctBTEZt9gbe1oYGjGeQYvO44sitbtutl8OIFsNFQu0vJkiokdLIVxzS-9sWCSMTw3ngvP11JyLx_YU5TJeS4A5Qn6O1w5Sx4zilTgpzppi-tIj1EIS5gj3Su5M9dBbe53YWllH3i_8ZvdB15ZZosHhoD-Aroc3OjJw",
  //"Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQ2NjViNWJlYjdkYWJiYzEzNWI1N2M3ODk0ODRiY2E3NzljZDMzOGNkNDc4N2E2MjdhZDk0ODI0NjhhZDAwMWMzYTk3Yjg1NjE0OGI3MGE5In0.eyJhdWQiOiI2NCIsImp0aSI6ImQ2NjViNWJlYjdkYWJiYzEzNWI1N2M3ODk0ODRiY2E3NzljZDMzOGNkNDc4N2E2MjdhZDk0ODI0NjhhZDAwMWMzYTk3Yjg1NjE0OGI3MGE5IiwiaWF0IjoxNjYwNTU2MTUxLCJuYmYiOjE2NjA1NTYxNTEsImV4cCI6MTY2MTg1MjE1MSwic3ViIjoiIiwic2NvcGVzIjpbXX0.edbNmlyWcmMDu5muINhEa5PZSIvTXZEdMHMuiBt03-yzXwQdrYa3nnwp-bN7yHIskrd6Y9wcAam3vPO8KiQgtHyv7RHCZzxD5l5xZvn368-5__QqIGr5sz0ZqF6DapO_unZehRC0NlEC-5uPmq3id96jjF17zKwlCy_gCk0bEdWL9_-HOQnka1siOtjCIhsXO5knnOqxnA1_ykKC_08zpHjkB7c6AV7ZvZJtlfa25-FDSkLPBMLb7wolbD0TVrn2uzEK98oHMhC_dE8I7n7FU52b0eIwjFgUKVHwyT9U74VkB7ueZaN9u-U-1yLMYvwNqvC4kzkZLlUYi9QvwkFdhjau1qVwUr578J-FZMe-gUi4E7LzW9DyPDxGy2uMvq0ldmArfY2gMMgQ21Hf1rPFLwff8Jc_nxzOucVT1QifqitW6bZdV-0qFU_o7tG2pCgH689E0kB1GKZxM02bDHywDhJhtymU1y7C71azBPgpLS_xa4fQjEMBg8_LsM7Tmgdb1MWPSBy4kYB-MBp4QXRlpN-UFBm58BuZ7OYpKvCHC4_cmmo1vQjvcV9Bnoca7vgdfHvNIOuhVjUKPli20PI3ijQ6xVrAuJOqeWoNJc3Gu4sVyhKUSuupeDQAG_h5tO2sFU9gVGA0BC6rINZLWtipwe1OmUK0rXmbm2ySP2-UC9A",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $auth_headers );

$user_data = <<<DATA
{
  "first_name": "Test",
  "last_name": "Dami",
  "gender": "female",
  "date_of_birth": "1992-05-19",
  "country_id": "1",
  "city_id": "1",
  "national_id": "11111111111",
  "nationality_id": "1",
  "mobile": "07038240063",
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

// $json_resp = json_decode($resp);
// $access_token = $json_resp->access_token;




?>



