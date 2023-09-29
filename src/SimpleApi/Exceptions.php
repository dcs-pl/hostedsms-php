<?php

/** https://api.hostedsms.pl/WS/smssender.asmx for documentation */

namespace HostedSms\SimpleApi;

use Exception;

class SimpleApiException extends Exception
{
    function __construct($errorMessage)
    {
        $this->message = $errorMessage;
    }
}

?>