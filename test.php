<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://siigonube.siigo.com:50050/connect/token",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS =>"grant_type=password&\nusername=EMPRESA2CAPACITACION\\empresa2@apionmicrosoft.com&\npassword=s112pempresa2#&\nscope=WebApi offline_access\n",
    CURLOPT_HTTPHEADER => array(
        "Authorization: Basic U2lpZ29XZWI6QUJBMDhCNkEtQjU2Qy00MEE1LTkwQ0YtN0MxRTU0ODkxQjYx",
        "Content-Type: application/x-www-form-urlencoded",
        "Accept: application/json"
    ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;