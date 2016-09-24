<?php
use SinglePay\SinglePayConfig;
use SinglePay\PaymentService\Element\ExpressFactory;
use SinglePay\PaymentService\Element\Express\Type\Application;
use SinglePay\PaymentService\Element\Express\Type\Credentials;
use SinglePay\PaymentService\Element\Express\Method\HealthCheck;

class ExpressFactoryTest extends PHPUnit_Framework_TestCase
{
    protected static $testConfig;

    public static function setUpBeforeClass()
    {
        self::$testConfig = array(
            'accountId' => '181918',
            'accountToken' => 'test-token',
            'acceptorId' => '3',
            'applicationId' => '2',
            'applicationName' => 'SinglePay Test',
            'applicationVersion' => '1.0'
        );
    }

    public function testBuildHealthCheck()
    {
        $config = new SinglePayConfig();
        $config->setServiceConfig(self::$testConfig);

        $healthCheck = ExpressFactory::buildHealthCheck($config->getServiceConfig());
        $this->assertInstanceOf('\SinglePay\PaymentService\Element\Express\Method\HealthCheck', $healthCheck);
    }

    public static function tearDownAfterClass()
    {
        self::$testConfig = array();
    }
}