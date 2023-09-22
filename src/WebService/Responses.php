<?php
// See WebService API documentation https://api.hostedsms.pl/WS/smssender.asmx
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

        if(is_array($response->MessageIds))
            $arrayObject = new ArrayObject($response->MessageIds);
        else
            $arrayObject = new ArrayObject([$response->MessageIds]);

        $this->messageIds = $arrayObject->getArrayCopy();
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

        if(is_array($response->DeliveryReports->DeliveryReport))
            $arrayObject = new ArrayObject($response->DeliveryReports->DeliveryReport);
        else
            $arrayObject = new ArrayObject([$response->DeliveryReports->DeliveryReport]);

        $arrayWithDeliveryReport = new ArrayObject();
        foreach($arrayObject as $obj)
        {
            $arrayWithDeliveryReport[] = new DeliveryReport($obj);
        }
                                                                                    
        $this->deliveryReports = $arrayWithDeliveryReport->getArrayCopy();
    }
}
class GetDeliveryReportsResponse extends Response
{
    /** @var DeliveryReport[] */
    public $deliveryReports;
    function __construct($response)
    {
        parent::__construct($response);

        if(is_array($response->DeliveryReports->DeliveryReport))
            $arrayObject = new ArrayObject($response->DeliveryReports->DeliveryReport);
        else
            $arrayObject = new ArrayObject([$response->DeliveryReports->DeliveryReport]);

        $arrayWithDeliveryReport = new ArrayObject();
        foreach($arrayObject as $obj)
        {
            $arrayWithDeliveryReport[] = new DeliveryReport($obj);
        }

        $this->deliveryReports = $arrayWithDeliveryReport->getArrayCopy();
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

        if(is_array($response->InputSms->InputSms))
            $arrayObject = new ArrayObject($response->InputSms->InputSms);
        else
            $arrayObject = new ArrayObject([$response->InputSms->InputSms]);

        $arrayWithInputSmses = new ArrayObject();
        foreach($arrayObject as $obj)
        {
            $arrayWithInputSmses[] = new InputSms($obj);
        }

        $this->inputSmses = $arrayWithInputSmses->getArrayCopy();
    }
}
class GetUnreadInputSmsesResponse extends Response
{
    /** @var InputSms[] */
    public $inputSmses;
    function __construct($response)
    {
        parent::__construct($response);
                                                        
        if(is_array($response->InputSms->InputSms))
            $arrayObject = new ArrayObject($response->InputSms->InputSms);
        else
            $arrayObject = new ArrayObject([$response->InputSms->InputSms]);

        $arrayWithInputSmses = new ArrayObject();
        foreach($arrayObject as $obj)
        {
            $arrayWithInputSmses[] = new InputSms($obj);
        }

        $this->inputSmses = $arrayWithInputSmses->getArrayCopy();
    }
}
class GetValidSendersResponse extends Response
{
    /** @var string[] */
    public $senders;

    function __construct($response)
    {
        parent::__construct($response);
                                                        
        $arrayObject = new ArrayObject($response->Senders);
        $this->senders = $arrayObject->getArrayCopy();

        if(is_array($response->Senders))
            $arrayObject = new ArrayObject($response->Senders);
        else
            $arrayObject = new ArrayObject([$response->Senders]);

        $this->senders = $arrayObject->getArrayCopy();
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
                                                        
        $arrayObject1 = new ArrayObject($response->ValidPhones);
        $this->validPhones = $arrayObject1->getArrayCopy();

        $arrayObject1 = new ArrayObject($response->InvalidPhones);
        $this->invalidPhones = $arrayObject1->getArrayCopy();

        $arrayObject1 = new ArrayObject($response->Duplicates);
        $this->duplicates = $arrayObject1->getArrayCopy();

        $arrayObject1 = new ArrayObject($response->BlockedPhones);
        $this->blockedPhones = $arrayObject1->getArrayCopy();
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