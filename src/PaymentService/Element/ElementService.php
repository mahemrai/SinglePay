<?php
namespace SinglePay\PaymentService\Element;

use SinglePay\PaymentService\PaymentServiceInterface;
use SinglePay\PaymentService\Element\ExpressFactory;

/**
 * @package SinglePay
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
     * @param array $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    public function healthCheck($data)
    {
        $client = new \SoapClient($this->config['uri'], array(
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

    public function token($data, $isPOS = false)
    {
        $client = new \SoapClient($this->config['uri'], array(
            'trace' => 1,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'features' => 1
        ));

        $transactionSetup = ExpressFactory::buildTransactionSetup($this->config, $data, $isPOS);

        try {
            $result = $client->__soapCall('TransactionSetup', array($transactionSetup));

            var_dump($result); die;
        } catch (\SoapFault $fault) {
            var_dump($fault);
            echo $client->__getLastRequest();
            die;
        }
    }

    public function processPayment($data)
    {
        echo 'Processing...';die;
    }

    public function refund($data)
    {
        echo 'Refunding...';die;
    }

    public function saveCard($data)
    {
        echo 'Saving...';die;
    }

    public function payWithSavedCard($data)
    {
        echo 'Paying...';die;
    }
}