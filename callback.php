<?php
header("content-type: application/json");

$stkcallbackresponse = file_get_contents('php://input');
$logFile = 'mpesastkresponse.json';
$log = fopen($logFile, 'a');
fwrite($log, $stkcallbackresponse . "\n");
fclose($log);

$data = json_decode($stkcallbackresponse);

$MerchantRequestID = $data->Body->stkCallback->MerchantRequestID;
$CheckoutRequestID = $data->Body->stkCallback->CheckoutRequestID;
$ResultCode = $data->Body->stkCallback->ResultCode;
$ResultDesc = $data->Body->stkCallback->ResultDesc;
$Amount = $data->Body->stkCallback->CallbackMetadata->Item[0]->Value;
$MpesaReceiptNumber = $data->Body->stkCallback->CallbackMetadata->Item[1]->Value;
$TransactionDate = $data->Body->stkCallback->CallbackMetadata->Item[2]->Value;
$PhoneNumber = $data->Body->stkCallback->CallbackMetadata->Item[3]->Value;
$Balance = $data->Body->stkCallback->CallbackMetadata->Item[4]->Value;

//CHECK IF THE TRANSACTION WAS SUCCESSFUL
if ($ResultCode == 0) {
    // TRANSACTION WAS SUCCESSFUL
} else {
    // TRANSACTION FAILED
}

//SAVE THE TRANSACTION DETAILS TO A DATABASE OR FILE