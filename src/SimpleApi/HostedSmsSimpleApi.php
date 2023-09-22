<?php

namespace HostedSms\SimpleApi;

use Exception;

class HostedSmsSimpleApi
{

    private $simpleApiUrl = 'https://api.hostedsms.pl/SimpleApi';
    private $data;
    private $userEmail;
    private $password;

    /** 
     * Create client for API with credentials
     * 
     * @param string $userEmail user login in hostedsms.pl
     * @param string $password user password in hostedsms.pl
     */
    public function __construct($userEmail, $password)
    {
        $this->userEmail = $userEmail;
        $this->password = $password;
    }
    /** 
     * Send message using SimpleApi
     * 
     * @param string $sender
     * @param string $phone in '48xxxxxxxxx' format
     * @param string $message
     * @param string $v (optional) optional parameter for antispam mechanism 
     * @param string $convertMessageToGSM7 (optional)
     * 
     * @return string returns messageId if successful request
     * 
     * @throws Exception if failed request
     */
    public function sendSms(
        $sender,
        $phone,
        $message,
        $v = null,
        $convertMessageToGSM7 = null
    ) {

        $this->setData($this->userEmail, $this->password, $sender, $phone, $message, $v, $convertMessageToGSM7);

        return $this->sendRequest();
    }

    private function sendRequest()
    {
        $jsonData = json_encode($this->data);

        $ch = curl_init($this->simpleApiUrl);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

        $headers = [
            
            'Content-Type: application/json; charset=UTF-8',
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $jsonResponse = curl_exec($ch);

        if (curl_errno($ch))
            throw new Exception('Call error' . curl_error($ch), curl_errno($ch));

        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($responseCode != 200)
            throw new Exception('Request failed: ' . $responseCode . ' Error');

        $response = json_decode($jsonResponse);

        if (isset($response->ErrorMessage))
            throw new Exception('Request failed' . $response->ErrorMessage);

        curl_close($ch);

        return $response->MessageId;
    }

    private function setData(
        $userEmail,
        $password,
        $sender,
        $phone,
        $message,
        $v,
        $convertMessageToGSM7
    ) {
        $this->data = [
            'UserEmail' => $userEmail,
            'Password' => $password,
            'Sender' => $sender,
            'Phone' => $phone,
            'Message' => $message,
            'v' => $v,
            'convertMessageToGSM7' => $convertMessageToGSM7
        ];
    }
}
