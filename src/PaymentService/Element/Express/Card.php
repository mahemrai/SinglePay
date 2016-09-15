<?php
namespace SinglePay\PaymentService\Element\Express;

/**
 * @package SinglePay
 * @author  Mahendra Rai
 */
class Card
{
    public $cardNumber;

    public $expirationMonth;

    public $expirationYear;

    public function __construct($cardNumber, $expirationMonth, $expirationYear)
    {
        $this->cardNumber = $cardNumber;
        $this->expirationMonth = $expirationMonth;
        $this->expirationYear = $expirationYear;
    }
}