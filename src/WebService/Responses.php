<?php
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
    public $currentTime;

    function __construct($response)
    {
        $this->currentTime = $response->CurrentTime;
    }
}

class SendSmsResponse extends Response
{
    public $messageId;

    function __construct($response)
    {
        parent::__construct($response);
        $this->messageId = $response->MessageId;
    }
}
class SendSmsesResponse extends Response
{
    public $messageIds;

    function __construct($response)
    {
        parent::__construct($response);

        $arrayObject = createArray($response->MessageIds->guid);

        foreach($arrayObject as $obj)
        {
            $this->messageIds[] = $obj;
        }
    }
}
class DeliveryReport
{
    public $reportId;
    public $phone;
    public $messageId;
    public $status;
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
    public $messageId;
    public $phone;
    public $recipient;
    public $message;
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
    public $senders;

    function __construct($response)
    {
        parent::__construct($response);
                                                        
        $arrayObject = createArray($response->Senders->string);

        foreach($arrayObject as $obj)
        {
            $this->senders[] = $obj;
        }
    }
}
class CheckPhonesResponse extends Response
{
    public $validPhones;
    public $invalidPhones;
    public $duplicates;
    public $blockedPhones;

    function __construct($response)
    {
        parent::__construct($response);
                                          
        $arrayObject1 = createArray($response->ValidPhones->string);
        foreach($arrayObject1 as $obj)
        {
            $this->validPhones[] = $obj;
        }

        $arrayObject2 = createArray($response->InvalidPhones->string);
        foreach($arrayObject2 as $obj)
        {
            $this->invalidPhones[] = $obj;
        }

        $arrayObject3 = createArray($response->Duplicates->string);
        foreach($arrayObject3 as $obj)
        {
            $this->duplicates[] = $obj;
        }

        $arrayObject4 = createArray($response->BlockedPhones->string);
        foreach($arrayObject4 as $obj)
        {
            $this->blockedPhones[] = $obj;
        }
    }
}
class ConvertToGsm7Response extends Response
{
    public $gsm7Text;

    function __construct($response)
    {
        parent::__construct($response);
        $this->gsm7Text = $response->Gsm7Text;
    }
}
?>