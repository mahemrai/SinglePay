<?php
namespace SinglePay\PaymentService\Element;

use SinglePay\PaymentService\PaymentServiceInterface;

/**
 * @package SinglePay
 * @uses    PaymentServiceInterface
 * @author  Mahendra Rai
 */
class ElementService implements PaymentServiceInterface
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

    public function setup($data)
    {

    }

    public function processPayment($data)
    {
        echo 'Processing...';die;
    }

    public function refund($data)
    {
        echo 'Refunding...';die;
    }

    public function saveCard($data)
    {
        echo 'Saving...';die;
    }

    public function payWithSavedCard($data)
    {
        echo 'Paying...';die;
    }
}