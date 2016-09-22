<?php
namespace SinglePay\PaymentService\Element;

use SinglePay\PaymentService\Element\Express\HealthCheck;
use SinglePay\PaymentService\Element\Express\Application;
use SinglePay\PaymentService\Element\Express\Credentials;
use SinglePay\PaymentService\PaymentServiceInterface;

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

    public function test($data)
    {
        $application = new Application($this->config['applicationId'], $this->config['applicationName'], $this->config['applicationVersion']);
        $credentials = new Credentials($this->config['accountId'], $this->config['accountToken'], $this->config['acceptorId']);
        $healthCheck = new HealthCheck($credentials, $application);

        $client = new \SoapClient($this->config['uri'], array('features' => 1));

        $result = $client->HealthCheck(array(
            'credentials' => $credentials,
            'application' => $application
        ));

        var_dump($result);die;
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