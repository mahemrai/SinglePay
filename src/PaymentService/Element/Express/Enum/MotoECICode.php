<?php
namespace SinglePay\PaymentService\Element\Express\Enum;

class MotoECICode
{
    const __default = 'UseDefault';
    const UseDefault = 'UseDefault';
    const NotUsed = 'NotUsed';
    const Single = 'Single';
    const Recurring = 'Recurring';
    const Installment = 'Installment';
    const SecureECommerce = 'SecureECommerce';
    const NonAuthenticatedSecureTransaction = 'NonAuthenticatedSecureTransaction';
    const NonAuthenticatedSecureECommerceTransaction = 'NonAuthenticatedSecureECommerceTransaction';
    const NonSecureECommerceTransaction = 'NonSecureECommerceTransaction';
}