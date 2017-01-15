<?php

//you will probably want to do some other security measures as well :D
if (!(isset($_POST) && count($_POST))) exit();

$user_id = $_POST["user_id"];
$validation_code = $_POST["validation_code"];

$validated = false;

//TO-DO: look up in the table to see if the validation code and the user id match. if so, mark the phone number as validated.

$response = [];

if ($validated) {
	
	$response["success"] = true;
	$response["success_blurb"] = "You validated! Yay!";
}

else {
	
	$response["success"] = false;
	$response["failure_blurb"] = "That code doesn't match.";
}

exit(json_encode($response));
