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
    public function __construct(SinglePayConfig $config, SinglePayData $data)
    {
        $this->config = $config;
        $this->data = $data;
    }

    /**
     * @param  string $method
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