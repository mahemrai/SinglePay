<?php
namespace SinglePay\PaymentService\Element;

use SinglePay\SinglePayData;
use SinglePay\PaymentService\Element\Express\Enum\PaymentAccountType;
use SinglePay\PaymentService\Element\Express\Enum\PASSUpdaterBatchStatus;
use SinglePay\PaymentService\Element\Express\Enum\PASSUpdaterOption;
use SinglePay\PaymentService\Element\Express\Type\Address;
use SinglePay\PaymentService\Element\Express\Type\Application;
use SinglePay\PaymentService\Element\Express\Type\Credentials;
use SinglePay\PaymentService\Element\Express\Type\PaymentAccount;
use SinglePay\PaymentService\Element\Express\Method\HealthCheck;
use SinglePay\PaymentService\Element\Express\Method\TransactionSetup;
use SinglePay\PaymentService\Element\Builder\TerminalBuilder;
use SinglePay\PaymentService\Element\Builder\TransactionBuilder;
use SinglePay\PaymentService\Element\Builder\TransactionSetupBuilder;

/**
 * @package SinglePay
 * @author  Mahendra Rai
 */
class ExpressFactory
{
    /**
     * Build an instance of HealthCheck call object.
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
     * Build an instance of TransactionSetup call object.
     * @param  array $config
     * @param  array $data
     * @return \SinglePay\PaymentService\Element\Express\Method\TransactionSetup
     */
    public static function buildTransactionSetup($config, SinglePayData $data, $isPOS = false)
    {
        $extras = $data->getExtras();
        $application = new Application($config['applicationId'], $config['applicationName'], $config['applicationVersion']);
        $credentials = new Credentials($config['accountId'], $config['accountToken'], $config['acceptorId'], NULL);

        /**
         * TODO: These config validation needs to go somewhere else.
         */
        if (!isset($config['terminalId'])) {
            throw new \Exception("Parameter 'terminalId' is required for this action.");
        }

        if (!isset($config['returnUrl'])) {
            throw new \Exception("Parameter 'returnUrl' is required for this action.");
        }

        // depending on whether the client is POS or Web - build an appropriate objects to
        // initiate the transaction process
        if ($isPOS) {
            $transaction = TransactionBuilder::buildPOSTransaction($config, $data->getOrderAmount());
            $transactionSetup = TransactionSetupBuilder::buildPOSSaleTransactionSetup($config);
            $terminal = TerminalBuilder::buildPOSTerminal($config);
        } else {
            $transaction = TransactionBuilder::buildStandardTransaction($config, $data->getOrderAmount());

            // Element's Hosted Payment supports process to create and update accounts along with a
            // credit card sale. Therefore we need to ensure that we are sending appropriate parameter 
            // values to generate tokens for each process.
            // 
            // Here, the method parameter can be either present in the data array or not. If a method
            // parameter is passed in then it needs to be either 'create' or 'update'.
            if (!is_null($extras['method']) && $extras['method'] === 'create') {
                $transactionSetup = TransactionSetupBuilder::buildAccountCreateTransactionSetup($config);
            } elseif(!is_null($extras['method']) && $extras['method'] === 'update') {
                $transactionSetup = TransactionSetupBuilder::buildAccountUpdateTransactionSetup($config);
            } else {
                $transactionSetup = TransactionSetupBuilder::buildStandardSaleTransactionSetup($config);
            }

            $terminal = TerminalBuilder::buildStandardTerminal($config);
        }

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
            PaymentAccountType::CreditCard,
            null,
            null,
            null,
            PASSUpdaterBatchStatus::IncludedInNextBatch,
            PASSUpdaterOption::AutoUpdateEnabled
        );

        if (!is_null($extras['method']) && strcasecmp($extras['method'], 'create') == 0) {
            if (is_null($data->getCustomerNo())) {
                throw new \Exception("Parameter 'customerNo' is required for this action.");
            }

            $paymentAccount->PaymentAccountReferenceNumber = $data->getCustomerNo();
        } elseif (!is_null($extras['method']) && strcasecmp($extras['method'], 'update') == 0) {
            if (is_null($data->getCustomerNo())) {
                throw new \Exception("Parameter 'customerNo' is required for this action.");
            }

            if (!isset($extras['paymentToken'])) {
                throw new \Exception("Parameter 'paymentToken' is required for this action.");
            }

            $paymentAccount->PaymentAccountID = $extras['paymentToken'];
            $paymentAccount->PaymentAccountReferenceNumber = $data->getCustomerNo();
        }

        return new TransactionSetup(
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

    public static function buildCreditCardAVSOnly($config, SinglePayData $data)
    {
        $application = new Application($config['applicationId'], $config['applicationName'], $config['applicationVersion']);
        $credentials = new Credentials($config['accountId'], $config['accountToken'], $config['acceptorId'], NULL);
    }
}