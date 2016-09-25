<?php
use SinglePay\SinglePayConfig;
use SinglePay\SinglePayData;
use SinglePay\PaymentService\PaymentServiceFactory;
use SinglePay\PaymentService\Element\ElementService;

class PaymentServiceFactoryTest extends PHPUnit_Framework_TestCase
{
    public function testCreateElementService()
    {
        $config = new SinglePayConfig();
        $config->setServiceName('element');

        $data = new SinglePayData();

        $this->assertInstanceOf('\SinglePay\SinglePayConfig', $config);
        $this->assertInstanceOf('\SinglePay\SinglePayData', $data);

        $paymentService = PaymentServiceFactory::createPaymentService($config, $data);
        $this->assertInstanceOf('\SinglePay\PaymentService\Element\ElementService', $paymentService);
    }

    /**
     * @expectedException        Exception
     * @expectedExceptionMessage Payment service does not exist.
     */
    public function testFailServiceCreation()
    {
        $config = new SinglePayConfig();
        $config->setServiceName('paleepay');

        $data = new SinglePayData();

        $paymentService = PaymentServiceFactory::createPaymentService($config, $data);
    }
}