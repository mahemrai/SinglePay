<?php
namespace SinglePay\PaymentService\Element;

use SinglePay\SinglePayData;
use SinglePay\PaymentService\Element\Express\Enum\PaymentAccountType;
use SinglePay\PaymentService\Element\Express\Enum\PASSUpdaterBatchStatus;
use SinglePay\PaymentService\Element\Express\Enum\PASSUpdaterOption;
use SinglePay\PaymentService\Element\Express\Enum\EncryptionFormat;

use SinglePay\PaymentService\Element\Express\Type\Address;
use SinglePay\PaymentService\Element\Express\Type\Application;
use SinglePay\PaymentService\Element\Express\Type\Card;
use SinglePay\PaymentService\Element\Express\Type\Credentials;
use SinglePay\PaymentService\Element\Express\Type\ExtendedParameters;
use SinglePay\PaymentService\Element\Express\Type\PaymentAccount;

use SinglePay\PaymentService\Element\Express\Method\CreditCardSale;
use SinglePay\PaymentService\Element\Express\Method\CreditCardAVSOnly;
use SinglePay\PaymentService\Element\Express\Method\HealthCheck;
use SinglePay\PaymentService\Element\Express\Method\TransactionSetup;

use SinglePay\PaymentService\Element\Builder\TerminalBuilder;
use SinglePay\PaymentService\Element\Builder\TransactionBuilder;
use SinglePay\PaymentService\Element\Builder\TransactionSetupBuilder;

/**
 * Factory class for building Express method call objects with all the required
 * data objects.
 * 
 * @package SinglePay
 * @author  Mahendra Rai
 */
class ExpressFactory
{
    /**
     * Build an instance of HealthCheck call object.
     * @param  array       $config
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
     * @param  array            $config
     * @param  SinglePayData    $data
     * @return TransactionSetup
     */
    public static function buildTransactionSetup($config, SinglePayData $data, $isPOS = false)
    {
        $extras = $data->getExtras();
        $application = new Application($config['applicationId'], $config['applicationName'], $config['applicationVersion']);
        $credentials = new Credentials($config['accountId'], $config['accountToken'], $config['acceptorId'], NULL);

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

    /**
     * Build an instance of CreditCardSale call object.
     * @param  array          $config
     * @param  SinglePayData  $data
     * @return CreditCardSale
     */
    public static function buildCreditCardSale($config, SinglePayData $data)
    {
        $paymentCard = $data->getCard();
        $billingAddress = $data->getBillingAddress();
        $shippingAddress = $data->getShippingAddress();

        if (is_null($paymentCard)) {
            throw new \Exception("Card information is required for this action.");
        }

        $application = new Application($config['applicationId'], $config['applicationName'], $config['applicationVersion']);
        $credentials = new Credentials($config['accountId'], $config['accountToken'], $config['acceptorId'], NULL);
        $transaction = TransactionBuilder::buildStandardTransaction($config, $data->getOrderAmount());
        $terminal = TerminalBuilder::buildStandardTerminal($config);

        $card = new Card(
            null,
            null,
            null,
            null,
            $paymentCard->getNumber(),
            null,
            $paymentCard->getExpiryMonth(),
            $paymentCard->getExpiryYear(),
            (is_null($paymentCard->getName())) ? null : $paymentCard->getName(),
            (is_null($paymentCard->getCvv())) ? null : $paymentCard->getCvv(),
            null,
            null,
            null,
            null,
            null,
            EncryptionFormat::aDefault,
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

        $address = new Address(
            (is_null($billingAddress->getName())) ? null : $billingAddress->getName(),
            (is_null($billingAddress->getAddress1())) ? null : $billingAddress->getAddress1(),
            (is_null($billingAddress->getAddress2())) ? null : $billingAddress->getAddress2(),
            (is_null($billingAddress->getCity())) ? null : $billingAddress->getCity(),
            (is_null($billingAddress->getState())) ? null : $billingAddress->getState(),
            (is_null($billingAddress->getZipcode())) ? null : $billingAddress->getZipcode(),
            (is_null($billingAddress->getEmail())) ? null : $billingAddress->getEmail(),
            (is_null($billingAddress->getPhone())) ? null : $billingAddress->getPhone(),
            (is_null($shippingAddress->getName())) ? null : $shippingAddress->getName(),
            (is_null($shippingAddress->getAddress1())) ? null : $shippingAddress->getAddress1(),
            (is_null($shippingAddress->getAddress2())) ? null : $shippingAddress->getAddress2(),
            (is_null($shippingAddress->getCity())) ? null : $shippingAddress->getCity(),
            (is_null($shippingAddress->getState())) ? null : $shippingAddress->getState(),
            (is_null($shippingAddress->getZipcode())) ? null : $shippingAddress->getZipcode(),
            (is_null($shippingAddress->getEmail())) ? null : $shippingAddress->getEmail(),
            (is_null($shippingAddress->getPhone())) ? null : $shippingAddress->getPhone()
        );

        return new CreditCardSale(
            $credentials,
            $application,
            $terminal,
            $card,
            $transaction,
            $address,
            null
        );
    }

    /**
     * Build an instance of CreditCardAVSOnly call object.
     * @param  array             $config
     * @param  SinglePayData     $data
     * @return CreditCardAVSOnly
     */
    public static function buildCreditCardAVSOnly($config, SinglePayData $data, $useToken = false)
    {
        $paymentCard = $data->getCard();
        $billingAddress = $data->getBillingAddress();
        $shippingAddress = $data->getShippingAddress();

        if (is_null($paymentCard)) {
            throw new \Exception("Card information is required for this action.");
        }

        if (is_null($billingAddress)) {
            throw new \Exception("Billing address is required for this action.");
        }

        $application = new Application($config['applicationId'], $config['applicationName'], $config['applicationVersion']);
        $credentials = new Credentials($config['accountId'], $config['accountToken'], $config['acceptorId'], NULL);
        $transaction = TransactionBuilder::buildStandardTransaction($config, $data->getOrderAmount());
        $terminal = TerminalBuilder::buildStandardTerminal($config);

        $card = new Card(
            null,
            null,
            null,
            null,
            $paymentCard->getNumber(),
            null,
            $paymentCard->getExpiryMonth(),
            $paymentCard->getExpiryYear(),
            (is_null($paymentCard->getName())) ? null : $paymentCard->getName(),
            (is_null($paymentCard->getCvv())) ? null : $paymentCard->getCvv(),
            null,
            null,
            null,
            null,
            null,
            EncryptionFormat::aDefault,
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

        $address = new Address(
            (is_null($billingAddress->getName())) ? null : $billingAddress->getName(),
            (is_null($billingAddress->getAddress1())) ? null : $billingAddress->getAddress1(),
            (is_null($billingAddress->getAddress2())) ? null : $billingAddress->getAddress2(),
            (is_null($billingAddress->getCity())) ? null : $billingAddress->getCity(),
            (is_null($billingAddress->getState())) ? null : $billingAddress->getState(),
            (is_null($billingAddress->getZipcode())) ? null : $billingAddress->getZipcode(),
            (is_null($billingAddress->getEmail())) ? null : $billingAddress->getEmail(),
            (is_null($billingAddress->getPhone())) ? null : $billingAddress->getPhone(),
            (is_null($shippingAddress->getName())) ? null : $shippingAddress->getName(),
            (is_null($shippingAddress->getAddress1())) ? null : $shippingAddress->getAddress1(),
            (is_null($shippingAddress->getAddress2())) ? null : $shippingAddress->getAddress2(),
            (is_null($shippingAddress->getCity())) ? null : $shippingAddress->getCity(),
            (is_null($shippingAddress->getState())) ? null : $shippingAddress->getState(),
            (is_null($shippingAddress->getZipcode())) ? null : $shippingAddress->getZipcode(),
            (is_null($shippingAddress->getEmail())) ? null : $shippingAddress->getEmail(),
            (is_null($shippingAddress->getPhone())) ? null : $shippingAddress->getPhone()
        );

        if ($useToken) {
            $extendedParameters = new ExtendedParameters('PaymentAccount', $paymentCard->getToken());
        }

        return new CreditCardAVSOnly(
            $credentials,
            $application,
            $terminal,
            $card,
            $transaction,
            $address,
            null
        );
    }
}