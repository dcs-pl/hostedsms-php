<?php
require 'vendor\autoload.php';
use HostedSms\SimpleApi\HostedSmsSimpleApi;
use PHPUnit\Framework\TestCase;
class SimpleApiSendSmsTest extends TestCase
{
    private $hostedSms;

    private function prepareData()
    {
        $this->hostedSms = new HostedSmsSimpleApi();
    }

    public function providerTestData()
    {
        return [
            //['mikolaj.walachowski@dcs.pl', 'HsmsTestPassword4', 'TestowySMS', '48501954841'],
            [ getenv('HSMS_TEST_USERNAME'), getenv('HSMS_TEST_PASSWORD'), getenv('HSMS_TEST_SENDER'), getenv('HSMS_TEST_PHONE')]
        ];
    }

    /** @test */
    /**
     * @dataProvider providerTestData
     */
    public function test_Send_Sms_Should_Be_Successfull($userEmail, $password, $sender, $phone): void
    {
        $this->prepareData();
        // $userEmail = 'mikolaj.walachowski@dcs.pl';
	    // $password = 'HsmsTestPassword4';
	    // $sender = 'TestowySMS';
	    // $phone = '48693053151';
        $message = "test sms";
	    $v = null;
	    $convertMessageToGSM7 = false;

        $response = $this->hostedSms->sendSms(
            $userEmail,
            $password,
            $sender,
            $phone,
            $message,
            $v,
            $convertMessageToGSM7
        );

        echo $response;
        $this->assertNotEmpty($response);
        $this->assertNotNull($response);
    }

    /** @test */
    public function test_Send_Sms_With_Invalid_User_Should_Throw_Exception(): void
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

        $response = $this->hostedSms->sendSms(
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