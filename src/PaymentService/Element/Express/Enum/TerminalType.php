<?php
namespace SinglePay\PaymentService\Element\Express\Enum;

class TerminalType
{
    const __default = 'Unknown';
    const Unknown = 'Unknown';
    const PointOfSale = 'PointOfSale';
    const ECommerce = 'ECommerce';
    const MOTO = 'MOTO';
    const FuelPump = 'FuelPump';
    const ATM = 'ATM';
    const Voice = 'Voice';
}