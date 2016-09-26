<?php
namespace SinglePay\PaymentService\Element\Express\Method;

use SinglePay\PaymentService\Element\Express\Type\Address;
use SinglePay\PaymentService\Element\Express\Type\Application;
use SinglePay\PaymentService\Element\Express\Type\Card;
use SinglePay\PaymentService\Element\Express\Type\Credentials;
use SinglePay\PaymentService\Element\Express\Type\ExtendedParameters;
use SinglePay\PaymentService\Element\Express\Type\Terminal;
use SinglePay\PaymentService\Element\Express\Type\Transaction;

class CreditCardAVSOnly
{
    public $credentials;

    public $application;

    public $terminal;

    public $card;

    public $transaction;

    public $address;

    public $extendedParameters;

    public function __construct(
        $credentials,
        $application,
        $terminal,
        $card,
        $transaction,
        $address,
        $extendedParameters
    ){
        $this->credentials = $credentials;
        $this->application = $application;
        $this->terminal = $terminal;
        $this->card = $card;
        $this->transaction = $transaction;
        $this->address = $address;
        $this->extendedParameters = $extendedParameters;
    }
}