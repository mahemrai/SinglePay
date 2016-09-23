<?php
namespace SinglePay\PaymentService\Element\Express\Enum;

class CardInputCode
{
    const __default = 'UseDefault';
    const UseDefault = 'UseDefault';
    const Unknown = 'Unknown';
    const MagstripeRead = 'MagstripeRead';
    const ContactlessMagstripeRead = 'ContactlessMagstripeRead';
    const ManualKeyed = 'ManualKeyed';
    const ManualKeyedMagstripeFailure = 'ManualKeyedMagstripeFailure';
    const ChipRead = 'ChipRead';
    const ContactlessChipRead = 'ContactlessChipRead';
}