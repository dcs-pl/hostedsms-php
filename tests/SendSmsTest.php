<?php
require "..\simpleapi-php\src\Api.php";
use PHPUnit\Framework\TestCase;
class SendSmsTest extends TestCase
{
    private $hostedSms;

    private function prepareData()
    {
        $this->hostedSms = new HostedSmsApi();
    }

    /** @test */
    public function Test_Send_Sms_Should_Be_Successfull(): void
    {
        $this->prepareData();
        $userEmail = 'mikolaj.walachowski@dcs.pl';
	    $password = 'HsmsTestPassword1';
	    $sender = 'TestowySMS';
	    $phone = '48501954841';
	    $v = null;
	    $convertMessageToGSM7 = false;
        $message = "test message";

        $response = $this->hostedSms->sendSimpleSms(
            $userEmail,
            $password,
            $sender,
            $phone,
            $message,
            $v,
            $convertMessageToGSM7
        );

        $this->assertNotEmpty($response);
    }

    /** @test */
    public function Test_Send_Sms_With_Invalid_User_Should_Return_Error_Message()
    {
        $this->prepareData();
        $userEmail = 'invalid.user@dcs.pl';
	    $password = 'invalidpassword';
	    $sender = 'TestowySMS';
	    $phone = '48501954841';
	    $v = null;
	    $convertMessageToGSM7 = false;
        $message = "test message";

        $response = $this->hostedSms->sendSimpleSms(
            $userEmail,
            $password,
            $sender,
            $phone,
            $message,
            $v,
            $convertMessageToGSM7
        );

        $this->assertStringContainsString('Invalid Credentials or IP', $response);
    }
}
?>