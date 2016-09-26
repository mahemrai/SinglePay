<?php
namespace SinglePay\PaymentService\Element;

use SinglePay\SinglePayConfig;
use SinglePay\SinglePayData;
use SinglePay\PaymentService\Element\ExpressConfigValidator;
use SinglePay\PaymentService\PaymentServiceInterface;
use SinglePay\PaymentService\Element\ExpressFactory;

/**
 * ElementService class
 * @uses    PaymentServiceInterface
 * @author  Mahendra Rai
 */
class ElementService implements PaymentServiceInterface
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var SinglePayData
     */
    protected $data;

    /**
     * @var ExpressConfigValidator
     */
    protected $validator;

    /**
     * @param SinglePayConfig $config
     */
    public function __construct(SinglePayConfig $config, SinglePayData $data)
    {
        $this->config = $config;
        $this->data = $data;
        $this->validator = new ExpressConfigValidator();
    }

    /**
     * {@inheritdoc}
     */
    public function healthCheck()
    {
        $client = new \SoapClient($this->config->getServiceConfig()['expressUrl'], array(
            'trace' => 1,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'features' => 1
        ));

        try {
            $result = $client->__soapCall('HealthCheck', array(ExpressFactory::buildHealthCheck($this->config)));

            var_dump($result);die;
        } catch (\SoapFault $fault) {
            var_dump($fault);
            echo $client->__getLastRequest();
            die;
        }
    }

    public function token($isPOS = false)
    {
        $client = new \SoapClient($this->config->getServiceConfig()['expressUrl'], array(
            'trace' => 1,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'features' => 1
        ));

        $transactionSetup = ExpressFactory::buildTransactionSetup($this->config, $this->data, $isPOS);

        try {
            $result = $client->__soapCall('TransactionSetup', array($transactionSetup));

            var_dump($result); die;
        } catch (\SoapFault $fault) {
            var_dump($fault);
            echo $client->__getLastRequest();
            die;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function authorise($useToken = false)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function processPayment()
    {
        $client = new \SoapClient($this->config->getServiceConfig()['expressUrl'], array(
            'trace' => 1,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'features' => 1
        ));

        $creditCardSale = ExpressFactory::buildCreditCardSale($this->config, $this->data);

        try {
            $result = $client->__soapCall('CreditCardSale', array($creditCardSale));

            var_dump($result); die;
        } catch (\SoapFault $fault) {
            var_dump($fault);
            echo $client->__getLastRequest();
            die;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function refund()
    {
        $client = new \SoapClient($this->config->getServiceConfig()['expressUrl'], array(
            'trace' => 1,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'features' => 1
        ));

        $creditCardReversal = ExpressFactory::buildCreditCardReversal($this->config, $this->data);

        try {
            $result = $client->__soapCall('CreditCardReversal', array($creditCardReversal));

            var_dump($result); die;
        } catch (\SoapFault $fault) {
            var_dump($fault);
            echo $client->__getLastRequest();
            die;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function saveCard()
    {
        echo 'Saving...';die;
    }

    /**
     * {@inheritdoc}
     */
    public function payWithSavedCard()
    {
        echo 'Paying...';die;
    }
}