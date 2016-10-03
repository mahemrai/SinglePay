<?php
namespace SinglePay\PaymentService\Element\Express\Method;

class PaymentAccountDelete
{
    public $credentials;

    public $application;

    public $paymentAccount;

    public $extendedParameters;

    public function __construct($credentials, $application, $paymentAccount, $extendedParameters)
    {
        $this->credentials = $credentials;
        $this->application = $application;
        $this->paymentAccount = $paymentAccount;
        $this->extendedParameters = $extendedParameters;
    }
}