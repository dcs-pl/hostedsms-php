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
	$convertMessageToGSM7 = false;

	date_default_timezone_set('Europe/Warsaw');

	$currentDateTime = date('Y-m-d H:i:s');
	$message = 'test - ' . $currentDateTime;
	$transactionId = $sender . $phone . $message . $currentDateTime; 
	try {

		// // sendSms
		// $response = $hostedSms->sendSms(
		// 	$phone,
		// 	$message,
		// 	$sender,
    	// 	$transactionId
		// );
		// echo 'Response: ' . $response->currentTime . $response->messageId;

		// getDeliveryReports
		$response = $hostedSms->getDeliveryReports(['1142ecb5-0e55-418e-a2df-e6ad836c4a19', '150dea2d-0d2e-4d40-ba68-ff39b5164db8']);
		
		echo $response->currentTime;
		foreach($response->deliveryReports as $report)
		{
			echo '------ ' . $report->reportId;
		}
		echo 'Response: ' . $response->currentTime;



	} catch (Exception $e) {
		echo $e->getMessage();
	}
}
?>