<?php
//YOUR MPESA API KEYS
$consumerKey = "8lexxcAptJGs46AWth1Q2cAb0JSLAqteaQvDRJ1NzBVBh5j1";
$consumerSecret = "3nbm6cVrt5K9FRXN4IOLfKmz2fEsAkhjfdCdQfd6ApwKwWaaG5j6Z4WNipJoZ33A";
//ACCESS TOKEN URL
$accessTokenUrl = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
$headers = ['Content-Type:application/json; charset=utf8'];
$curl = curl_init($accessTokenUrl);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_HEADER, FALSE);
curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
$result = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

$result = json_decode($result);
$access_token = $result->access_token;
curl_close($curl);