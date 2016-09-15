<?php
namespace SinglePay\PaymentService;

interface PaymentServiceInterface
{
    public function processPayment();

    public function refund();

    public function saveCard();

    public function payWithSavedCard();
}