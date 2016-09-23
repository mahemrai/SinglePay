<?php
namespace SinglePay\PaymentService\Element\Express\Enum;

class PaymentAccountType
{
    const __default = 'CreditCard';
    const CreditCard = 'CreditCard';
    const Checking = 'Checking';
    const Savings = 'Savings';
    const ACH = 'ACH';
    const Other = 'Other';
}