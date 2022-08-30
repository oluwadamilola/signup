<?php
$countryid = 1;
$cityid = 1;
$nationalid = 11111111111;
$companycode = "EkoTeleMed";

$data = [
    "first_name" => $firstname,
    "last_name" => $lastname,
    "gender" => $gender,
    "date_of_birth" =>$dateofbirth,
    "country_id" =>$countryid,
    "city_id" =>$cityid,
    "national_id" => $nationalid,
    "nationality_id" =>$nationalityid,
    "mobile" => $phonenumber,
    "company_code"=>  $companycode
];
$user_data = json_encode($data);
var_dump($user_data);

?>