<?php
namespace SinglePay\PaymentService\Element\Express\Type;

class DemandDepositAccount
{
    public $DDAAccountType;

    public $AccountNumber;

    public $RoutingNumber;

    public $CheckNumber;

    public $TruncatedAccountNumber;

    public $TruncatedRoutingNumber;

    public function __construct($DDAAccountType, $AccountNumber, $RoutingNumber, $CheckNumber, $TruncatedAccountNumber, $TruncatedRoutingNumber)
    {
        $this->DDAAccountType = $DDAAccountType;
        $this->AccountNumber = $AccountNumber;
        $this->RoutingNumber = $RoutingNumber;
        $this->CheckNumber = $CheckNumber;
        $this->TruncatedAccountNumber = $TruncatedAccountNumber;
        $this->TruncatedRoutingNumber = $TruncatedRoutingNumber;
    }
}