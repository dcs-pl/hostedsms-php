<?php
require 'SoapRequestClient.php';
/** https://api.hostedsms.pl/WS/smssender.asmx for documentation */
require 'Responses.php';
class HostedSmsWebService
{
    private $client;
    /** 
    * Create client for API with credentials
    * 
    * @param string $userEmail User login in hostedsms.pl
    * @param string $password User password in hostedsms.pl
    */ 
    public function __construct($userEmail, $password)
    {
        $this->client = new SoapRequestClient($userEmail, $password); 
    }

    public function checkPhones($phones)
    {
        $params = [
            'Phones' => $phones
        ];
        $response = $this->client->sendRequest('CheckPhones', $params);

        return new CheckPhonesResponse($response);
    }

    public function convertToGsm7($text)
    {
        $params = [
            'Text' => $text
        ];
        $response = $this->client->sendRequest('ConvertToGsm7', $params);

        return new ConvertToGsm7Response($response);
    }

    public function getDeliveryReports($messageIds, $markAsRead = false)
    {
        $params = [
            'MessageIds' => $messageIds,
            'MarkAsRead' => $markAsRead
        ];
        
        $response = $this->client->sendRequest('GetDeliveryReports', $params);

        if(!$response->GetDeliveryReportsResult)
        {
            throw new Exception($response->ErrorMessage);
        }
        
        return new GetDeliveryReportsResponse($response);
    }

    /**
     * 
     * @param string $from in 'YYYY-MM-DDTHH:MM:SS' format
     * @param string $to in 'YYYY-MM-DDTHH:MM:SS' format
     */
    public function getInputSmses($from, $to, $recipient, $markAsRead)
    {
        $params = [
            'From' => $from,
            'To' => $to,
            'Ricipient' => $recipient,
            'MarkAsRead' => $markAsRead
        ];
        $response = $this->client->sendRequest('GetInputSmses', $params);

        return new GetInputSmsesResponse($response);
    }

    public function getUnreadDeliveryReports()
    {
        $params = [];
        $response = $this->client->sendRequest('GetUnreadDeliveryReports', $params);

        return new GetUnreadDeliveryReportsResponse($response);
    }

    public function getUnreadInputSmses()
    {
        $params = [];
        $response = $this->client->sendRequest('GetUnreadInputSmses', $params);

        return new GetUnreadInputSmsesResponse($response);
    }

    public function getValidSenders()
    {
        $params = [];
        $response = $this->client->sendRequest('GetValidSenders', $params);

        return new GetValidSendersResponse($response);
    }

    /** 
     * Send message using SimpleApi
     * 
     * @param string $sender Sender name
     * @param string $phone Phone number where sms should be sent
     * @param string $message Message text
     * @param string $v (optional)
     * @param string $convertMessageToGSM7 (optional)
     * 
     * @return @var messageId if successful request
     * 
     * @throws Exception if failed request
     */
    public function sendSms($phone, $message, $sender, $transactionId, 
    $validityPeriod = null, $priority = 0, $flashSms = false, $costCenter = null, $convertMessageToGSM7 = null) 
    {
        $params = [
            'Phone' => $phone,
            'Message' => $message,
            'Sender' => $sender,
            'TransactionId' => $transactionId,
            'ValidityPeriod' => $validityPeriod,
            'Priority' => $priority,
            'FlashSms' => $flashSms,
            'CostCenter' => $costCenter,
            'ConvertMessageToGSM7' => $convertMessageToGSM7
        ];

        $response = $this->client->sendRequest('SendSms', $params);

        if(!$response->SendSmsResult)
        {
            throw new Exception($response->ErrorMessage);
        }

        return new SendSmsResponse($response);
    }

    public function sendSmses($phones, $message, $sender, $transactionId, 
    $validityPeriod = null, $priority = 0, $flashSms = false, $costCenter = null, $convertMessageToGSM7 = null)
    {
        $params = [
            'Phones' => $phones,
            'Message' => $message,
            'Sender' => $sender,
            'TransactionId' => $transactionId,
            'ValidityPeriod' => $validityPeriod,
            'Priority' => $priority,
            'FlashSms' => $flashSms,
            'CostCenter' => $costCenter,
            'ConvertMessageToGSM7' => $convertMessageToGSM7
        ];

        $response = $this->client->sendRequest('SendSmses', $params);

        return new SendSmsesResponse($response);
    }

}
