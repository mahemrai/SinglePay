<?php
use SinglePay\SinglePayData;
use SinglePay\SinglePayConfig;
use SinglePay\Entity\Address;
use SinglePay\Entity\Card;
use SinglePay\Entity\Order;
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
            'applicationVersion' => '1.0',
            'terminalId' => '009',
            'returnUrl' => 'http://localhost'
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
     * Test TransactionSetup call object build fails for updating payment account if no card is passed.
     * 
     * @expectedException        Exception
     * @expectedExceptionMessage Card object is required for this action.
     */
    public function testFailNoCardAccountUpdate()
    {
        $config = new SinglePayConfig();
        $config->setServiceConfig(self::$testConfig);

        $data = new SinglePayData();
        $data->setCustomerNo('112')
             ->setExtras(array(
                'method' => 'update'
             ));

        $transactionSetup = ExpressFactory::buildTransactionSetup($config, $data);
    }

    /**
     * Test TransactionSetup call object build fails for updating payment account if no token is passed.
     * 
     * @expectedException        Exception
     * @expectedExceptionMessage Parameter 'token' is required for this action.
     */
    public function testFailNoTokenAccountUpdate()
    {
        $config = new SinglePayConfig();
        $config->setServiceConfig(self::$testConfig);

        $card = new Card();

        $data = new SinglePayData();
        $data->setCustomerNo('112')
             ->setCard($card)
             ->setExtras(array(
                'method' => 'update'
             ));

        $transactionSetup = ExpressFactory::buildTransactionSetup($config, $data);
    }

     /**
     * Test TransactionSetup call object build fails for creating payment account if no customer no. is pased.
     * 
     * @expectedException        Exception
     * @expectedExceptionMessage Parameter 'customerNo' is required for this action.
     */
    public function testFailNoCustomerNoForAccountCreate()
    {
        $card = new Card();
        $card->setToken('test-token');

        $config = new SinglePayConfig();
        $config->setServiceConfig(self::$testConfig);

        $data = new SinglePayData();

        $data->setCard($card)
             ->setExtras(array(
                'method' => 'update'
             ));

        $transactionSetup = ExpressFactory::buildTransactionSetup($config, $data);
    }

    /**
     * Test TransactionSetup call object build fails for updating payment account if no customer no. is pased.
     * 
     * @expectedException        Exception
     * @expectedExceptionMessage Parameter 'customerNo' is required for this action.
     */
    public function testFailNoCustomerNoForAccountUpdate()
    {
        $config = new SinglePayConfig();
        $config->setServiceConfig(self::$testConfig);

        $data = new SinglePayData();
        $data->setExtras(array(
            'method' => 'create'
        ));

        $transactionSetup = ExpressFactory::buildTransactionSetup($config, $data);
    }

    /**
     * Test CreditCardSale call object is built with provided config details and data but no address. 
     */
    public function testBuildCreditCardSaleWithoutAddress()
    {
        $config = new SinglePayConfig();
        $config->setServiceConfig(self::$testConfig);

        $card = new Card();
        $card->setName('TEST')
             ->setNumber('8696969')
             ->setExpiryMonth('09')
             ->setExpiryYear('18')
             ->setCvv('200');

        $data = new SinglePayData();
        $data->setOrderAmount('10.00')
             ->setCard($card);

        $creditCardSale = ExpressFactory::buildCreditCardSale($config, $data);
        $this->assertInstanceOf('\SinglePay\PaymentService\Element\Express\Method\CreditCardSale', $creditCardSale);
        $this->assertNull($creditCardSale->address);
        $this->assertNull($creditCardSale->extendedParameters);
    }

    /**
     * Test CreditCardSale call object is built with provided config details and data including address.
     */
    public function testBuildCreditCardSaleWithAddress()
    {
        $config = new SinglePayConfig();
        $config->setServiceConfig(self::$testConfig);

        $card = new Card();
        $card->setName('TEST')
             ->setNumber('8696969')
             ->setExpiryMonth('09')
             ->setExpiryYear('18')
             ->setCvv('200');

        $billingAddress = new Address();
        $billingAddress->setAddress1('Test Street')
                       ->setCity('Test City')
                       ->setState('Test County')
                       ->setZipcode('545454');

        $shippingAddress = new Address();
        $shippingAddress->setAddress1('Test Street')
                       ->setCity('Test City')
                       ->setState('Test County')
                       ->setZipcode('545454');

        $data = new SinglePayData();
        $data->setOrderAmount('10.00')
             ->setCard($card)
             ->setBillingAddress($billingAddress)
             ->setShippingAddress($shippingAddress);

        $creditCardSale = ExpressFactory::buildCreditCardSale($config, $data);
        $this->assertInstanceOf('\SinglePay\PaymentService\Element\Express\Method\CreditCardSale', $creditCardSale);
        $this->assertFalse(is_null($creditCardSale->address));
        $this->assertNull($creditCardSale->extendedParameters);
    }

    /**
     * Test CreditCardSale call object build fails if no order amount is passed.
     *
     * @expectedException        Exception
     * @expectedExceptionMessage Order amount is required for this action.
     */
    public function testBuildCreditCardSaleFailsWithNoOrderAmount()
    {
        $config = new SinglePayConfig();
        $config->setServiceConfig(self::$testConfig);

        $data = new SinglePayData();

        $creditCardSale = ExpressFactory::buildCreditCardSale($config, $data);
    }

    /**
     * Test CreditCardSale call object is built with provided config details and data
     * that includes card token.
     */
    public function testBuildCreditCardSaleWithToken()
    {
        $config = new SinglePayConfig();
        $config->setServiceConfig(self::$testConfig);

        $card = new Card();
        $card->setToken('Hello')
             ->setName('TEST')
             ->setNumber('8696969')
             ->setExpiryMonth('09')
             ->setExpiryYear('18')
             ->setCvv('200');

        $billingAddress = new Address();
        $billingAddress->setAddress1('Test Street')
                       ->setCity('Test City')
                       ->setState('Test County')
                       ->setZipcode('545454');

        $shippingAddress = new Address();
        $shippingAddress->setAddress1('Test Street')
                       ->setCity('Test City')
                       ->setState('Test County')
                       ->setZipcode('545454');

        $data = new SinglePayData();
        $data->setOrderAmount('10.00')
             ->setCard($card)
             ->setBillingAddress($billingAddress)
             ->setShippingAddress($shippingAddress);

        $creditCardSale = ExpressFactory::buildCreditCardSale($config, $data);
        $this->assertInstanceOf('\SinglePay\PaymentService\Element\Express\Method\CreditCardSale', $creditCardSale);
        $this->assertFalse(is_null($creditCardSale->address));
        $this->assertInstanceOf('\SinglePay\PaymentService\Element\Express\Type\ExtendedParameters', $creditCardSale->extendedParameters);
        $this->assertInternalType('int', $creditCardSale->extendedParameters->Value->enc_type);
    }

    /**
     * Test CreditCardSale call object build fails if no card is provided.
     *
     * @expectedException        Exception
     * @expectedExceptionMessage Card information is required for this action.
     */
    public function testBuildCreditCardSaleFailsWithNoCard()
    {
        $config = new SinglePayConfig();
        $config->setServiceConfig(self::$testConfig);

        $data = new SinglePayData();
        $data->setOrderAmount('10.00');

        $creditCardSale = ExpressFactory::buildCreditCardSale($config, $data);
    }

    /**
     * Test CreditCardReversal call object is built with provided config details and data.
     */
    public function testBuildCreditCardReversal()
    {
        $config = new SinglePayConfig();
        $config->setServiceConfig(self::$testConfig);

        $card = new Card();
        $card->setToken('test-token')
             ->setName('TEST')
             ->setNumber('8696969')
             ->setExpiryMonth('09')
             ->setExpiryYear('18')
             ->setCvv('200');

        $data = new SinglePayData();
        $data->setOrderAmount('10.00')
             ->setCard($card);

        $creditCardReversal = ExpressFactory::buildCreditCardReversal($config, $data);
        $this->assertInstanceOf('\SinglePay\PaymentService\Element\Express\Method\CreditCardReversal', $creditCardReversal);
        $this->assertInternalType('array', $creditCardReversal->extendedParameters);
        $this->assertInternalType('int', $creditCardReversal->extendedParameters[0]->Value->enc_type);
    }

    /**
     * Test CreditCardReversal call object build fails if no card is provided.
     * 
     * @expectedException        Exception
     * @expectedExceptionMessage Card information is required for this action.
     */
    public function testBuildCreditCardReversalFailWithNoCard()
    {
        $config = new SinglePayConfig();
        $config->setServiceConfig(self::$testConfig);

        $data = new SinglePayData();
        $data->setOrderAmount('10.00');

        $creditCardReversal = ExpressFactory::buildCreditCardReversal($config, $data);
    }

    /**
     * Test CreditCardReversal call object build fails if card token is not provided.
     * @expectedException        Exception
     * @expectedExceptionMessage Parameter 'token' is required for this action.
     */
    public function testBuildCreditCardReversalFailWithNoToken()
    {
        $config = new SinglePayConfig();
        $config->setServiceConfig(self::$testConfig);

        $card = new Card();
        $card->setName('TEST')
             ->setNumber('8696969')
             ->setExpiryMonth('09')
             ->setExpiryYear('18')
             ->setCvv('200');

        $data = new SinglePayData();
        $data->setOrderAmount('10.00')
             ->setCard($card);

        $creditCardReversal = ExpressFactory::buildCreditCardReversal($config, $data);
    }

    /**
     * Test CreditCardVoid call object is built with the provided config details and data
     * that includes card token.
     */
    public function testBuildCreditCardVoid()
    {
        $config = new SinglePayConfig();
        $config->setServiceConfig(self::$testConfig);

        $card = new Card();
        $card->setToken('test-token')
             ->setName('TEST')
             ->setNumber('8696969')
             ->setExpiryMonth('09')
             ->setExpiryYear('18')
             ->setCvv('200');

        $data = new SinglePayData();
        $data->setOrderAmount('10.00')
             ->setCard($card);

        $creditCardVoid = ExpressFactory::buildCreditCardVoid($config, $data);
        $this->assertInstanceOf('\SinglePay\PaymentService\Element\Express\Method\CreditCardVoid', $creditCardVoid);
        $this->assertInternalType('array', $creditCardVoid->extendedParameters);
        $this->assertEquals('PaymentAccount', $creditCardVoid->extendedParameters[0]->Key);
    }

    /**
     * Test CreditCardVoid build fails if no card is provided.
     * 
     * @expectedException        Exception
     * @expectedExceptionMessage Card information is required for this action.
     */
    public function testBuildCreditCardVoidFailWithNoCard()
    {
        $config = new SinglePayConfig();
        $config->setServiceConfig(self::$testConfig);

        $data = new SinglePayData();
        $data->setOrderAmount('10.00');

        $creditCardReversal = ExpressFactory::buildCreditCardVoid($config, $data);
    }

    /**
     * Test CreditCardVoid fails if payment token is not provided.
     * 
     * @expectedException        Exception
     * @expectedExceptionMessage Parameter 'token' is required for this action.
     */
    public function testBuildCreditCardVoidFailWithNoToken()
    {
        $config = new SinglePayConfig();
        $config->setServiceConfig(self::$testConfig);

        $card = new Card();
        $card->setName('TEST')
             ->setNumber('8696969')
             ->setExpiryMonth('09')
             ->setExpiryYear('18')
             ->setCvv('200');

        $data = new SinglePayData();
        $data->setOrderAmount('10.00')
             ->setCard($card);

        $creditCardReversal = ExpressFactory::buildCreditCardVoid($config, $data);
    }

    /**
     * Test CreditCardAVSOnly call object is built with the provided config details and data.
     */
    public function testBuildCreditCardAVSOnly()
    {
        $config = new SinglePayConfig();
        $config->setServiceConfig(self::$testConfig);

        $card = new Card();
        $card->setName('TEST')
             ->setNumber('8696969')
             ->setExpiryMonth('09')
             ->setExpiryYear('18')
             ->setCvv('200');

        $order = new Order();
        $order->setAmount('10.00')
              ->setCustomerNo('1990');

        $billingAddress = new Address();
        $billingAddress->setName('TEST')
                       ->setAddress1('Test address 1')
                       ->setAddress2('Test address 2')
                       ->setCity('Test City')
                       ->setState('Test State')
                       ->setZipcode('Test Zipcode')
                       ->setEmail('Test Email')
                       ->setPhone('112212121212');

        $shippingAddress = new Address();

        $data = new SinglePayData();
        $data->setOrder($order)
             ->setCard($card)
             ->setBillingAddress($billingAddress)
             ->setShippingAddress($shippingAddress);

        $creditCardAVSOnly = ExpressFactory::buildCreditCardAVSOnly($config, $data);
        $this->assertInstanceOf('\SinglePay\PaymentService\Element\Express\Method\CreditCardAVSOnly', $creditCardAVSOnly);
        $this->assertInstanceOf('\SinglePay\PaymentService\Element\Express\Type\Address', $creditCardAVSOnly->address);
    }

    /**
     * Reset config array after the end of tests.
     */
    public static function tearDownAfterClass()
    {
        self::$testConfig = array();
    }
}