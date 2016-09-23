<?php
namespace SinglePay\PaymentService\Element\Express\Enum;

class TransactionSetupMethod
{
    const __default = 'Null';
    const Null = 'Null';
    const CreditCardSale = 'CreditCardSale';
    const CreditCardAuthorization = 'CreditCardAuthorization';
    const CreditCardAVSOnly = 'CreditCardAVSOnly';
    const CreditCardForce = 'CreditCardForce';
    const DebitCardSale = 'DebitCardSale';
    const CheckSale = 'CheckSale';
    const PaymentAccountCreate = 'PaymentAccountCreate';
    const PaymentAccountUpdate = 'PaymentAccountUpdate';
    const Sale = 'Sale';
}