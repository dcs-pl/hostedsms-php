<!DOCTYPE html>
<html>

<head>
	<title>Sending SMS using PHP</title>
</head>

<body>

	<form method="post">
		<input type="submit" name="submit">
	</form>

</body>

</html>

<?php
require 'Api.php';
if (isset($_POST["submit"])) {

	$hostedSms = new HostedSmsApi();
	$userEmail = 'mikolaj.walachowski@dcs.pl';
	$password = 'HsmsTestPassword1';
	$sender = 'TestowySMS';
	$phone = '48501954841';

	date_default_timezone_set('Europe/Warsaw');

	$currentDateTime = date('Y-m-d H:i:s');
	$message = 'test ' . $currentDateTime;
	$hostedSms->sendSimpleSms(
		$userEmail,
		$password,
		$sender,
		$phone,
		$message
	);
}
?>