<!DOCTYPE html>
<html>

<head>
	<title>Sending SMS using PHP</title>
</head>

<body>

	<form method="post">
		<label for="submit">Send SMS</label>
		<input type="submit" name="submit">
	</form>

</body>

</html>

<?php
require 'Api.php';
if (isset($_POST["submit"])) {

	$hostedSms = new HostedSmsApi();
	$userEmail = 'mikolaj.walachowski@dcs.pl';
	$password = 'HsmsTestPassword4';
	//$password = 'InvalidPassword';
	$sender = 'TestowySMS';
	$phone = '48501954841';
	$v = null;
	$convertMessageToGSM7 = false;

	date_default_timezone_set('Europe/Warsaw');

	$currentDateTime = date('Y-m-d H:i:s');
	$message = 'hejka naklejka ' . $currentDateTime;

	try {

		$response = $hostedSms->sendSimpleSms(
			$userEmail,
			$password,
			$sender,
			$phone,
			$message
		);
		echo 'Response: ' . $response;
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}
?>