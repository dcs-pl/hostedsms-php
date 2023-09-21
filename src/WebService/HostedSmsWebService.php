<?php
class HostedSmsWebService
{

    private $apiWSDL = 'https://api.hostedsms.pl/WS/smssender.asmx?WSDL';

    /** 
     * Send message using SimpleApi
     * 
     * @param string $userEmail User login in hostedsms.pl
     * @param string $password User password in hostedsms.pl
     * @param string $sender Sender name
     * @param string $phone Phone number where sms should be sent
     * @param string $message Message text
     * @param string $v (optional)
     * @param string $convertMessageToGSM7 (optional)
     * 
     * @return string messageId if successful request
     * 
     * @throws Exception if failed request
     */
    public function sendSms($userEmail, $password, $phone, $message, $sender, $transactionId, 
    $validityPeriod = null, $priority = 0, $flashSms = false, $costCenter = null, $convertMessageToGSM7 = null) 
    {
        $params = [
            'UserEmail' => $userEmail,
            'Password' => $password,
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

        $response = $this->sendApiRequest('SendSms', $params);

        if($response->SendSmsResult === true)
            echo 'tak';
        else 
        {
            echo 'nie';
            echo $response->ErrorMessage;

        }

        return $response->MessageId; 
    }
    

    private function sendApiRequest($apiCall, $params) 
    {
        $client = new SoapClient($this->apiWSDL, [
            'trace' => true,
            'exceptions' => true,
            'soap_version' => SOAP_1_2,
        ]);

        $response = $client->__soapCall($apiCall, [$params]);
        
        return $response;
    }
}
