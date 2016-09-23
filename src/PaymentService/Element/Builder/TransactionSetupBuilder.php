<?php
namespace SinglePay\PaymentService\Element\Builder;

use SinglePay\PaymentService\Element\Express\Type\TransactionSetup;
use SinglePay\PaymentService\Element\Express\Enum\TransactionSetupMethod;
use SinglePay\PaymentService\Element\Express\Enum\Device;
use SinglePay\PaymentService\Element\Express\Enum\DeviceInputCode;

/**
 * @package SinglePay
 * @author  Mahendra Rai
 */
class TransactionSetupBuilder
{
    /**
     * Build an instance of TransactionSetup for web Credit Card sale.
     * @param  array  $config
     * @return TransactionSetup
     */
    public static function buildStandardSaleTransactionSetup($config)
    {
        return new TransactionSetup(
            null,
            $config['accountId'],
            $config['acceptorId'],
            $config['applicationId'],
            $config['applicationName'],
            $config['applicationVersion'],
            TransactionSetupMethod::CreditCardSale,
            Device::Null,
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
            DeviceInputCode::NotUsed
        );
    }

    /**
     * Build an instance of TransactionSetup for POS Credit Card sale.
     * @param  array  $config
     * @return TransactionSetup
     */
    public static function buildPOSSaleTransactionSetup($config)
    {

        return new TransactionSetup(
            null,
            $config['accountId'],
            $config['acceptorId'],
            $config['applicationId'],
            $config['applicationName'],
            $config['applicationVersion'],
            TransactionSetupMethod::CreditCardSale,
            Device::MagtekEncryptedSwipe,
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
            DeviceInputCode::NotUsed
        );
    }

    /**
     * Build an instance of TransactionSetup for Payment Account Create method.
     * @param  array  $config
     * @return TransactionSetup
     */
    public static function buildAccountCreateTransactionSetup($config)
    {
        return new TransactionSetup(
            null,
            $config['accountId'],
            $config['acceptorId'],
            $config['applicationId'],
            $config['applicationName'],
            $config['applicationVersion'],
            TransactionSetupMethod::PaymentAccountCreate,
            Device::Null,
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
            'Save Card',
            null,
            DeviceInputCode::NotUsed
        );
    }

    /**
     * Build an instance of TransactionSetup for Payment Account Update method.
     * @param  array  $config
     * @return TransactionSetup
     */
    public static function buildAccountUpdateTransactionSetup($config)
    {
        return new TransactionSetup(
            null,
            $config['accountId'],
            $config['acceptorId'],
            $config['applicationId'],
            $config['applicationName'],
            $config['applicationVersion'],
            TransactionSetupMethod::PaymentAccountUpdate,
            Device::Null,
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
            'Update Card',
            null,
            DeviceInputCode::NotUsed
        );
    }
}