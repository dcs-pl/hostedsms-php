<?php
class HostedSmsApi {
    
    public $simpleApiUrl = 'https://api.hostedsms.pl/SimpleApi';
    
    public function sendSimpleSms($userEmail, $password, $sender, $phone, $message,
    $v, $convertMessageToGSM7) {

        $data = [
            'UserEmail' => $userEmail,
            'Password' => $password,
            'Sender' => $sender,
            'Phone' => $phone,
            'Message' => $message,
            'v' => $v,
            'convertMessageToGSM7' => $convertMessageToGSM7
        ];
        
        $jsonData = json_encode($data);
        
        $ch = curl_init($this->simpleApiUrl);
        
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        
        $headers = [
            'Accept: application/xml',
            'Content-Type: application/json; charset=UTF-8',
        ];
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            echo 'Błąd cURL: ' . curl_error($ch);
        }
        
        curl_close($ch);
        
        echo $response;

    }

}