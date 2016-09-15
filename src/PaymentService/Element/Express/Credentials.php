<?php
namespace SinglePay\PaymentService\Element\Express;

/**
 * Credentials class
 *
 * @package SinglePay
 * @author  Mahendra Rai
 */
class Credentials
{
    public $accountId;

    public $accountToken;

    public $acceptorId;

    public function __construct($accountId, $accountToken, $acceptorId)
    {
        $this->accountId = $accountId;
        $this->accountToken = $accountToken;
        $this->acceptorId = $acceptorId;
    }
}