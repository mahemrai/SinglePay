<?php
namespace SinglePay\PaymentService;

/**
 * @package SinglePay
 * @author  Mahendra Rai
 */
interface PaymentServiceInterface
{
    /**
     * @param  array $data
     */
    public function processPayment();

    /**
     * @param  array $data
     */
    public function refund();

    /**
     * @param  array $data
     */
    public function saveCard();

    /**
     * @param  array $data
     */
    public function payWithSavedCard();
}