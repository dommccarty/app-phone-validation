<?php

require_once('PATH_TO_TWILIO_SDK/Services/Twilio.php');

$TwilioAccountSid = YOUR_ACCOUNT_SID;
$TwilioAuthToken = YOUR_AUTH_TOKEN;

$TwilioClient = new Services_Twilio($TwilioAccountSid, $TwilioAuthToken);

function send_sms($from_number, $to_number, $sms_body)
{

    if (!is_string($sms_body)) {
        return null;
    }
    
    if (strlen($from_number) == 10) {
        $from_number = "+1" . $from_number;
    }
    if (strlen($to_number) == 10) {
        $to_number = "+1" . $to_number;
    }

    global $TwilioClient;

    $message = $TwilioClient->account->messages->sendMessage(
        $from_number, //'+14085551234', // From a Twilio number in your account
        $to_number, //'+12125551234', // Text any number
        $sms_body//"Hello monkey!"
    );

    return $message->sid;
}

function send_mms($from_number, $to_number, $text, $image_urls)
{
 //last is a numeric array

    if (strlen($from_number) == 10) {
        $from_number = "+1" . $from_number;
    }
    if (strlen($to_number) == 10) {
        $to_number = "+1" . $to_number;
    }

    global $TwilioClient;

    $message = $TwilioClient->account->messages->sendMessage(
        $from_number, //'+14085551234', // From a Twilio number in your account
        $to_number, //'+12125551234', // Text any number
        $text, //"Hello monkey!"
        $image_urls
    );

    return $message->sid;
}

function giveTwilioFail($sid)
{
 //non-null means yes.
    
    global $TwilioClient;
    
    $message = $TwilioClient->account->sms_messages->get($sid);

    return $message->ErrorCode;
}

function carrier_check_number($phone_number)
{
    
    global $TwilioAccountSid, $TwilioAuthToken;
    
    $client = new Lookups_Services_Twilio($TwilioAccountSid, $TwilioAuthToken);

    $number = $client->phone_numbers->get($phone_number, array("Type" => "carrier"));
    
    return $number->carrier->type;
}
