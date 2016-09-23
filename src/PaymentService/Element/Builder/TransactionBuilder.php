<?php
namespace SinglePay\PaymentService\Element\Builder;

use SinglePay\PaymentService\Element\Express\Type\Transaction;
use SinglePay\PaymentService\Element\Express\Enum\EMVEncryptionFormat;
use SinglePay\PaymentService\Element\Express\Enum\MarketCode;
use SinglePay\PaymentService\Element\Express\Enum\ReversalReason;
use SinglePay\PaymentService\Element\Express\Enum\ReversalType;

/**
 * @package SinglePay
 * @author  Mahendra Rai
 */
class TransactionBuilder
{
    /**
     * Build an instance of Transaction for standard web transaction.
     * @param  array  $config
     * @param  string $amount
     * @return Transaction
     */
    public static function buildStandardTransaction($config, $amount)
    {
        return new Transaction(
            null,
            null,
            null,
            $amount,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            ReversalType::Full,
            MarketCode::ECommerce,
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
            EMVEncryptionFormat::aDefault,
            ReversalReason::Unknown
        );
    }

    /**
     * Build an instance of Transaction for POS transaction.
     * @param  array  $config
     * @param  string $amount
     * @return Transaction 
     */
    public static function buildPOSTransaction($config, $amount)
    {
        return new Transaction(
            null,
            null,
            null,
            $amount,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            ReversalType::Full,
            MarketCode::Retail,
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
            EMVEncryptionFormat::aDefault,
            ReversalReason::Unknown
        );
    }
}