<?php
use SinglePay\PaymentService\Element\Builder\TransactionSetupBuilder;

/**
 * TransactionSetupBuilderTest
 * @author Mahendra Rai
 */
class TransactionSetupBuilderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    protected static $testConfig;

    /**
     * Setup config array for testing.
     */
    public static function setUpBeforeClass()
    {
        self::$testConfig = array(
            'accountId' => '181918',
            'accountToken' => 'test-token',
            'acceptorId' => '3',
            'applicationId' => '2',
            'applicationName' => 'SinglePay Test',
            'applicationVersion' => '1.0',
            'returnUrl' => 'http://localhost'
        );
    }

    /**
     * Test TransactionSetup object is built for standard Web sale with appropriate settings.
     */
    public function testBuildCreditCardSaleTransactionSetup()
    {
        $transactionSetup = TransactionSetupBuilder::buildStandardSaleTransactionSetup(self::$testConfig);
        $this->assertInstanceOf('\SinglePay\PaymentService\Element\Express\Type\TransactionSetup', $transactionSetup);
        $this->assertEquals($transactionSetup->TransactionSetupMethod, 'CreditCardSale');
        $this->assertEquals($transactionSetup->Device, 'Null');
    }

    /**
     * Test TransactionSetup object is built for POS sale with appropriate settings.
     */
    public function testBuildPOSSaleTransactionSetup()
    {
        $transactionSetup = TransactionSetupBuilder::buildPOSSaleTransactionSetup(self::$testConfig);
        $this->assertInstanceOf('\SinglePay\PaymentService\Element\Express\Type\TransactionSetup', $transactionSetup);
        $this->assertEquals($transactionSetup->TransactionSetupMethod, 'CreditCardSale');
        $this->assertEquals($transactionSetup->Device, 'MagtekEncryptedSwipe');
    }

    /**
     * Test TransactionSetup object is built for creating new payment account with appropriate settings.
     */
    public function testBuildAccountCreateTransactionSetup()
    {
        $transactionSetup = TransactionSetupBuilder::buildAccountCreateTransactionSetup(self::$testConfig);
        $this->assertInstanceOf('\SinglePay\PaymentService\Element\Express\Type\TransactionSetup', $transactionSetup);
        $this->assertEquals($transactionSetup->TransactionSetupMethod, 'PaymentAccountCreate');
        $this->assertEquals($transactionSetup->Device, 'Null');
        $this->assertEquals($transactionSetup->ProcessTransactionTitle, 'Save Card');
    }

    /**
     * Test TransactionSetup object is built for updating existing payment account with appropriate settings.
     */
    public function testBuildAccountUpdateTransactionSetup()
    {
        $transactionSetup = TransactionSetupBuilder::buildAccountUpdateTransactionSetup(self::$testConfig);
        $this->assertInstanceOf('\SinglePay\PaymentService\Element\Express\Type\TransactionSetup', $transactionSetup);
        $this->assertEquals($transactionSetup->TransactionSetupMethod, 'PaymentAccountUpdate');
        $this->assertEquals($transactionSetup->Device, 'Null');
        $this->assertEquals($transactionSetup->ProcessTransactionTitle, 'Update Card');
    }

    public static function tearDownAfterClass()
    {
        self::$testConfig = array();
    }
}