<?php
require "..\simpleapi-php\src\WebService\HostedSmsWebService.php";
use PHPUnit\Framework\TestCase;
class InvalidCredentialsTest extends TestCase
{
    private $hostedSms;
    private function prepareData()
    {
        $this->hostedSms = new HostedSmsWebService('invalid.user', 'invalid.password');
    }

    /** @test */
    public function test_SendSms_Should_Be_Invalid_Credentials()
    {
        $this->prepareData();
        $phone = '48000000000';
	    $message = 'test';
        $sender = 'Test';
        $currentDateTime = date('Y-m-d H:i:s');
	    $transactionId = $sender . $phone . $message . $currentDateTime; 

        $this->expectException(Exception::class);

        $response = $this->hostedSms->sendSms($phone, $message, $sender, $transactionId);
    }

    public function test_SendSmses_Should_Be_Invalid_Credentials()
    {
        $this->prepareData();
        $phones = ['48000000000', '48111111111'];
	    $message = 'test';
        $sender = 'Test';
        $currentDateTime = date('Y-m-d H:i:s');
	    $transactionId = $sender . $message . $currentDateTime; 

        $this->expectException(Exception::class);

        $response = $this->hostedSms->sendSmses($phones, $message, $sender, $transactionId);
    }

    public function test_CheckPhones_Should_Be_Invalid_Credentials()
    {
        $this->prepareData();
        $phones = ['48000000000', '48111111111'];

        $this->expectException(Exception::class);

        $response = $this->hostedSms->checkPhones($phones);
    }

    public function test_ConvertToGsm7_Should_Be_Invalid_Credentials()
    {
        $this->prepareData();
        $text = 'text';

        $this->expectException(Exception::class);

        $response = $this->hostedSms->convertToGsm7($text);
    }

    public function test_GetDeliveryReports_Should_Be_Invalid_Credentials()
    {
        $this->prepareData();
        $messageIds = ['123-3123123-123sdfs-13', '1231-asdas-123123-asda'];

        $this->expectException(Exception::class);

        $response = $this->hostedSms->getDeliveryReports($messageIds);
    }

    public function test_GetInputSmses_Should_Be_Invalid_Credentials()
    {
        $this->prepareData();
        $currentDateTime = date('Y-m-d H:i:s');
        $from = $currentDateTime;
        $to = $currentDateTime;
        $recipient = 'test';
        $markAsRead = false;

        $this->expectException(Exception::class);

        $response = $this->hostedSms->getInputSmses($from, $to, $recipient, $markAsRead);
    }

    public function test_GetUnreadDeliveryReports_Should_Be_Invalid_Credentials()
    {
        $this->prepareData();

        $this->expectException(Exception::class);

        $response = $this->hostedSms->getUnreadDeliveryReports();
    }

    public function test_GetUnreadInputSmses_Should_Be_Invalid_Credentials()
    {
        $this->prepareData();

        $this->expectException(Exception::class);

        $response = $this->hostedSms->getUnreadInputSmses();
    }

    public function test_GetValidSenders_Should_Be_Invalid_Credentials()
    {
        $this->prepareData();

        $this->expectException(Exception::class);

        $response = $this->hostedSms->getValidSenders();
    }
}
?>