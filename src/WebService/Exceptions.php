<?php

/** https://api.hostedsms.pl/WS/smssender.asmx for documentation */

namespace HostedSms\WebService;

use Exception;

class WebServiceApiException extends Exception
{
    function __construct($errorMessage)
    {
        $this->message = $errorMessage;
    }
}

?>