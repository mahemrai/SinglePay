<?php
namespace SinglePay\PaymentService;

trait ResponseValidable
{
    public function validateResponse($responseCode, $responseCodeArray)
    {
        return in_array($responseCode, $responseCodeArray);
    }
}