<?php
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
        $this->messageIds = $response->MessageIds;
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

        $arrayObject = new ArrayObject($response->DeliveryReports);
        $this->deliveryReports = $arrayObject->getArrayCopy();
    }
}
class GetDeliveryReportsResponse extends Response
{
    public $deliveryReports;
    function __construct($response)
    {
        parent::__construct($response);

        $arrayObject = new ArrayObject($response->DeliveryReports);
        $this->deliveryReports = $arrayObject->getArrayCopy();
    }
}
class GetInputSmsesResponse extends Response
{
    public $inputSms;
    function __construct($response)
    {
        parent::__construct($response);

        $arrayObject = new ArrayObject($response->InputSms);
        $this->inputSms = $arrayObject->getArrayCopy();
    }
}
class GetUnreadInputSmsesResponse extends Response
{
    public $inputSms;
    function __construct($response)
    {
        parent::__construct($response);
                                                        
        $arrayObject = new ArrayObject($response->InputSms);
        $this->inputSms = $arrayObject->getArrayCopy();
    }
}
class GetValidSendersResponse extends Response
{
    public $senders;

    function __construct($response)
    {
        parent::__construct($response);
                                                        
        $arrayObject = new ArrayObject($response->Senders);
        $this->senders = $arrayObject->getArrayCopy();
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
    public $gsm7Text;

    function __construct($response)
    {
        parent::__construct($response);
        $this->gsm7Text = $response->Gsm7Text;
    }
}
?>