<?php
require 'SoapRequestClient.php';
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
    

}
