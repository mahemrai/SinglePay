<?php
use SinglePay\PaymentService\Element\Builder\TransactionBuilder;

/**
 * TransactionBuilderTest
 * @author Mahendra Rai
 */
class TransactionBuilderTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test Transaction object is built for standard Web client with appropriate settings.
     */
    public function testBuildStandardTransaction()
    {
        $config = array();
        $amount = '10.00';

        $transaction = TransactionBuilder::buildStandardTransaction($config, $amount);
        $this->assertInstanceOf('\SinglePay\PaymentService\Element\Express\Type\Transaction', $transaction);
        $this->assertEquals($transaction->MarketCode, 'ECommerce');
        $this->assertEquals($transaction->TransactionAmount, '10.00');
    }

    /**
     * Test Transaction object is built for POS client with appropriate settings.
     */
    public function testBuildPOSTransaction()
    {
        $config = array();
        $amount = '10.00';

        $transaction = TransactionBuilder::buildPOSTransaction($config, $amount);
        $this->assertInstanceOf('\SinglePay\PaymentService\Element\Express\Type\Transaction', $transaction);
        $this->assertEquals($transaction->MarketCode, 'Retail');
        $this->assertEquals($transaction->TransactionAmount, '10.00');
    }
}