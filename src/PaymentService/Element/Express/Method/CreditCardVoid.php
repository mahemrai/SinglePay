<?php
namespace SinglePay\PaymentService\Element\Express\Method;

class CreditCardVoid
{
    public $credentials;

    public $application;

    public $terminal;

    public $transaction;

    public $extendedParameters;

    public function __construct($credentials, $application, $terminal, $transaction, $extendedParameters)
    {
        $this->credentials = $credentials;
        $this->application = $application;
        $this->terminal = $terminal;
        $this->transaction = $transaction;
        $this->extendedParameters = $extendedParameters;
    }
}