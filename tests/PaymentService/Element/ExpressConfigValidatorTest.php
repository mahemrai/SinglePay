<?php
use SinglePay\PaymentService\Element\ExpressConfigValidator;

class ExpressConfigValidatorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException  Exception
     */
    public function testConfigValidationFail()
    {
        $configArray = array(
            'accountId' => '11',
            'accountToken' => 'test-token',
            'acceptorId' => '2',
            'applicationId' => '5',
            'applicationName' => 'SinglePay'
        );

        $validator = new ExpressConfigValidator();
        $validator->validate($configArray);
    }

    public function testSuccessfulValidation()
    {
        $configArray = array(
            'accountId' => '11',
            'accountToken' => 'test-token',
            'acceptorId' => '2',
            'applicationId' => '5',
            'applicationName' => 'SinglePay',
            'applicationVersion' => '1.0',
            'terminalId' => '009',
            'expressUrl' => 'http://localhost',
            'returnUrl' => 'http://localhost'
        );

        $validator = new ExpressConfigValidator();
        $result = $validator->validate($configArray);
        $this->assertTrue($result);
    }
}