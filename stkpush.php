<?php
//INCLUDE THE ACCESS TOKEN FILE
include 'accessToken.php';
date_default_timezone_set('Africa/Nairobi');
$processrequesturl = "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";
$callbackurl = "https://chattoearnkenya.xo.je/darajaapp/callback.php";
$passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$BusinessShortCode = "174379";
$TimeStamp = date("YmdHis");
//ENCRYPT DATA TO GET THE PASSWORD
$Password = base64_encode($BusinessShortCode . $passkey . $TimeStamp);
$phone = "254715945718";
$money = "1";
$PartyA = $phone;
$PartyB = $BusinessShortCode;
$AccountReference = "Chat To Earn Kenya";
$TransactionDesc = "Payment For Chat To Earn Kenya";
$Amount = $money;
$stkpushheader = ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token];

//INITIATE THE CURL
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $processrequesturl);
curl_setopt($curl, CURLOPT_HTTPHEADER, $stkpushheader); //setting custom header
$curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $TimeStamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $PartyB,
    'PhoneNumber' => $phone,
    'CallBackURL' => $callbackurl,
    'AccountReference' => $AccountReference,
    'TransactionDesc' => $TransactionDesc
);

$data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
$curl_response = curl_exec($curl);
//ECHO THE RESPONSE
echo $curl_response;