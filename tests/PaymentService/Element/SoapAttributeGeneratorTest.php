<?php
use SinglePay\PaymentService\Element\SoapAttributeGenerator;

/**
 * SoapAttributeGeneratorTest
 * @author Mahendra Rai
 */
class SoapAttributeGeneratorTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test generating attribute fails if one or more arguments are missing.
     * 
     * @expectedException Exception
     */
    public function testCreateSoapAttributeFailsWithNullArguments()
    {
        $attribute = SoapAttributeGenerator::createSoapAttribute(null, null, null);
        $attribute = SoapAttributeGenerator::createSoapAttribute('TestType', null, null);
        $attribute = SoapAttributeGenerator::createSoapAttribute('TestType', 'ID', null);
    }

    /**
     * Test soap attribute is created successfully.
     */
    public function testSuccessfulCreateSoapAttribute()
    {
        $attribute = SoapAttributeGenerator::createSoapAttribute('TestType', 'ID', 4566);
        $this->assertInternalType('string', $attribute->enc_value);
    }
}