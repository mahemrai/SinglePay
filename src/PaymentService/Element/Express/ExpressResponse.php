<?php
namespace SinglePay\PaymentService\Element\Express;

class ResponseCode
{
    protected static $successfulExpressCodes = array(0, 5);

    protected static $successfulAvsCodes = array('F', 'M', 'X', 'Y', '0');

    public static function expressSuccess($responseCode)
    {
        return in_array($responseCode, self::$successfulExpressCodes);
    }

    public static function avsSuccess($avsCode)
    {
        return in_array($avsCode, self::$successfulAvsCodes);
    }
}