<?php
namespace SinglePay\PaymentService\Element\Express\Enum;

class ReversalType
{
    const __default = 'System';
    const System = 'System';
    const Full = 'Full';
    const Partial = 'Partial';
}