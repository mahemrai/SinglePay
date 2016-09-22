<?php
namespace SinglePay\PaymentService\Element\Express\Type;

class PaymentAccount
{
    public $PaymentAccountID;

    public $PaymentAccountType;

    public $PaymentBrand;

    public $PaymentAccountReferenceNumber;

    public $TransactionSetupID;

    public $PASSUpdaterBatchStatus;

    public $PASSUpdaterOption;

    public function __construct(
        $paymentAccountId,
        $paymentAccountType,
        $paymentBrand,
        $paymentAccountReferenceNumber,
        $transactionSetupId,
        $passUpdaterBatchStatus,
        $passUpdaterOption
    ){
        $this->PaymentAccountID = $paymentAccountId;
        $this->PaymentAccountType = $paymentAccountType;
        $this->PaymentBrand = $paymentBrand;
        $this->TransactionSetupID = $transactionSetupId;
        $this->PASSUpdaterBatchStatus = $passUpdaterBatchStatus;
        $this->PASSUpdaterOption = $passUpdaterOption;
    }
}