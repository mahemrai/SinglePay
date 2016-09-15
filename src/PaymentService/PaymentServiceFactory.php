<?php
namespace SinglePay\PaymentService;

use SinglePay\SPConfig;
use SinglePay\PaymentService\Element\ElementService;

/**
 * @package SinglePay
 * @author  Mahendra Rai
 */
class PaymentServiceFactory
{
    /**
     * @param  string $paymentGatewayName
     * @return mixed
     */
    public static function createPaymentService(SPConfig $config)
    {
        switch ($config->getServiceName()) {
            case 'element':
                return new ElementService($config->getServiceConfig());
            default:
                throw new \Exception('Payment service does not exist.');
        }
    }
}