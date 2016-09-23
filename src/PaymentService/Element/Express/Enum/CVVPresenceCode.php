<?php
namespace SinglePay\PaymentService\Element\Express\Enum;

class CVVPresenceCode
{
    const __default = 'UseDefault';
    const UseDefault = 'UseDefault';
    const NotProvided = 'NotProvided';
    const Provided = 'Provided';
    const Illegible = 'Illegible';
    const CustomerIllegible = 'CustomerIllegible';
}