<?php
namespace SinglePay\PaymentService\Element\Express\Enum;

class CardholderPresentCode
{
    const __default = 'UseDefault';
    const UseDefault = 'UseDefault';
    const Unknown = 'Unknown';
    const Present = 'Present';
    const NotPresent = 'NotPresent';
    const MailOrder = 'MailOrder';
    const PhoneOrder = 'PhoneOrder';
    const StandingAuth = 'StandingAuth';
    const ECommerce = 'ECommerce';
}