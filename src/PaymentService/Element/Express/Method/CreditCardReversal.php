<?php
namespace SinglePay\PaymentService\Element\Express\Method;

class CreditCardReversal
{
    public $credentials;

    public $application;

    public $terminal;

    public $card;

    public $transaction;

    public $extendedParameters;

    public function __construct($credentials, $application, $terminal, $card, $transaction, $extendedParameters)
    {
        $this->credentials = $credentials;
        $this->application = $application;
        $this->terminal = $terminal;
        $this->card = $card;
        $this->transaction = $transaction;
        $this->extendedParameters = $extendedParameters;
    }
}