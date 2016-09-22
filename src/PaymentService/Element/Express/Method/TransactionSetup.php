<?php
namespace SinglePay\PaymentService\Element\Express\Method;

use SinglePay\PaymentService\Element\Express\Type\Address;
use SinglePay\PaymentService\Element\Express\Type\Application;
use SinglePay\PaymentService\Element\Express\Type\Credentials;
use SinglePay\PaymentService\Element\Express\Type\PaymentAccount;
use SinglePay\PaymentService\Element\Express\Type\Terminal;
use SinglePay\PaymentService\Element\Express\Type\Transaction;

class TransactionSetup
{
    public $credentials;

    public $application;

    public $terminal;

    public $transaction;

    public $transactionSetup;

    public $address;

    public $paymentAccount;

    public $extendedParameters;

    public function __construct(
        Credentials $credentials,
        Application $application,
        Terminal $terminal,
        Transaction $transaction,
        \SinglePay\PaymentService\Element\Express\Type\TransactionSetup $transactionSetup,
        Address $address,
        PaymentAccount $paymentAccount,
        $extendedParameters
    ){
        $this->credentials = $credentials;
        $this->application = $application;
        $this->terminal = $terminal;
        $this->transaction = $transaction;
        $this->transactionSetup = $transactionSetup;
        $this->address = $address;
        $this->paymentAccount = $paymentAccount;
        $this->extendedParameters = $extendedParameters;
    }
}