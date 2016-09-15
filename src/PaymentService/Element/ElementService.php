<?php
namespace SinglePay\PaymentService\Element;

use SinglePay\PaymentService\AbstractPaymentService;

/**
 * @package SinglePay
 * @uses    AbstractPaymentService
 * @author  Mahendra Rai
 */
class ElementService
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @param array $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    public function hello()
    {
        echo 'Hello Element';die;
    }

    public function processPayment()
    {
        echo 'Processing...';die;
    }
}