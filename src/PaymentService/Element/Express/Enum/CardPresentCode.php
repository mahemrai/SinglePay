<?php
namespace SinglePay\PaymentService\Element\Express\Enum;

class CardPresentCode
{
    const __default = 'UseDefault';
    const UseDefault = 'UseDefault';
    const Unknown = 'Unknown';
    const Present = 'Present';
    const NotPresent = 'NotPresent';
}