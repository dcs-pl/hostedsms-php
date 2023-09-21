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
require 'HostedSmsWebService.php';
if (isset($_POST["submit"])) {
	$userEmail = 'mikolaj.walachowski@dcs.pl';
	$password = 'HsmsTestPassword4';
	$hostedSms = new HostedSmsWebService($userEmail, $password);
	//$password = 'InvalidPassword';

	$sender = 'TestowySMS';
	$phone = '48693053151';
	$phones = ['48501954841', '48693053151'];
	$convertMessageToGSM7 = false;

	date_default_timezone_set('Europe/Warsaw');

	$currentDateTime = date('Y-m-d H:i:s');
	$message = 'hejka naklejka ' . $currentDateTime;
	$transactionId = $sender . $phone . $message . $currentDateTime; 
	try {

		// $response = $hostedSms->sendSmses(
		// 	$phones,
		// 	$message,
		// 	$sender,
    	// 	$transactionId
		// );
		$response = $hostedSms->getUnreadInputSmses();
		
		if($response->GetUnreadInputSmsesResult === true)
		{
			echo 'tak';
		}
		else
		{
			echo 'nie: ' . $response->ErrorMessage;
		}
		//echo 'Response: ' . gettype($response->InputSms->MessageId);
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}
?>