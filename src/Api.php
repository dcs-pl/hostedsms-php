<?php
class HostedSmsApi {
    
    private $simpleApiUrl = 'https://api.hostedsms.pl/SimpleApi';
    private $data;
    
    public function sendSimpleSms($userEmail, $password, $sender, $phone, $message,
    $v, $convertMessageToGSM7)
    {
        
        $this->GetData($userEmail, $password, $sender, $phone, $message, $v, $convertMessageToGSM7);
    
        $jsonData = json_encode($this->data);
        
        $ch = curl_init($this->simpleApiUrl);
        
        curl_setopt($ch, CURLOPT_POST, 1);  // to do a regular HTTP POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);  // set body of the request
        
        $headers = [
            'Accept: application/xml',
            'Content-Type: application/json; charset=UTF-8',
        ];
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);  // to set HTTP headers
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // to return the transfer as a string of the return value of {@see curl_exec()}
        
        $response = curl_exec($ch);
        
        if (curl_errno($ch))
            echo 'Error cURL: ' . curl_error($ch);
        
        curl_close($ch);
        
        echo $response;
        return $response;
    }

    function GetData($userEmail, $password, $sender, $phone, $message,
    $v, $convertMessageToGSM7)
    {
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