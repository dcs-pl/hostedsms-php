<?php
require 'vendor\autoload.php';
use HostedSms\SimpleApi\HostedSmsSimpleApi;
use PHPUnit\Framework\TestCase;
class SendSmsTest extends TestCase
{
    private $hostedSms;

    private function prepareData($userEmail, $password)
    {
        $this->hostedSms = new HostedSmsSimpleApi($userEmail, $password);
    }

    /** @test */
    // public function test_Send_Sms_Should_Be_Successfull(): void
    // {
    //     $userEmail = 'mikolaj.walachowski@dcs.pl';
	//     $password = 'HsmsTestPassword4';
    //     $this->prepareData($userEmail, $password);
	//     $sender = 'TestowySMS';
	//     $phone = '48693053151';
	//     $v = null;
	//     $convertMessageToGSM7 = false;
    //     $message = "test sms";

    //     $response = $this->hostedSms->sendSms(
    //         $sender,
    //         $phone,
    //         $message,
    //         $v,
    //         $convertMessageToGSM7
    //     );

    //     $this->assertNotEmpty($response);
    //     $this->assertNotNull($response);
    // }

    /** @test */
    public function test_Send_Sms_With_Invalid_User_Should_Throw_Exception(): void
    {
        $userEmail = 'invalid.user@dcs.pl';
	    $password = 'invalidpassword';
        $this->prepareData($userEmail, $password);
	    $sender = 'invalidsender';
	    $phone = '000000000';
	    $v = null;
	    $convertMessageToGSM7 = false;
        $message = "test message";

        $this->expectException(Exception::class);

        $response = $this->hostedSms->sendSms(
            $sender,
            $phone,
            $message,
            $v,
            $convertMessageToGSM7
        );
    }
}
?>