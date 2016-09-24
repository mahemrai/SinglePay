<?php
namespace SinglePay;

use SinglePay\PaymentService\PaymentServiceFactory;

/**
 * PaymentProcessor class
 * @author  Mahendra Rai
 */
class PaymentProcessor
{
    /**
     * @var SinglePayConfig
     */
    protected $config;

    /**
     * @param SinglePayConfig $config
     * @param SinglePayData   $data
     */
    public function __construct(SinglePayConfig $config, SinglePayData $data)
    {
        $this->config = $config;
        $this->data = $data;
    }

    /**
     * @param string  $method
     * @param boolean $isPOS
     */
    public function process($method, $isPOS = false)
    {
        $paymentService = PaymentServiceFactory::createPaymentService($this->config, $this->data);

        if (!method_exists($paymentService, $method)) {
            throw new \Exception('Undefined method called.');
        }

        if ($isPOS) {
            $paymentService->$method($isPOS);
        } else {
            $paymentService->$method();
        }
    }
}