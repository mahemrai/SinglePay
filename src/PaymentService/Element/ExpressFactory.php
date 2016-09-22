<?php
namespace SinglePay\PaymentService\Element;

use SinglePay\PaymentService\Element\Express\Type\Address;
use SinglePay\PaymentService\Element\Express\Type\Application;
use SinglePay\PaymentService\Element\Express\Type\Credentials;
use SinglePay\PaymentService\Element\Express\Type\PaymentAccount;
use SinglePay\PaymentService\Element\Express\Type\Terminal;
use SinglePay\PaymentService\Element\Express\Type\Transaction;
use SinglePay\PaymentService\Element\Express\Method\HealthCheck;

/**
 * @package SinglePay
 * @author  Mahendra Rai
 */
class ExpressFactory
{
    /**
     * @param  array $config
     * @return HealthCheck
     */
    public static function buildHealthCheck($config)
    {
        $application = new Application($config['applicationId'], $config['applicationName'], $config['applicationVersion']);
        $credentials = new Credentials($config['accountId'], $config['accountToken'], $config['acceptorId'], NULL);

        return new HealthCheck($credentials, $application);
    }

    /**
     * @param  array $config
     * @param  array $data
     * @return \SinglePay\PaymentService\Element\Express\Method\TransactionSetup
     */
    public static function buildTransactionSetup($config, $data)
    {
        $application = new Application($config['applicationId'], $config['applicationName'], $config['applicationVersion']);
        $credentials = new Credentials($config['accountId'], $config['accountToken'], $config['acceptorId'], NULL);

        $transaction = new Transaction(
            null,
            null,
            null,
            $data['orderAmount'],
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            'Full',
            'ECommerce',
            null,
            null,
            'False',
            'True',
            'True',
            'False',
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            'False',
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            'Default',
            'Unknown'
        );

        $transactionSetup = new \SinglePay\PaymentService\Element\Express\Type\TransactionSetup(
            null,
            null,
            null,
            null,
            null,
            null,
            'CreditCardSale',
            'Null',
            'True',
            'False',
            'True',
            null,
            null,
            null,
            null,
            $config['returnUrl'],
            null,
            null,
            null,
            null,
            'NotUsed'
        );

        if (strcasecmp($data['method'], 'create') == 0) {
            $transactionSetup->TransactionSetupMethod = 'PaymentAccountCreate';
        } elseif (strcasecmp($data['method'], 'update') == 0) {
            $transactionSetup->TransactionSetupMethod = 'PaymentAccountUpdate';
        }

        $terminal = new Terminal(
            '01',
            'ECommerce',
            'NotPresent',
            'ECommerce',
            'ManualKeyed',
            'Provided',
            'KeyEntered',
            'ECommerce',
            'NonAuthenticatedSecureECommerceTransaction',
            'Regular',
            'Internet',
            null,
            'Default',
            null,
            null,
            null
        );

        $address = new Address(
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null
        );

        $paymentAccount = new PaymentAccount(
            null,
            'CreditCard',
            null,
            null,
            null,
            'Null',
            'Null'
        );

        if (strcasecmp($data['method'], 'create') == 0) {
            if (!isset($data['customerNo'])) {
                throw new \Exception("Parameter 'customerNo' is required for this action.");
            }

            $paymentAccount->PaymentAccountReferenceNumber = $data['customerNo'];
        } elseif (strcasecmp($data['method'], 'update') == 0) {
            if (!isset($data['customerNo'])) {
                throw new \Exception("Parameter 'customerNo' is required for this action.");
            }

            if (!isset($data['paymentToken'])) {
                throw new \Exception("Parameter 'paymentToken' is required for this action.");
            }

            $paymentAccount->PaymentAccountID = $data['paymentToken'];
            $paymentAccount->PaymentAccountReferenceNumber = $data['customerNo'];
        }

        return new \SinglePay\PaymentService\Element\Express\Method\TransactionSetup(
            $credentials,
            $application,
            $terminal,
            $transaction,
            $transactionSetup,
            $address,
            $paymentAccount,
            null
        );
    }
}