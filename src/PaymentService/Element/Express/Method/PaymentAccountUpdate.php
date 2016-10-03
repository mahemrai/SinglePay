<?php
namespace SinglePay\PaymentService\Element\Express\Method;

class PaymentAccountUpdate
{
    public $credentials;

    public $application;

    public $paymentAccount;

    public $card;

    public $demandDepositAccount;

    public $address;

    public $extendedParameters;

    public function __construct($credentials, $application, $paymentAccount, $card, $demandDepositAccount, $address, $extendedParameters)
    {
        $this->credentials = $credentials;
        $this->application = $application;
        $this->paymentAccount = $paymentAccount;
        $this->card = $card;
        $this->demandDepositAccount = $demandDepositAccount;
        $this->address = $address;
        $this->extendedParameters = $extendedParameters;
    }
}