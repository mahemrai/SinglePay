<?php
namespace SinglePay\PaymentService\Element\Express;

/**
 * @package SinglePay
 * @author  Mahendra Rai
 */
class Transaction
{
    public $transactionAmount;

    public $marketCode;

    /**
     * @param float  $transactionAmount
     * @param string $marketCode
     */
    public function __construct($transactionAmount, $marketCode)
    {
        $this->transactionAmount = $transactionAmount;
        $this->marketCode = $marketCode;
    }
}