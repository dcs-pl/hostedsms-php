<?php
// See WebService API documentation https://api.hostedsms.pl/WS/smssender.asmx
function createArray($tab)
{
    if(is_array($tab))
        $arrayObject = new ArrayObject($tab);
    else
        $arrayObject = new ArrayObject([$tab]);

    return $arrayObject;
}
class Response
{
    /** @var string */
    public $currentTime;

    function __construct($response)
    {
        $this->currentTime = $response->CurrentTime;
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

        $arrayObject = createArray($response->MessageIds);

        foreach($arrayObject as $obj)
        {
            $this->messageIds[] = $obj->guid;
        }
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
    /** @var integer */
    public $status;
    /** @var string */
    public $deliveryTime;

    function __construct($report)
    {
        $this->reportId = $report->ReportId;
        $this->phone = $report->Phone;
        $this->messageId = $report->MessageId;
        $this->status = $report->status;
        $this->deliveryTime = $report->DeliveryReport;
    }
}
class GetUnreadDeliveryReportsResponse extends Response
{
    /** @var DeliveryReport[] */
    public $deliveryReports;
    function __construct($response)
    {
        parent::__construct($response);

        $arrayObject = createArray($response->DeliveryReports->DeliveryReport);

        foreach($arrayObject as $obj)
        {
            $this->deliveryReports[] = new DeliveryReport($obj);
        }
    }
}
class GetDeliveryReportsResponse extends Response
{
    /** @var DeliveryReport[] */
    public $deliveryReports;
    function __construct($response)
    {
        parent::__construct($response);

        $arrayObject = createArray($response->DeliveryReports->DeliveryReport);

        foreach($arrayObject as $obj)
        {
            $this->deliveryReports[] = new DeliveryReport($obj);
        }
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

        $arrayObject = createArray($response->InputSms->InputSms);
        
        foreach($arrayObject as $obj)
        {
            $this->inputSmses[] = new InputSms($obj);
        }
    }
}
class GetUnreadInputSmsesResponse extends Response
{
    /** @var InputSms[] */
    public $inputSmses;
    function __construct($response)
    {
        parent::__construct($response);
                                                    
        $arrayObject = createArray($response->InputSms->InputSms);

        foreach($arrayObject as $obj)
        {
            $this->inputSmses[] = new InputSms($obj);
        }
    }
}
class GetValidSendersResponse extends Response
{
    /** @var string[] */
    public $senders;

    function __construct($response)
    {
        parent::__construct($response);
                                                        
        $arrayObject = createArray($response->Senders);

        foreach($arrayObject as $obj)
        {
            $this->senders[] = $obj->string;
        }
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
                                          
        $arrayObject1 = createArray($response->ValidPhones);
        foreach($arrayObject1 as $obj)
        {
            $this->validPhones[] = $obj->string;
        }

        $arrayObject2 = createArray($response->InvalidPhones);
        foreach($arrayObject2 as $obj)
        {
            $this->invalidPhones[] = $obj->string;
        }

        $arrayObject3 = createArray($response->Duplicates);
        foreach($arrayObject3 as $obj)
        {
            $this->duplicates[] = $obj->string;
        }

        $arrayObject4 = createArray($response->BlockedPhones);
        foreach($arrayObject4 as $obj)
        {
            $this->blockedPhones[] = $obj->string;
        }
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
?>