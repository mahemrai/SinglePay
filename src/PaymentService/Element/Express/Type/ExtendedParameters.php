<?php
namespace SinglePay\PaymentService\Element\Express\Type;

class ExtendedParameters
{
    public $Key;

    public $Value;

    public function __construct($key, $value)
    {
        $this->Key = $key;
        $this->value = $value;
    }
}