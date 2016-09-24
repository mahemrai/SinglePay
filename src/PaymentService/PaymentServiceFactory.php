<?php
namespace SinglePay\PaymentService;

use SinglePay\SinglePayConfig;
use SinglePay\SinglePayData;
use SinglePay\PaymentService\Element\ElementService;

/**
 * PaymentServiceFactory class
 * @author  Mahendra Rai
 */
class PaymentServiceFactory
{
    /**
     * @param  string $paymentGatewayName
     * @return mixed
     */
    public static function createPaymentService(SinglePayConfig $config, SinglePayData $data)
    {
        switch ($config->getServiceName()) {
            case 'element':
                return new ElementService($config->getServiceConfig(), $data);
            default:
                throw new \Exception('Payment service does not exist.');
        }
    }
}