<?php
namespace SinglePay\PaymentService\Element;

use SinglePay\PaymentService\ConfigValidator;

/**
 * ExpressConfigValidator class
 * @uses   ConfigValidator
 * @author Mahendra Rai
 */
class ExpressConfigValidator extends ConfigValidator
{
    /**
     * @var array
     */
    protected $required = array(
        'accountId',
        'accountToken',
        'acceptorId',
        'applicationId',
        'applicationName',
        'terminalId',
        'expressUrl',
        'returnUrl'
    );

    /**
     * {@inheritdoc}
     */
    public function validate($config)
    {
        foreach ($this->required as $keyword) {
            if (!array_key_exists($keyword, $config)) {
                throw new \Exception("'" . $keyword . "' is missing in the config.");
            }
        }

        return true;
    }
}