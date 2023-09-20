<?php
class HostedSmsApi {
    
    public $simpleApiUrl = 'https://api.hostedsms.pl/SimpleApi';
    
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
     * @return string messageId
    */
    public function sendSimpleSms($userEmail, $password, $sender, $phone, $message,
    $v = null, $convertMessageToGSM7 = null) {

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