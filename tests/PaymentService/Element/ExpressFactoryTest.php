<?php
use SinglePay\SinglePayData;
use SinglePay\SinglePayConfig;
use SinglePay\Entity\Card;
use SinglePay\PaymentService\Element\ExpressFactory;
use SinglePay\PaymentService\Element\Express\Type\Application;
use SinglePay\PaymentService\Element\Express\Type\Credentials;
use SinglePay\PaymentService\Element\Express\Method\HealthCheck;

/**
 * ExpressFactoryTest
 * @author Mahendra Rai
 */
class ExpressFactoryTest extends PHPUnit_Framework_TestCase
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
            'applicationVersion' => '1.0'
        );
    }

    /**
     * Test HealthCheck call object is built with the provided config details.
     */
    public function testBuildHealthCheck()
    {
        $config = new SinglePayConfig();
        $config->setServiceConfig(self::$testConfig);

        $healthCheck = ExpressFactory::buildHealthCheck($config);
        $this->assertInstanceOf('\SinglePay\PaymentService\Element\Express\Method\HealthCheck', $healthCheck);
    }

    /**
     * Test TransactionSetup call object is built for web clients with the provided config details and data.
     */
    public function testBuildWebTransactionSetup()
    {
        $config = new SinglePayConfig();
        $config->setServiceConfig(self::$testConfig);

        $data = new SinglePayData();
        $data->setOrderAmount('10.00');

        $transactionSetup = ExpressFactory::buildTransactionSetup($config, $data);
        $this->assertInstanceOf('\SinglePay\PaymentService\Element\Express\Method\TransactionSetup', $transactionSetup);
        $this->assertEquals($transactionSetup->terminal->TerminalType, 'ECommerce');
        $this->assertEquals($transactionSetup->terminal->CardInputCode, 'ManualKeyed');
        $this->assertEquals($transactionSetup->terminal->TerminalCapabilityCode, 'KeyEntered');
        $this->assertEquals($transactionSetup->terminal->TerminalEnvironmentCode, 'ECommerce');
        $this->assertFalse(strcasecmp($transactionSetup->terminal->TerminalType, 'PointOfSale') == 0);

        $this->assertEquals($transactionSetup->transactionSetup->TransactionSetupMethod, 'CreditCardSale');
        $this->assertEquals($transactionSetup->transactionSetup->Device, 'Null');
    }

    /**
     * Test TransactionSetup call object is built for POS client with the provided config details and data.
     */
    public function testBuildPOSTransactionSetup()
    {
        $config = new SinglePayConfig();
        $config->setServiceConfig(self::$testConfig);

        $data = new SinglePayData();
        $data->setOrderAmount('10.00');

        $transactionSetup = ExpressFactory::buildTransactionSetup($config, $data, true);
        $this->assertInstanceOf('\SinglePay\PaymentService\Element\Express\Method\TransactionSetup', $transactionSetup);
        $this->assertEquals($transactionSetup->terminal->TerminalType, 'PointOfSale');
        $this->assertEquals($transactionSetup->terminal->CardInputCode, 'MagstripeRead');
        $this->assertEquals($transactionSetup->terminal->TerminalCapabilityCode, 'MagstripeReader');
        $this->assertEquals($transactionSetup->terminal->TerminalEnvironmentCode, 'LocalAttended');
        $this->assertFalse(strcasecmp($transactionSetup->terminal->TerminalType, 'ECommerce') == 0);

        $this->assertEquals($transactionSetup->transactionSetup->TransactionSetupMethod, 'CreditCardSale');
        $this->assertEquals($transactionSetup->transactionSetup->Device, 'MagtekEncryptedSwipe');
    }

    /**
     * Test TransactionSetup call object is built for creating a payment account with provided config details and data.
     */
    public function testBuildAccountCreateTransactionSetup()
    {
        $config = new SinglePayConfig();
        $config->setServiceConfig(self::$testConfig);

        $data = new SinglePayData();
        $data->setCustomerNo('112')
             ->setExtras(array(
                'method' => 'create'
             ));

        $transactionSetup = ExpressFactory::buildTransactionSetup($config, $data);
        $this->assertInstanceOf('\SinglePay\PaymentService\Element\Express\Method\TransactionSetup', $transactionSetup);
        $this->assertEquals($transactionSetup->transactionSetup->TransactionSetupMethod, 'PaymentAccountCreate');
        $this->assertEquals($transactionSetup->transactionSetup->ProcessTransactionTitle, 'Save Card');
    }

    /**
     * Test TransactionSetup call object is built for updating a payment account with provided config details and data.
     */
    public function testBuildAccountUpdateTransactionSetup()
    {
        $config = new SinglePayConfig();
        $config->setServiceConfig(self::$testConfig);

        $card = new Card();
        $card->setToken('affefedeereier8998dfjdfd');

        $data = new SinglePayData();
        $data->setCustomerNo('112')
             ->setCard($card)
             ->setExtras(array(
                'method' => 'update'
             ));

        $transactionSetup = ExpressFactory::buildTransactionSetup($config, $data);
        $this->assertInstanceOf('\SinglePay\PaymentService\Element\Express\Method\TransactionSetup', $transactionSetup);
        $this->assertEquals($transactionSetup->transactionSetup->TransactionSetupMethod, 'PaymentAccountUpdate');
        $this->assertEquals($transactionSetup->transactionSetup->ProcessTransactionTitle, 'Update Card');
    }

    /**
     * Reset config array after the end of tests.
     */
    public static function tearDownAfterClass()
    {
        self::$testConfig = array();
    }
}