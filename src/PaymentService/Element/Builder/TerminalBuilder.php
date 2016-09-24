<?php
namespace SinglePay\PaymentService\Element\Builder;

use SinglePay\PaymentService\Element\Express\Type\Terminal;
use SinglePay\PaymentService\Element\Express\Enum\CardInputCode;
use SinglePay\PaymentService\Element\Express\Enum\CardPresentCode;
use SinglePay\PaymentService\Element\Express\Enum\CardholderPresentCode;
use SinglePay\PaymentService\Element\Express\Enum\ConsentCode;
use SinglePay\PaymentService\Element\Express\Enum\CVVPresenceCode;
use SinglePay\PaymentService\Element\Express\Enum\CVVResponseType;
use SinglePay\PaymentService\Element\Express\Enum\EncryptionFormat;
use SinglePay\PaymentService\Element\Express\Enum\MotoECICode;
use SinglePay\PaymentService\Element\Express\Enum\TerminalCapabilityCode;
use SinglePay\PaymentService\Element\Express\Enum\TerminalEnvironmentCode;
use SinglePay\PaymentService\Element\Express\Enum\TerminalType;

/**
 * Builder class for building Terminal object for specific clients with
 * appropriate settings.
 * 
 * @author  Mahendra Rai
 */
class TerminalBuilder
{
    /**
     * Build a Terminal object for POS clients.
     * 
     * @param  array    $config
     * @return Terminal
     */
    public static function buildPOSTerminal($config)
    {
        return new Terminal(
            $config['terminalId'],
            TerminalType::PointOfSale,
            CardPresentCode::Present,
            CardholderPresentCode::Present,
            CardInputCode::MagstripeRead,
            CVVPresenceCode::Provided,
            TerminalCapabilityCode::MagstripeReader,
            TerminalEnvironmentCode::LocalAttended,
            MotoECICode::NotUsed,
            CVVResponseType::Regular,
            ConsentCode::FaceToFace,
            null,
            EncryptionFormat::aDefault,
            null,
            null,
            null
        );
    }

    /**
     * Build Terminal object for standard Web clients.
     * 
     * @param  array  $config
     * @return Terminal
     */
    public static function buildStandardTerminal($config)
    {
        return new Terminal(
            $config['terminalId'],
            TerminalType::ECommerce,
            CardPresentCode::UseDefault,
            CardholderPresentCode::ECommerce,
            CardInputCode::ManualKeyed,
            CVVPresenceCode::Provided,
            TerminalCapabilityCode::KeyEntered,
            TerminalEnvironmentCode::ECommerce,
            MotoECICode::NonAuthenticatedSecureECommerceTransaction,
            CVVResponseType::Regular,
            ConsentCode::Internet,
            null,
            EncryptionFormat::aDefault,
            null,
            null,
            null
        );
    }
}