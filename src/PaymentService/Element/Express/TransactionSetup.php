<?php
namespace SinglePay\PaymentService\Element\Express;

/**
 * @package SinglePay
 * @author  Mahendra Rai
 */
class TransactionSetup
{
    public $transactionSetupMethod;

    public $embedded;

    public $autoReturn;

    public $returnURL;

    /**
     * @param int     $transactionSetupMethod
     * @param boolean $embedded
     * @param string  $autoReturn
     * @param string  $returnURL
     */
    public function __construct($transactionSetupMethod, $embedded, $autoReturn, $returnURL)
    {
        $this->transactionSetupMethod = $transactionSetupMethod;
        $this->embedded = $embedded;
        $this->autoReturn = $autoReturn;
        $this->returnURL = $returnURL;
    }
}