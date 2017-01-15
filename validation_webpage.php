<?php

//$validation code is defined before this file is included. on iOS, this page is never executed.
//Instead, you must setup the associated-domains entitlement and register your DOMAIN/v directory as consisting of universal links.
//Then when a user clicks on a link into that directory, the whole URL is passed to your app, and you can parse it to get the validation code.

if (!isset($validation_code)) exit();

require("os_and_version.php");

$ip = $_SERVER["REMOTE_ADDR"];	
$user_agent = $_SERVER["HTTP_USER_AGENT"];

$ua_data = os_and_version($user_agent);

//you may want to drop a cookie first ...

if ($ua_data["os"] == "android") {

	//your app needs to be setup to handle this kind of intent.
	header("Location: intent://stuff?validation_code={$validation_code}#Intent;package=YOUR_PACKAGE_NAME;scheme=YOUR_SCHEME;launchFlags=268435456;end;");
}	
		
else header("Location: example.com");
