<?php
namespace SinglePay;

use SinglePay\PaymentService\PaymentServiceFactory;

/**
 * @package SinglePay
 * @author  Mahendra Rai
 */
class PaymentProcessor
{
    /**
     * @var SPConfig
     */
    protected $config;

    /**
     * @param SPConfig $config
     */
    public function __construct(SPConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param  string $method
     */
    public function process($method, $data, $isPOS = false)
    {
        $paymentService = PaymentServiceFactory::createPaymentService($this->config);

        if (!method_exists($paymentService, $method)) {
            throw new \Exception('Undefined method called.');
        }

        if ($isPOS) {
            $paymentService->$method($data, $isPOS);
        } else {
            $paymentService->$method($data);
        }
    }
}