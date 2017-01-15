<?php

//you will probably want to do some other security measures as well :D
if (!(isset($_POST) && count($_POST))) exit();

require("cleanup_phone_number.php");

$phone_number = cleanup_phone_number($_POST["phone_number"]);
$user_id = $_POST["user_id"];

$user_already_validated = false;
$number_already_taken = false;

//TO-DO: check if another user already has this number, or if this user has alredy validated it.
//be sure to sanitize the data.

if ($user_already_validated) {
	
	exit(json_encode(["already_validated" => true]));
}

elseif ($number_already_taken) {
	
	exit(json_encode(["already_taken" => true]));
}

require("twilio_utils.php");

try {
	
	$type = carrier_check_number($phone_number);
	
	if ($type != "mobile") {
		
		exit(json_encode(["twilio_failure_blurb" => "We can only validate cellphone numbers."]));
	}
}

catch (Exception $e) {
	
	exit(json_encode(["twilio_failure_blurb" => "There was a problem sending a text to that phone number. Please check the number and dial again."]));
}

require("generating_5_digits.php");

$code = code_algorithm();

//TO-DO: store the code, the phone number, and the user id in the table


$dir = "./v/" . $code;

mkdir($dir);

$webpage = '<?php;$validation_code = ' . '"' .  $validation_code . '"' . ';require("validation_webpage.php");?>';

$filename = $dir . "/index.php";

file_put_contents($filename, $webpage);


$sms_from_number = YOUR_TWILIO_NUMBER;

$sms_body = "You're almost there! Just click the link to validate:\n\n"
				. "example.com/v/CODE";

$sms_body = str_replace("CODE", $code, $sms_body);

$message_id = null;
$twilio_failure_blurb = null;
$twilio_success_blurb = null;

try {
	
	$message_id = send_sms($sms_from_number, $phone_number, $sms_body);
	
	if ($message_id) $twilio_success_blurb = "We just sent you a text message. When you get it, click the link to validate!";
	else $twilio_failure_blurb = "There was a problem sending a text to that phone number. Please check the number and dial again.";
}

catch (Exception $e) {
	
	$twilio_failure_blurb = "There was a problem sending a text to that phone number. Please check the number and dial again.";
}

if ($twilio_failure_blurb) {
	
	unlink($filename);
	rmdir($dir);
}

exit(json_encode(["twilio_success_blurb" => $twilio_success_blurb, "twilio_failure_blurb" => $twilio_failure_blurb]));
