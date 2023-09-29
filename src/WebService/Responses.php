<?php

/** https://api.hostedsms.pl/WS/smssender.asmx for documentation */

namespace HostedSms\WebService;

use ArrayObject;

class Response
{
    /** @var string */
    public $currentTime;

    function __construct($response)
    {
        $this->currentTime = $response->CurrentTime;
    }
    protected function createArray($tab)
    {
        if (is_array($tab))
            $arrayObject = new ArrayObject($tab);
        else
            $arrayObject = new ArrayObject([$tab]);

        return $arrayObject;
    }
}

class SendSmsResponse extends Response
{
    /** @var string */
    public $messageId;

    function __construct($response)
    {
        parent::__construct($response);
        $this->messageId = $response->MessageId;
    }
}
class SendSmsesResponse extends Response
{
    /** @var string[] */
    public $messageIds;

    function __construct($response)
    {
        parent::__construct($response);

        if (isset($response->MessageIds->guid))
            $this->messageIds = $this->createArray($response->MessageIds->guid);
        else
            $this->messageIds = [];
    }
}
class DeliveryReport
{
    /** @var string */
    public $reportId;
    /** @var string */
    public $phone;
    /** @var string */
    public $messageId;
    /** 
     * Message status
     * -3 - message declined by operator
     * -2 - message outdated
     * -1 - message undelivered
     *  0 - undefined state (shouldn't ever occur)
     *  1 - message delivered  
     * @var int 
     */
    public $status;
    /** @var string */
    public $deliveryTime;

    function __construct($report)
    {
        $this->reportId = $report->ReportId;
        $this->phone = $report->Phone;
        $this->messageId = $report->MessageId;
        $this->status = $report->Status;
        $this->deliveryTime = $report->DeliveryTime;
    }
}
class GetUnreadDeliveryReportsResponse extends Response
{
    /** @var DeliveryReport[] */
    public $deliveryReports;
    function __construct($response)
    {
        parent::__construct($response);

        if (isset($response->DeliveryReports->DeliveryReport)) {
            $arrayObject = $this->createArray($response->DeliveryReports->DeliveryReport);
            foreach ($arrayObject as $obj) {
                $this->deliveryReports[] = new DeliveryReport($obj);
            }
        } else
            $this->deliveryReports = [];
    }
}
class GetDeliveryReportsResponse extends Response
{
    /** @var DeliveryReport[] */
    public $deliveryReports;
    function __construct($response)
    {
        parent::__construct($response);

        if (isset($response->DeliveryReports->DeliveryReport)) {
            $arrayObject = $this->createArray($response->DeliveryReports->DeliveryReport);
            foreach ($arrayObject as $obj) {
                $this->deliveryReports[] = new DeliveryReport($obj);
            }
        } else
            $this->deliveryReports = [];
    }
}
class InputSms
{
    /** @var string */
    public $messageId;
    /** @var string */
    public $phone;
    /** @var string */
    public $recipient;
    /** @var string */
    public $message;
    /** @var string */
    public $receivedTime;

    function __construct($inputSms)
    {
        $this->messageId = $inputSms->MessageId;
        $this->phone = $inputSms->Phone;
        $this->recipient = $inputSms->Recipient;
        $this->message = $inputSms->Message;
        $this->receivedTime = $inputSms->ReceivedTime;
    }
}
class GetInputSmsesResponse extends Response
{
    /** @var InputSms[] */
    public $inputSmses;
    function __construct($response)
    {
        parent::__construct($response);

        if (isset($response->InputSms->InputSms)) {
            $arrayObject = $this->createArray($response->InputSms->InputSms);
            foreach ($arrayObject as $obj) {
                $this->inputSmses[] = new InputSms($obj);
            }
        } else
            $this->inputSmses = [];
    }
}
class GetUnreadInputSmsesResponse extends Response
{
    /** @var InputSms[] */
    public $inputSmses;
    function __construct($response)
    {
        parent::__construct($response);

        if (isset($response->InputSms->InputSms)) {
            $arrayObject = $this->createArray($response->InputSms->InputSms);
            foreach ($arrayObject as $obj) {
                $this->inputSmses[] = new InputSms($obj);
            }
        } else
            $this->inputSmses = [];
    }
}
class GetValidSendersResponse extends Response
{
    /** @var string[] */
    public $senders;

    function __construct($response)
    {
        parent::__construct($response);

        if (isset($response->Senders->string))
            $this->senders = $this->createArray($response->Senders->string);
        else
            $this->senders = [];
    }
}
class CheckPhonesResponse extends Response
{
    /** @var string[] */
    public $validPhones;
    /** @var string[] */
    public $invalidPhones;
    /** @var string[] */
    public $duplicates;
    /** @var string[] */
    public $blockedPhones;

    function __construct($response)
    {
        parent::__construct($response);

        if (isset($response->ValidPhones->string))
            $this->validPhones = $this->createArray($response->ValidPhones->string);
        else
            $this->validPhones = [];

        if (isset($response->InvalidPhones->string))
            $this->invalidPhones = $this->createArray($response->InvalidPhones->string);
        else
            $this->invalidPhones = [];

        if (isset($response->Duplicates->string))
            $this->duplicates = $this->createArray($response->Duplicates->string);
        else
            $this->duplicates = [];

        if (isset($response->BlockedPhones->string))
            $this->blockedPhones = $this->createArray($response->BlockedPhones->string);
        else
            $this->blockedPhones = [];
    }
}
class ConvertToGsm7Response extends Response
{
    /** @var string */
    public $gsm7Text;

    function __construct($response)
    {
        parent::__construct($response);
        $this->gsm7Text = $response->Gsm7Text;
    }
}
