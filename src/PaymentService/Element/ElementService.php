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
    use \SinglePay\PaymentService\ResponseValidable;

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
     * Array of successful express response codes.
     * @var array
     */
    protected $expressCodes = array(0, 5);

    /**
     * Array of successful AVS response codes.
     * @var array
     */
    protected $avsCodes = array('F', 'M', 'X', 'Y', '0');

    /**
     * @param SinglePayConfig $config
     */
    public function __construct(SinglePayConfig $config, SinglePayData $data, ExpressConfigValidator $validator)
    {
        $this->config = $config;
        $this->data = $data;
        $this->validator = $validator;
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
        $client = new \SoapClient($this->config->getServiceConfig()['expressUrl'], array(
            'trace' => 1,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'features' => 1
        ));

        $creditCardAVSOnly = ExpressFactory::buildCreditCardAVSOnly($this->config, $this->data, $useToken);

        try {
            $result = $client->__soapCall('CreditCardAVSOnly', array($creditCardAVSOnly));
            if ($this->validateResponse((int) $result->response->ExpressResponseCode, $this->expressCodes)) {
                if ($this->validateResponse((string) $result->response->Card->AVSResponseCode, $this->avsCodes)) {
                    return $result;
                }
            }
        } catch (Exception $e) {
            var_dump($fault);
            echo $client->__getLastRequest();
            die;
        }
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