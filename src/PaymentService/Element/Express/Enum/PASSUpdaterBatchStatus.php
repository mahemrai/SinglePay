<?php
namespace SinglePay\PaymentService\Element\Express\Enum;

class PASSUpdaterBatchStatus
{
    const __default = 'Null';
    const Null = 'Null';
    const IncludedInNextBatch = 'IncludedInNextBatch';
    const NotIncludedInNextBatch = 'NotIncludedInNextBatch';
}