<?php
namespace SinglePay\PaymentService\Element\Express;

/**
 * Application class
 * 
 * @package SinglePay
 * @author  Mahendra Rai
 */
class Application
{
    public $applicationId;

    public $applicationVersion;

    public $applicationName;

    public function __construct($applicationId, $applicationVersion, $applicationName)
    {
        $this->applicationId = $applicationId;
        $this->applicationVersion = $applicationVersion;
        $this->applicationName = $applicationName;
    }
}