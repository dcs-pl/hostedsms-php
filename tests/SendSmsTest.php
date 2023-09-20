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
    public function test_Send_Sms_Should_Be_Successfull(): void
    {
        $this->prepareData();
        $userEmail = 'mikolaj.walachowski@dcs.pl';
	    $password = 'HsmsTestPassword4';
	    $sender = 'TestowySMS';
	    $phone = '48693053151';
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
        $this->assertNotNull($response);
    }

    /** @test */
    public function test_Send_Sms_With_Invalid_User_Should_Throw_Exception()
    {
        $this->prepareData();
        $userEmail = 'invalid.user@dcs.pl';
	    $password = 'invalidpassword';
	    $sender = 'invalidsender';
	    $phone = '000000000';
	    $v = null;
	    $convertMessageToGSM7 = false;
        $message = "test message";

        $this->expectException(Exception::class);

        $response = $this->hostedSms->sendSimpleSms(
            $userEmail,
            $password,
            $sender,
            $phone,
            $message,
            $v,
            $convertMessageToGSM7
        );
    }
}
?>