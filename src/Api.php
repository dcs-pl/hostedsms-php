<?php
class HostedSmsApi {
    
    private $simpleApiUrl = 'https://api.hostedsms.pl/SimpleApi';
    private $data;
    
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
    public function sendSimpleSms($userEmail, $password, $sender, $phone, $message,
    $v = null, $convertMessageToGSM7 = null) {

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
            throw new Exception('Call error' . curl_error($ch), curl_errno($ch));
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) != 200)
            throw new Exception('Request failed' . $response);

        curl_close($ch);

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